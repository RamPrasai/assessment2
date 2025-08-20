@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">+ New Post</a>
    </div>

    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($posts->isEmpty())
        <div class="alert alert-info">No posts yet. Click <strong>+ New Post</strong> to create one.</div>
    @else
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th style="width: 36px;">#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th style="width: 140px;">Created</th>
                    <th style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name ?? '—' }}</td>
                        <td>{{ $post->user->name ?? '—' }}</td>
                        <td>
                            @if($post->is_active === 'Yes')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>{{ optional($post->created_at)->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form
                                action="{{ route('admin.posts.destroy', $post) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Delete this post?');"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
