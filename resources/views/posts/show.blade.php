@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p><strong>Category:</strong> {{ $post->category->name ?? 'No category' }}</p>
    <p>{{ $post->content }}</p>
</div>
@endsection
