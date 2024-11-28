<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Menampilkan daftar profile
    public function index()
    {
        $profiles = Profile::all();
        return view('admin.manajemen-page.index', [
            'profiles' => $profiles,
            'title' => 'Manajemen Halaman',  // Menambahkan title
        ]);
    }

    // Menampilkan form untuk menambah profile
    public function create()
    {
        return view('admin.manajemen-page.create', [
            'title' => 'Tambah Halaman',  // Menambahkan title
        ]);
    }

    // Menyimpan data profile baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Profile::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('profiles.index')->with('success', 'Halaman berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit profile
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('admin.manajemen-page.edit', [
            'profile' => $profile,
            'title' => 'Edit Halaman',  // Menambahkan title
        ]);
    }

    // Memperbarui data profile
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $profile = Profile::findOrFail($id);
        $profile->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('profiles.index')->with('success', 'Halaman berhasil diperbarui!');
    }

    // Menghapus profile
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Halaman berhasil dihapus!');
    }
}
