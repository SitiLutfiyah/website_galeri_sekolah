<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Profile;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'users' => \App\Models\User::count(),
            'categories' => \App\Models\Category::count(),
            'posts' => \App\Models\Post::count(),
            'galleries' => \App\Models\Gallery::count(),
            'images' => \App\Models\Image::count(),
            'profiles' => \App\Models\Profile::count(),
        ];

        return view('admin.dashboard.index', compact('counts'));
    }
}