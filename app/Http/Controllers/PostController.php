<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Post';
        $posts = Post::with(['category', 'user'])->get();
        return view('admin.posts.index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua data Category
        $categories = Category::all();

        // Tampilkan halaman create dan kirim data category
        return view('admin.posts.create', [
            'categories' => $categories,
            'title' => 'Tambah Post',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Simpan data Post baru
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(), // ambil id user yang sedang login
            'status' => $request->status,
            'gallery_id' => $request->gallery_id,
        ]);

        // Redirect ke halaman index post
        return redirect('/posts')->with('success','Post Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($category_id)
    {
        $posts = Post::where('category_id', $category_id)
            ->with(['gallery.images', 'category', 'user'])
            ->get();
        
        return view('admin.posts.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
         // Ambil semua data Category
         $categories = Category::all();

         // Tampilkan halaman edit dan kirim data post dan category
         return view('admin.posts.edit', [
             'post' => $post,
             'title' => 'Edit Post',
             'categories' => $categories,
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Update data Post
       $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

         // Redirect ke halaman index post
         return redirect('/posts')->with('success','Post Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Hapus data Post
        $post->delete();

         // Redirect ke halaman index post
         return redirect('/posts')->with('success','Post Berhasil Dihapus');
    }

    public function category(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
                     ->where('status', 'publish')
                     ->orderBy('created_at', 'desc')
                     ->paginate(7);

        return view('show', [
            'category' => $category,
            'categories' => Category::all(),
            'posts' => $posts,
        ]);
    }
}
