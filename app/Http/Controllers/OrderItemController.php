<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function orderItemById($id)
    {
        $orderItems = OrderItem::where('order_id',$id)->get();
        return view('order.order_Item',compact('orderItems'));
    }
}
