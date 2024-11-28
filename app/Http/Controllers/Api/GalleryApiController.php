<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryApiController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with(['post', 'images'])
            ->select('id', 'post_id', 'position', 'status')
            ->get();
        
        return response()->json([
            'status' => true,
            'data' => $galleries
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'required|integer',
            'status' => 'required|in:aktif,tidak aktif'
        ]);

        $gallery = Gallery::create([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Galeri berhasil ditambahkan',
            'data' => $gallery
        ], 201);
    }

    public function show($id)
    {
        $gallery = Gallery::with(['post', 'images'])
            ->select('id', 'post_id', 'position', 'status')
            ->findOrFail($id);
        
        return response()->json([
            'status' => true,
            'data' => $gallery
        ]);
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'position' => 'required|integer',
            'status' => 'required|in:aktif,tidak aktif'
        ]);

        $gallery->update([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Galeri berhasil diperbarui',
            'data' => $gallery
        ]);
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return response()->json([
            'status' => true,
            'message' => 'Galeri berhasil dihapus'
        ]);
    }
} 