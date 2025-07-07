<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all()->map(function ($product) {
            $productArray = $product->toArray();
            $productArray['image_url'] = $product->image ? asset('storage/' . $product->image) : null;
            return $productArray;
        });

        return response()->json([
            'message' => 'Product list loaded successfully',
            'data' => $products
        ]);
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $validated['image'] = $imagePath;
        }

        $product = Product::create($validated);

        $productData = $product->toArray();
        $productData['image_url'] = $product->image ? asset('storage/' . $product->image) : null;

        return response()->json($productData, 201);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $productArray = $product->toArray();
        $productArray['image_url'] = $product->image ? asset('storage/' . $product->image) : null;

        return response()->json([
            'message' => 'Product retrieved successfully',
            'data' => $productArray
        ]);
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'sometimes|required|numeric',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('product_images', 'public');
        }

        $product->update($validated);

        $productArray = $product->toArray();
        $productArray['image_url'] = $product->image ? asset('storage/' . $product->image) : null;

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $productArray
        ]);
    }

    /**
     * Remove the specified product.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
            'data' => true
        ]);
    }
}
