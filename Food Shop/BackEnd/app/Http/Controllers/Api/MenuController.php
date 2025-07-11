<?php

// app/Http/Controllers/Api/MenuController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return Menu::all();
    }

    public function show($id)
    {
        return Menu::with('category')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menu_images', 'public');
            $validated['image'] = asset('storage/' . $path);
        }

        $menu = Menu::create($validated);

        return response()->json($menu, 201);
    }


    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menus', 'public');
            $menu->image = asset("storage/$path");
        }

        $menu->save();

        return response()->json($menu);
    }
}
