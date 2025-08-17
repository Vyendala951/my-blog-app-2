@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Edit Category</h2>
        <a href="{{ route('categories.all') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <form action="{{ route('categories.save') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $category->id }}">

                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ $category->name }}" placeholder="Enter category name" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Description</label>
                    <textarea class="form-control" id="content" name="content" rows="4" 
                              placeholder="Enter description">{{ $category->content }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('categories.all') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
