@extends('layouts.app')

@section('title', isset($category) ? 'Edit Category' : 'Create Category')

@section('content')
    <h2>{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h2>

    <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content (optional)</label>
            <textarea name="content" id="content" rows="3" class="form-control">{{ old('content', $category->content ?? '') }}</textarea>
        </div>

        <button class="btn btn-success">{{ isset($category) ? 'Update' : 'Create' }}</button>
    </form>
@endsection
