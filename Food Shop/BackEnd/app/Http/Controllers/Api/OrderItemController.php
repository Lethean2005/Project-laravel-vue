<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem; // Your order item model

class OrderItemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Here you would link to an order; this example just stores the item
        $orderItem = OrderItem::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            // you can add user_id or order_id if needed
        ]);

        return response()->json(['success' => true, 'order_item' => $orderItem]);
    }
}
