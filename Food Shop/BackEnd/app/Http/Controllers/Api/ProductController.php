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
        $products = Product::with('category')->get()->map(function ($product) {
            $data = $product->toArray();
            $data['image_url'] = $product->image ? asset('storage/' . $product->image) : null;
            $data['category'] = $product->category ? [
                'id' => $product->category->id,
                'name' => $product->category->name,
                'image_url' => $product->category->image ? asset('storage/' . $product->category->image) : null,
            ] : null;
            return $data;
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
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('product_images', 'public');
        }

        $product = Product::create($validated);

        $data = $product->toArray();
        $data['image_url'] = $product->image ? asset('storage/' . $product->image) : null;
        $data['category'] = $product->category ? [
            'id' => $product->category->id,
            'name' => $product->category->name,
            'image_url' => $product->category->image ? asset('storage/' . $product->category->image) : null,
        ] : null;

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $data = $product->toArray();
        $data['image_url'] = $product->image ? asset('storage/' . $product->image) : null;
        $data['category'] = $product->category ? [
            'id' => $product->category->id,
            'name' => $product->category->name,
            'image_url' => $product->category->image ? asset('storage/' . $product->category->image) : null,
        ] : null;

        return response()->json([
            'message' => 'Product retrieved successfully',
            'data' => $data
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
            'category_id' => 'sometimes|required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('product_images', 'public');
        }

        $product->update($validated);

        $data = $product->toArray();
        $data['image_url'] = $product->image ? asset('storage/' . $product->image) : null;
        $data['category'] = $product->category ? [
            'id' => $product->category->id,
            'name' => $product->category->name,
            'image_url' => $product->category->image ? asset('storage/' . $product->category->image) : null,
        ] : null;

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $data
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
