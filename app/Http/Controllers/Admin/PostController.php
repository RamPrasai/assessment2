<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function index()
    {
        // Eager-load category and user to avoid N+1 queries
        $posts = Post::with(['category', 'user'])->orderByDesc('created_at')->get();

        return view('admin.posts.index', compact('posts'));
    }

    
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:50',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_active'   => 'required|in:Yes,No',
        ]);

        $validated['user_id'] = Auth::id();

        Post::create($validated);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:50',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_active'   => 'required|in:Yes,No',
        ]);

        $post->update($validated);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
