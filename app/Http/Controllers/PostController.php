<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            abort(403);  // Restrict to admin
        }
        $posts = Post::with('category')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            abort(403);
        }
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    public function edit(Post $post)
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            abort(403);
        }
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function save(Request $request)
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            abort(403);
        }
        $data = $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'required|in:Yes,No',
        ]);
        $data['user_id'] = Auth::id();

        if ($request->has('id')) {
            $post = Post::findOrFail($request->id);
            $post->update($data);
        } else {
            Post::create($data);
        }

        return redirect()->route('posts.all');
    }

    public function delete(Post $post)
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            abort(403);
        }
        $post->delete();
        return redirect()->route('posts.all');
    }
}
