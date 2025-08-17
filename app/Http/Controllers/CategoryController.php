<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            abort(403);
        }
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            abort(403);
        }
        return view('admin.categories.create');
    }

    public function edit(Category $category)
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            abort(403);
        }
        return view('admin.categories.edit', compact('category'));
    }

    public function save(Request $request)
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            abort(403);
        }
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'content' => 'nullable|string',
        ]);

        if ($request->has('id')) {
            $category = Category::findOrFail($request->id);
            $category->update($data);
        } else {
            Category::create($data);
        }

        return redirect()->route('categories.all');
    }

    public function delete(Category $category)
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            abort(403);
        }
        $category->delete();
        return redirect()->route('categories.all');
    }
}
