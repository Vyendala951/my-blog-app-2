<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostApiController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'user')->get();
        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        $post->load('category', 'user');
        return new PostResource($post);
    }

    public function store(Request $request)
    {
        // restrict to admin user only
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'required|in:Yes,No',
        ]);

        $data['user_id'] = Auth::id();
        $post = Post::create($data);

        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'required|in:Yes,No',
        ]);

        $post->update($data);
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        if (!Auth::user() || Auth::user()->email !== 'admin@example.com') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $post->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }
}
