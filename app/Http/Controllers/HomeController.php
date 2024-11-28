<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Profile;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $profile = Profile::all();

        // Ambil posts untuk setiap kategori
        foreach($categories as $category) {
            $category->posts = Post::where('category_id', $category->id)
                ->where('status', 'publish')
                ->with('gallery.images') // eager loading untuk menghindari N+1 query
                ->latest()
                ->take(4)
                ->get();
        }

        // Tambahkan query untuk kategori spesifik
        $informasiTerkini = Post::where('category_id', 3)
            ->where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $agendaSekolah = Post::where('category_id', 4)
            ->where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $galeriSekolah = Post::where('category_id', 5)
            ->where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('welcome', compact(
            'categories',
            'profile',
            'informasiTerkini',
            'agendaSekolah',
            'galeriSekolah'
        ));
    }

    public function informasi()
    {
        return view('informasi', [
            'categories' => Category::all(),
            'posts' => Post::with(['galleries.images'])
                ->where('category_id', 1)
                ->where('status', 'publish')
                ->latest()
                ->get()
        ]);
    }

    public function agenda()
    {
        return view('agenda', [
            'categories' => Category::all(),
            'posts' => Post::with(['galleries.images'])
                ->where('category_id', 2)
                ->where('status', 'publish')
                ->latest()
                ->get()
        ]);
    }

    public function gallery()
    {
        $posts = Post::with(['galleries.images'])
            ->where('status', 'publish')
            ->latest()
            ->get();
        
        return view('gallery', [
            'categories' => Category::all(),
            'posts' => $posts
        ]);
    }

    public function categoryBySlug($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        return view('category', [
            'categories' => Category::all(),
            'posts' => Post::with(['galleries.images'])
                ->where('category_id', $category->id)
                ->where('status', 'publish')
                ->latest()
                ->get(),
            'category' => $category
        ]);
    }

    public function show($id)
    {
        $post = Post::with(['galleries.images'])
            ->where('status', 'publish')
            ->findOrFail($id);
        
        $categories = Category::all();
        
        return view('show', [
            'post' => $post,
            'categories' => $categories
        ]);
    }
}   