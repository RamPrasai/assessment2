@extends('layouts.app')

@section('title', 'Forbidden')

@section('content')
  <div class="container py-4">
    <h2 class="mb-2">403 – Forbidden</h2>
    <p class="mb-3">You don’t have permission to access this page.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
  </div>
@endsection
