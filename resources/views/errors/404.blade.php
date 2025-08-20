@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
  <div class="container py-4">
    <h2 class="mb-2">404 – Page not found</h2>
    <p class="mb-3">Sorry, we couldn’t find the page you were looking for.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
  </div>
@endsection
