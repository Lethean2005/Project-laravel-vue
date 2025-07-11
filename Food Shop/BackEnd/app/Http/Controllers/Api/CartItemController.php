<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;

class CartItemController extends Controller
{
    // GET /api/cart-items
    public function index()
    {
        return response()->json(CartItem::orderBy('id', 'desc')->get());
    }

    // POST /api/cart-items
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'price'      => 'required|numeric|min:0',
        ]);

        $item = CartItem::create($validated);

        return response()->json([
            'message' => 'Item added to cart',
            'data' => $item
        ], 201);
    }
}
