<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // ✅ GET: List all categories
    public function index()
    {
        return response()->json(Category::all());
    }

    // ✅ GET: Show single category
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    // ✅ POST: Create new category
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|unique:categories',
            'description' => 'nullable|string',
            'status'      => 'boolean',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // ✅ Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category = Category::create($data);
        return response()->json($category, 201);
    }

    // ✅ PUT: Update category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|unique:categories,slug,' . $id,
            'description' => 'nullable|string',
            'status'      => 'boolean',
            'image'       => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // ✅ Delete old image if exists
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            // ✅ Store new image
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);
        return response()->json($category);
    }

    // ✅ DELETE: Remove category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // ✅ Delete image from storage
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }

    // ✅ GET: Products under a category
    public function products($id)
    {
        $category = Category::with('products')->find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category->products);
    }
}
