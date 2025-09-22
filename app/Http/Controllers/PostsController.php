<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        // If you have Blade views, return a view; JSON fallback is fine for now
        return Post::orderBy('created_at','desc')->get();
    }

    public function show(Post $post)
    {
        return $post;
    }
}
