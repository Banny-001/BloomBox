<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'Category created successfully!', 'category' => $category]);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found!'], 404);
        }

        return response()->json($category);
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found!'], 404);
        }

        $request->validate([
            'name' => 'required|string',
        ]);

        $category->update(['name' => $request->name]);

        return response()->json(['message' => 'Category updated successfully!', 'category' => $category]);
    }
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found!'], 404);
        }

        $category->delete();

        return response()->json(['message' => 'Category deleted successfully!']);
    }
}
