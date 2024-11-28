<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileApiController extends Controller
{
    public function index()
    {
        $profiles = Profile::select('id', 'judul', 'isi', 'created_at')->get();
        
        return response()->json([
            'status' => true,
            'data' => $profiles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string'
        ]);

        $profile = Profile::create([
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Profile berhasil ditambahkan',
            'data' => $profile
        ], 201);
    }

    public function show($id)
    {
        $profile = Profile::select('id', 'judul', 'isi', 'created_at')
            ->findOrFail($id);
        
        return response()->json([
            'status' => true,
            'data' => $profile
        ]);
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string'
        ]);

        $profile->update([
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Profile berhasil diperbarui',
            'data' => $profile
        ]);
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return response()->json([
            'status' => true,
            'message' => 'Profile berhasil dihapus'
        ]);
    }
} 