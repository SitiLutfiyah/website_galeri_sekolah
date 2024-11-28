<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data Gallery
        $galleries = Gallery::all();

        // Tampilkan view index untuk menampilkan semua data gallery
        return view('admin.galleries.index', [
            'title' => 'Galeri Foto',
            'galleries' => $galleries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ambil semua data Post
        $posts = Post::all();

        // tampilkan view form tambah Gallery
        return view('admin.galleries.create', [
            'title' => 'Tambah Galeri Foto',
            'posts' => $posts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simpan data gallery yang baru
        Gallery::create([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        // Redirect ke halaman index Gallery
        return redirect('/galleries')->with('success', 'Galeri Foto Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        // tampilkan view deatil Gallery
        return view('admin.galleries.show', [
            'title' => 'Detail Galeri Foto',
            'gallery' => $gallery,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        // ambil semua data Post
        $posts = Post::all();

        // tampilkan view form edit Gallery
        return view('admin.galleries.edit', [
            'title' => 'Edit Galeri Foto',
            'gallery' => $gallery,
            'posts' => $posts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        // Update data Gallery
        $gallery->update([
            'post_id' => $request->post_id,
            'position' => $request->position,
            'status' => $request->status,
        ]);

        // Redirect ke halaman index Gallery
        return redirect('/galleries')->with('success', 'Galeri Foto Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Hapus data Gallery
        $gallery->delete();

        // Redirect ke halaman index Gallery
        return redirect('/galleries')->with('success', 'Galeri Foto Berhasil Dihapus');
    }

    public function showImages(Gallery $gallery)
    {
        return view('admin.galleries.show', [
            'gallery' => $gallery->load('images', 'post'),
            'title' => 'Detail Galeri'
        ]);
    }
}
