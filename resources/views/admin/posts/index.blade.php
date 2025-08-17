@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Posts</h2>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">+ Create Post</a>
    </div>

    <div class="card shadow-sm rounded-3">
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Category</th>
                        <th>Active</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ Str::limit($post->content, 50) }}</td>
                            <td>{{ $post->category ? $post->category->name : 'None' }}</td>
                            <td>
                                @if($post->is_active == 'Yes')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('posts.delete', $post) }}"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Delete this post?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
