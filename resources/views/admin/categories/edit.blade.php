@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <h2>Edit Category</h2>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text"
                   name="name"
                   id="name"
                   value="{{ old('name', $category->name) }}"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content (optional)</label>
            <textarea name="content"
                      id="content"
                      rows="3"
                      class="form-control">{{ old('content', $category->content) }}</textarea>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
@endsection
