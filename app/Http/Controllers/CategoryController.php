<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        return view('admin.categories.index', [
            'title' => 'Kategori',
            'categories' => Category::all(),
        ]);
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('admin.categories.create', [
            'title' => 'Tambah Kategori',
        ]);
    }

    /**
     * Menyimpan kategori baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required', // Validasi untuk field 'title'
        ]);

        // Simpan data ke dalam tabel categories
        Category::create([
            'title' => $request->title // Simpan field 'title'
        ]);

        // Redirect ke halaman kategori
        return redirect('/categories')->with('success', 'Kategori Berhasil Ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit kategori yang ditentukan.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'title' => 'Edit Kategori',
            'category' => $category,
        ]);
    }

    public function show(Category $category)
    {
        // Ambil semua kategori untuk menu
        $categories = Category::all();
        
        $posts = Post::where('category_id', $category->id)
                    ->with(['galleries' => function($query) {
                        $query->where('status', 'aktif');
                    }, 'galleries.images'])
                    ->paginate(12);
        
        return view('show', compact('category', 'posts', 'categories'));
    }

    /**
     * Memperbarui kategori yang ditentukan dalam penyimpanan.
     */
    public function update(Request $request, Category $category)
    {
        // Validasi request
        $request->validate([
            'title' => 'required', // Validasi untuk field 'title'
        ]);

        // Memperbarui data
        $category->update([
            'title' => $request->title, // Memperbarui field 'title'
        ]);

        // Redirect ke halaman kategori
        return redirect('/categories')->with('success', 'Kategori Berhasil Diupdate');
    }

    /**
     * Menghapus kategori yang ditentukan dari penyimpanan.
     */
    public function destroy(Category $category)
    {
        // Hapus data
        $category->delete();

        // Redirect ke halaman kategori
        return redirect('/categories')->with('success', 'Kategori Berhasil Dihapus');
    }
}
