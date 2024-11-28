<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageApiController extends Controller
{
    public function index()
    {
        $images = Image::with('gallery')
            ->select('id', 'gallery_id', 'file', 'title')
            ->get();
        
        return response()->json([
            'status' => true,
            'data' => $images
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'gallery_id' => 'required|exists:galleries,id',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            
            try {
                // Simpan file ke public/images
                $file->move(public_path('images'), $filename);
                
                $image = Image::create([
                    'gallery_id' => $request->gallery_id,
                    'file' => $filename,
                    'title' => $request->title
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Gambar berhasil ditambahkan',
                    'data' => $image
                ], 201);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal menyimpan gambar: ' . $e->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Tidak ada file yang diunggah'
        ], 422);
    }

    public function show($id)
    {
        $image = Image::with('gallery')
            ->select('id', 'gallery_id', 'file', 'title')
            ->findOrFail($id);
        
        return response()->json([
            'status' => true,
            'data' => $image
        ]);
    }

    public function showImage($filename)
{
    $path = public_path('images/' . $filename);
    
    if (!file_exists($path)) {
        return response()->json([
            'status' => false,
            'message' => 'Gambar tidak ditemukan'
        ], 404);
    }
    
    return response()->file($path);
}

    public function update(Request $request, $id)
    {
        try {
            \Log::info('Raw request data:', [
                'all' => $request->all(),
                'has' => [
                    'gallery_id' => $request->has('gallery_id'),
                    'title' => $request->has('title')
                ],
                'input' => [
                    'gallery_id' => $request->input('gallery_id'),
                    'title' => $request->input('title')
                ]
            ]);

            $image = Image::findOrFail($id);
            
            // Validasi data
            $validated = $request->validate([
                'gallery_id' => 'required|exists:galleries,id',
                'title' => 'required',
                'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Update data menggunakan input() bukan validated
            $image->gallery_id = $request->input('gallery_id');
            $image->title = $request->input('title');

            if ($request->hasFile('file')) {
                // Hapus file lama
                if ($image->file && file_exists(public_path('images/' . $image->file))) {
                    unlink(public_path('images/' . $image->file));
                }

                // Upload file baru
                $file = $request->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $fileName);
                $image->file = $fileName;
            }

            $image->save();

            return response()->json([
                'status' => true,
                'message' => 'Gambar berhasil diperbarui',
                'data' => $image
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Error:', [
                'request' => $request->all(),
                'errors' => $e->errors()
            ]);
            
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        // Hapus file fisik
        if (file_exists(public_path('images/' . $image->file))) {
            unlink(public_path('images/' . $image->file));
        }

        // Hapus record dari database
        $image->delete();

        return response()->json([
            'status' => true,
            'message' => 'Gambar berhasil dihapus'
        ]);
    }
} 