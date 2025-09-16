<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function store(Request $request)
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:50',
            'content' => 'nullable|string',
        ]);

        $category = Category::create($data);
        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:50',
            'content' => 'nullable|string',
        ]);

        $category->update($data);
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $category->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}
