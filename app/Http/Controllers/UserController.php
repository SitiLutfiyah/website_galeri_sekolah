<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan daftar Admin
    public function index()
    {
        $users = User::all(); // Ambil semua Admin
        return view('admin.users.index', [
            'users' => $users,
            'title' => 'Manajemen Admin',
        ]); // Kirim data ke view
    }

    // Menampilkan form untuk menambah Admin
    public function create()
    {
        return view('admin.users.create', [
            'title' => 'Tambah Admin', // Set title
        ]); // Kembali ke form tambah Admin
    }

    // Menyimpan Admin baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Simpan data ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'Admin berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit Admin
    public function edit($id)
    {
        $user = User::findOrFail($id); // Cari Admin berdasarkan ID
        return view('admin.users.edit', [
            'user' => $user,
            'title' => 'Edit Admin', // Set title
        ]); // Kembali ke form edit
    }

 


    // Memperbarui Admin
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // Cari Admin berdasarkan ID

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // Cek apakah password baru diinput dan valid
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Update password jika ada
        }

        $user->save(); // Simpan perubahan

        return redirect()->route('users.index')->with('success', 'Admin berhasil diperbarui.');
    }

    // Menghapus Admin
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Cari Admin berdasarkan ID
        $user->delete(); // Hapus Admin

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'Admin berhasil dihapus');
    }
}
