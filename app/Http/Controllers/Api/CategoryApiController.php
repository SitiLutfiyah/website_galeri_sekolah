<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        return response()->json([
            'status' => true,
            'data' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $category = Category::create([
            'title' => $request->title
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $category
        ], 201);
    }

    public function show($id)
    {
        $category = Category::with(['posts' => function($query) {
            $query->select('id', 'title', 'category_id', 'content', 'user_id', 'status', 'created_at')
                ->with(['gallery' => function($q) {
                    $q->select('id', 'post_id', 'position', 'status')
                        ->with(['images' => function($i) {
                            $i->select('id', 'gallery_id', 'file', 'title');
                        }]);
                }]);
        }])->findOrFail($id);
        
        return response()->json([
            'status' => true,
            'data' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'title' => 'required'
        ]);

        $category->title = $request->title;
        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Kategori berhasil diperbarui',
            'data' => $category
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
} 