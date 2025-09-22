<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::orderBy('created_at', 'desc')->get();
    }

    public function show($id)
    {
        return Post::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required','string','max:255'],
            'body'         => ['nullable','string'],
            'content'      => ['nullable','string'],
            'category_id'  => ['nullable','integer'],
            'is_active'    => ['nullable','boolean'],
        ]);

        // Decide which content column to write to
        $contentCol = Schema::hasColumn('posts','body')
            ? 'body'
            : (Schema::hasColumn('posts','content') ? 'content' : null);

        $content = $data['body'] ?? $data['content'] ?? null;

        if (!$contentCol) {
            return response()->json(['message' => 'No content column (body/content) found on posts table.'], 500);
        }
        if ($content === null) {
            return response()->json(['message' => 'Provide either "body" or "content".'], 422);
        }

        $post = new Post();
        $post->title = $data['title'];
        $post->{$contentCol} = $content;

        // category_id: use provided value, otherwise fall back to first category if the column exists
        if (Schema::hasColumn('posts','category_id')) {
            if (array_key_exists('category_id', $data) && $data['category_id'] !== null) {
                $post->category_id = (int) $data['category_id'];
            } else {
                $defaultCatId = null;
                if (Schema::hasTable('categories')) {
                    $defaultCatId = DB::table('categories')->value('id'); // first id or null
                }
                if ($defaultCatId) {
                    $post->category_id = (int) $defaultCatId;
                }
                // If your DB enforces NOT NULL on category_id and there are no categories,
                // this will still error. In that case either create a category first
                // or make posts.category_id nullable via a migration.
            }
        }

        // is_active (default true if the column exists)
        if (Schema::hasColumn('posts','is_active')) {
            $post->is_active = array_key_exists('is_active',$data) ? (bool)$data['is_active'] : true;
        }

        // Attach the authenticated user if user_id column exists
        if (Schema::hasColumn('posts', 'user_id') && $request->user()) {
            $post->user_id = $request->user()->id;
        }

        $post->save();

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $data = $request->validate([
            'title'        => ['required','string','max:255'],
            'body'         => ['nullable','string'],
            'content'      => ['nullable','string'],
            'category_id'  => ['nullable','integer'],
            'is_active'    => ['nullable','boolean'],
        ]);

        $contentCol = Schema::hasColumn('posts','body')
            ? 'body'
            : (Schema::hasColumn('posts','content') ? 'content' : null);

        $content = $data['body'] ?? $data['content'] ?? null;

        if (!$contentCol) {
            return response()->json(['message' => 'No content column (body/content) found on posts table.'], 500);
        }
        if ($content === null) {
            return response()->json(['message' => 'Provide either "body" or "content".'], 422);
        }

        $post->title = $data['title'];
        $post->{$contentCol} = $content;

        if (Schema::hasColumn('posts','category_id') && array_key_exists('category_id',$data)) {
            // Allow changing category if provided
            $post->category_id = $data['category_id'];
        }

        if (Schema::hasColumn('posts','is_active') && array_key_exists('is_active',$data)) {
            $post->is_active = (bool)$data['is_active'];
        }

        $post->save();

        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['deleted' => true]);
    }
}
