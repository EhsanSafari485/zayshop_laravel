<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;

class orderController extends Controller
{
public function index()
{
    $orders = Order::with('user', 'items.variant.product')->latest()->get();
    return view('Panel.orders.index',compact('orders'));
}

public function show(Request $request)
{
    $order = Order::with('user', 'items.variant.product')->where('id', $request->id)->first();

    return view('Panel.orders.productOrder', compact('order'))->render();
}
public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'shipping_status' => 'required|in:pending,shipped,cancelled',
    ]);

    $order->shipping_status = $request->shipping_status;
    $order->save();

    return response()->json(['message' => 'وضعیت با موفقیت تغییر کرد.']);
}
}
