<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'user', 'gallery'])
            ->select('id', 'title', 'category_id', 'content', 'user_id', 'status', 'created_at')
            ->get();
        
        return response()->json([
            'status' => true,
            'data' => $posts
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published'
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post berhasil ditambahkan',
            'data' => $post
        ], 201);
    }

    public function show($id)
    {
        $post = Post::with(['category', 'user', 'gallery.images'])
            ->select('id', 'title', 'category_id', 'content', 'user_id', 'status', 'created_at')
            ->findOrFail($id);
        
        return response()->json([
            'status' => true,
            'data' => $post
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published'
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Post berhasil diperbarui',
            'data' => $post
        ]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'status' => true,
            'message' => 'Post berhasil dihapus'
        ]);
    }
} 