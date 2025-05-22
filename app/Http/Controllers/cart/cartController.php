<?php

namespace App\Http\Controllers\cart;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Panel\Products\product;
use App\Models\Panel\Products\product_variants;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    public function cart()
    {
        $cartItems = CartItem::with('variant.product', 'variant.color', 'variant.size', 'variant.product.images')
        ->where('user_id', Auth::id())
        ->get();

        return view('Home.cart.cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
        $user = auth()->user();

        $variant = product_variants::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)
            ->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'برای افزودن به سبد خرید باید وارد شوید.']);
        }

        if (!$variant) {
            return response()->json(['success' => false, 'message' => 'ترکیب رنگ و سایز یافت نشد.']);
        }

        if ($request->quantity > $variant->stock) {
            return response()->json(['success' => false, 'message' => 'تعداد درخواستی بیشتر از موجودی است.']);
        }

        // بررسی اینکه آیا این آیتم قبلاً در سبد هست
        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_variant_id', $variant->id)
            ->first();

        if ($cartItem) {
            // بررسی موجودی برای اطمینان از اینکه بیشتر از موجودی نباشد
            if ($cartItem->quantity + $request->quantity > $variant->stock) {
                return response()->json(['success' => false, 'message' => 'تعداد درخواستی بیشتر از موجودی است.']);
            }

            // افزایش تعداد موجود در سبد خرید
            $cartItem->quantity += $request->quantity;
            $cartItem->update();
        } else {
            // افزودن محصول جدید به سبد خرید
            CartItem::create([
                'user_id' => $user->id,
                'product_variant_id' => $variant->id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json(['success' => true , 'message' => 'محصول با موفقیت به سبد خرید اضافه شد.']);
    }


    public function destroy($id)
    {
    $CartItem = CartItem::find($id);
    if ($CartItem) {
        $CartItem->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}

public function getTotal()
{
    $userId = auth()->id();

    $cartItems = CartItem::with('variant.product')->where('user_id', $userId)->get();

    $total = 0;
    foreach ($cartItems as $item) {
        $product = $item->variant->product ?? null;
        if ($product) {
            $discountedPrice =(int) $product->price;
            if($product->discount > 0) {
                $discountedPrice = $product->price * (1 - $product->discount / 100);
            }
            $total += $discountedPrice * $item->quantity;
        }
    }

    return response()->json(['total' => number_format($total)]);
}


}
