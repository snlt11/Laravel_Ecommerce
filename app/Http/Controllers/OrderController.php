<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function allOrder()
    {
        $orders = Order::all();
        return view('order.order', compact('orders'));
    }
    public function updateStatus($id)
    {
        $order = Order::find($id);
        $order->status = !$order->status;
        $order->update();
        return redirect()->route('all.orders');
    }
}
