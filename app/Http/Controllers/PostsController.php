<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
