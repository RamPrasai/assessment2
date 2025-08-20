@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="container">
    <h1 class="mb-3">Create New Post</h1>

    
    @if ($errors->any())
        <div class="alert alert-danger">
            <p class="mb-2"><strong>Please fix the following:</strong></p>
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf

        
        <div class="mb-3">
            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}"
                maxlength="50"
                required
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        
        <div class="mb-3">
            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
            <textarea
                id="content"
                name="content"
                rows="5"
                class="form-control @error('content') is-invalid @enderror"
                required
            >{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        
        <div class="mb-3">
            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
            <select
                id="category_id"
                name="category_id"
                class="form-select @error('category_id') is-invalid @enderror"
                required
            >
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ (string)old('category_id') === (string)$category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        
        <div class="mb-3">
            <label for="is_active" class="form-label">Status <span class="text-danger">*</span></label>
            <select
                id="is_active"
                name="is_active"
                class="form-select @error('is_active') is-invalid @enderror"
                required
            >
                <option value="Yes" {{ old('is_active', 'Yes') === 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No"  {{ old('is_active') === 'No' ? 'selected' : '' }}>No</option>
            </select>
            @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
