<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Panel\Products\product_variants;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Multipay\Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class PaymentController extends Controller
{
    public function directPurchase(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = auth()->user();
        if (!$user->phone || !$user->address) {
            session()->flash('welcome', $user->name . ' عزیز! لطفاً مشخصات خود را کامل کنید.');
            return redirect()->route('Panel.account.edit', ['id' => $user->id]);
        }

        $variant = product_variants::with('product')->findOrFail($request->variant_id);
        $quantity = $request->quantity;

        $price = $variant->product->price;
        $discount = $variant->product->discount ?? 0;
        $finalPrice = round($price * (1 - ($discount / 100)));
        $totalPrice = $finalPrice * $quantity;

        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_variant_id' => $variant->id,
            'price' => $finalPrice,
            'quantity' => $quantity
        ]);

        $invoice = (new Invoice)->amount($totalPrice);
        $payment = new Payment();
        return $payment->via('local')->purchase($invoice, function ($driver, $transactionId) use ($order) {
            $order->update(['transaction_id' => $transactionId]);
        })->pay()->render();
    }

    public function checkout()
    {
        $user = auth()->user();

        if (!$user->phone || !$user->address) {
            session()->flash('welcome', $user->name . ' عزیز! لطفاً مشخصات خود را کامل کنید.');
            return redirect()->route('Panel.account.edit', ['id' => $user->id]);
        }

        $cartItems = CartItem::where('user_id', $user->id)->with('variant.product')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'سبد خرید شما خالی است.');
        }

        foreach ($cartItems as $item) {
            if ($item->variant->stock < $item->quantity) {
                return back()->with('error', 'موجودی کافی برای برخی محصولات وجود ندارد.');
            }
        }

        $totalPrice = 0;

        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        foreach ($cartItems as $item) {
            $price = $item->variant->product->price;
            $discount = $item->variant->product->discount ?? 0;
            $finalPrice = round($price * (1 - ($discount / 100)));
            $subtotal = $finalPrice * $item->quantity;

            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item->variant->id,
                'price' => $finalPrice,
                'quantity' => $item->quantity
            ]);

            $totalPrice += $subtotal;
        }

        $invoice = (new Invoice)->amount($totalPrice);
        $payment = new Payment();
        return $payment->via('local')->purchase($invoice, function ($driver, $transactionId) use ($order) {
            $order->update(['transaction_id' => $transactionId]);
        })->pay()->render();
    }

    public function callback(Request $request)
    {
        $user = auth()->user();

        try {
            $payment = new Payment();
            $receipt = $payment->via('local')->verify();

            $order = Order::where('transaction_id', $receipt->getReferenceId())
                          ->where('user_id', $user->id)
                          ->where('status', 'pending')
                          ->first();

            if (!$order) {
                return view('payment.failed', ['message' => 'سفارشی یافت نشد یا تراکنش نامعتبر است.']);
            }

            $items = OrderItem::where('order_id', $order->id)->get();

            foreach ($items as $item) {
                $variant = product_variants::find($item->product_variant_id);
                if ($variant && $variant->stock >= $item->quantity) {
                    $variant->stock -= $item->quantity;
                    $variant->save();
                }

                CartItem::where('user_id', $user->id)
                    ->where('product_variant_id', $item->product_variant_id)
                    ->delete();
            }

            $order->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            return view('payment.success', compact('receipt'));
        } catch (InvalidPaymentException $e) {
            Order::where('transaction_id', $request->input('transaction_id'))
                 ->update(['status' => 'failed','shipping_status' => 'cancelled']);
            return view('payment.failed', ['message' => $e->getMessage()]);
        }
    }

    public function getVariantId(Request $request)
    {
        $variant = product_variants::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)
            ->first();

        return $variant
            ? response()->json(['success' => true, 'variant_id' => $variant->id])
            : response()->json(['success' => false]);
    }

    public function markFailedOrders()
    {
        $orders = Order::where('status', 'pending')->get();

        foreach ($orders as $order) {
            if ($this->isExpired($order)) {
                $order->update(['status' => 'failed']);
            }
        }

        return response()->json(['message' => 'سفارش‌های منقضی شده به‌درستی علامت‌گذاری شدند.']);
    }

    private function isExpired(Order $order)
    {
        return $order->created_at->diffInMinutes(now()) > 30;
    }
}
