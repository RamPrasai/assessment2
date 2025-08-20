@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Posts</h1>
    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h3><a href="{{ url('/posts/'.$post->id) }}">{{ $post->title }}</a></h3>
                <p>Category: {{ $post->category->name ?? 'No category' }}</p>
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}
</div>
@endsection
