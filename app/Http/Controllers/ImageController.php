<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        // Tambahkan dd() untuk debug request
        // dd($request->all());

        // Validasi dengan pesan error
        $validated = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'gallery_id' => 'required|exists:galleries,id'
        ], [
            'gallery_id.required' => 'Gallery harus dipilih',
            'gallery_id.exists' => 'Gallery yang dipilih tidak valid'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            
            // Simpan file ke public/images
            $file->move(public_path('images'), $filename);

            try {
                // Simpan data ke database dengan memastikan gallery_id terisi
                Image::create([
                    'gallery_id' => $validated['gallery_id'], // Gunakan hasil validasi
                    'file' => $filename,
                    'title' => $validated['title']
                ]);

                return redirect()->back()->with('success', 'Foto berhasil ditambahkan');
            } catch (\Exception $e) {
                // Log error jika perlu
                return redirect()->back()
                    ->with('error', 'Gagal menyimpan foto: ' . $e->getMessage())
                    ->withInput();
            }
        }

        return redirect()->back()->with('error', 'Gagal mengunggah foto');
    }

    public function destroy($id)
    {
        // Ambil data image berdasarkan id
        $image = Image::find($id);
        
        // Hapus file dari storage
        if (Storage::exists('public/images/' . $image->file)) {
            Storage::delete('public/images/' . $image->file);
        }

        // Hapus data dari database
        $image->delete();

        // Redirect ke halaman sebelumnya
        return back()->with('success', 'Foto Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = Image::findOrFail($id);
        $image->title = $request->title;

        if ($request->hasFile('file')) {
            // Hapus file lama
            if (file_exists(public_path('images/' . $image->file))) {
                unlink(public_path('images/' . $image->file));
            }

            // Upload file baru
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('images'), $fileName);
            $image->file = $fileName;
        }

        $image->save();

        return redirect()->back()->with('success', 'Foto berhasil diperbarui');
    }
}