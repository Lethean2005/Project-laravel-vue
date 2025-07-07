<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get()->map(function ($category) {
            $cat = $category->toArray();
            $cat['image_url'] = $category->image ? asset('storage/' . $category->image) : null;
            return $cat;
        });

        return response()->json([
            "message" => "List Category Successfully",
            "data" => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('category_images', 'public');
        }

        $category = Category::create($data);

        $cat = $category->toArray();
        $cat['image_url'] = $category->image ? asset('storage/' . $category->image) : null;

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $cat,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                "message" => "Category not found.",
            ], 404);
        }

        $cat = $category->toArray();
        $cat['image_url'] = $category->image ? asset('storage/' . $category->image) : null;

        return response()->json([
            "message" => "Get Category Successfully",
            "data" => $cat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'sometimes|required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found.'
            ], 404);
        }

        $data = [];

        if ($request->has('name')) {
            $data['name'] = $request->name;
        }

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('category_images', 'public');
        }

        $category->update($data);

        $cat = $category->toArray();
        $cat['image_url'] = $category->image ? asset('storage/' . $category->image) : null;

        return response()->json([
            'message' => 'Category updated successfully.',
            'category' => $cat
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found.',
            ], 404);
        }

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully',
            'data' => true
        ]);
    }
}
