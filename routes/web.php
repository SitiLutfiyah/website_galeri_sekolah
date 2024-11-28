<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);


// Route untuk menampilkan halaman login
Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');

// Route untuk menampilkan proses login
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Route untuk pengunjung yang sudah Login
Route::middleware('auth')->group(function () {
    // Route untuk menampilkan dashboard admin
    Route::get('/admin', function () {
        return view('admin.dashboard.index', [
            'title' => 'Dashboard',
        ]);
    });

    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Route untuk manajemen admin
    Route::resource('users', UserController::class);

    
    // Route untuk logout (hanya POST)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route untuk CRUD category
    Route::resource('categories', CategoryController::class);
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

        // Route untuk CRUD posts 
        Route::resource('posts', PostController::class);

    // Route untuk CRUD gallery   
    Route::resource('galleries', GalleryController::class);

    // Tambahkan route baru untuk daftar gambar
    Route::get('/daftargambar/{gallery}', [GalleryController::class, 'showImages'])->name('galleries.showImages');

    Route::get('/images/{filename}', function ($filename) {
        $path = public_path('images/' . $filename);
        
        \Log::info('Request for image: ' . $filename);
        \Log::info('Full path: ' . $path);
        \Log::info('File exists: ' . (file_exists($path) ? 'Yes' : 'No'));
        \Log::info('File permissions: ' . substr(sprintf('%o', fileperms($path)), -4));
        
        if (!file_exists($path)) {
            \Log::error('Image not found: ' . $path);
            return response()->json([
                'error' => 'Image not found',
                'path' => $path,
                'requested_file' => $filename
            ], 404);
        }
        
        try {
            $type = mime_content_type($path);
            \Log::info('Mime type: ' . $type);
            
            return response()->file($path, [
                'Content-Type' => $type,
                'Cache-Control' => 'public, max-age=3600'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error serving image: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    })->where('filename', '.*');

    // Route untuk menyimpan foto yang diupload
    Route::post('/images/store', [ImageController::class, 'store']);
    

    // Route untuk menghapus foto
    Route::delete('/images/{id}', [ImageController::class, 'destroy']);
    Route::put('/images/{id}', [ImageController::class, 'update'])->name('images.update');

    // Route untuk Manajemen Page 
    Route::resource('profiles', ProfileController::class);

    Route::get('/profile', [ProfilesController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfilesController::class, 'update'])->name('profile.update');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/profile/remove-photo', [ProfilesController::class, 'removePhoto'])->name('profile.remove-photo');

});

Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');

// Route untuk menampilkan detail post
Route::get('/post/{id}', [HomeController::class, 'show'])->name('show');

Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
// Tambahkan route untuk mengakses gambar publik
Route::get('/images/{filename}', function ($filename) {
    $path = public_path('images/' . $filename);
    
    if (!file_exists($path)) {
        return response()->json(['message' => 'Image not found'], 404);
    }
    
    // Set header untuk caching
    $headers = [
        'Cache-Control' => 'public, max-age=31536000',
        'Expires' => gmdate('D, d M Y H:i:s \G\M\T', time() + 31536000),
    ];
    
    // Tambahkan header untuk koneksi
    header('Connection: Keep-Alive');
    header('Keep-Alive: timeout=5, max=1000');
    
    return response()->file($path, $headers);
});