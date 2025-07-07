<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select('id', 'name')->orderBy('id', 'DESC')->get();
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
            'name' => 'required',
        ]);

        $categories = Category::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $categories,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::select('id', 'name')->find($id);
        return response()->json([
            "message" => "Get Post Successfully",
            "data" => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    // Validate incoming data
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $categories = Category::find($id);

    if (!$categories) {
        return response()->json([
            'message' => 'Category not found.'
        ], 404);
    }

    // Update the category
    $categories->update([
        'name' => $request->name,
    ]);

    return response()->json([
        'message' => 'Category updated successfully.',
        'category' => $categories
    ], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::find($id);
        $categories->delete();

        return response()->json([
            'message' => 'Delete Category Successfully',
            'data' => true
        ]);
    }
}
