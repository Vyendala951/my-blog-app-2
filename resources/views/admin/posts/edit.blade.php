@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Edit Post</h2>
        <a href="{{ route('posts.all') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <form action="{{ route('posts.save') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $post->id }}">

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" 
                           value="{{ $post->title }}" placeholder="Enter post title" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" 
                              placeholder="Write your post content">{{ $post->content }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" id="category_id" name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="is_active" class="form-label">Active</label>
                    <select class="form-select" id="is_active" name="is_active">
                        <option value="Yes" {{ $post->is_active == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $post->is_active == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('posts.all') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
