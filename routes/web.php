<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;


Route::redirect('/', '/admin');

Route::get('/posts', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/posts/{post}', [App\Http\Controllers\PostsController::class, 'show']);



Route::middleware(['auth', 'admin'])->get('/admin', function () {
    return redirect()->route('admin.posts.index');
});

Route::get('/health', fn () => response()->json(['ok' => true]));

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
});


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/posts', fn () => response()->json(Post::all()));
