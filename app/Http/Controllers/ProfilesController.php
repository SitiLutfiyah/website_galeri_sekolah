<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
   
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            \Log::info('Upload started');
            
            if ($user->photo && Storage::exists('public/profile-photos/' . $user->photo)) {
                Storage::delete('public/profile-photos/' . $user->photo);
                \Log::info('Old photo deleted: ' . $user->photo);
            }
            
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            
            Storage::makeDirectory('public/profile-photos');
            
            $path = $photo->storeAs('public/profile-photos', $photoName);
            \Log::info('New photo uploaded: ' . $path);
            
            $user->photo = $photoName;
            
            // Tambahkan ini untuk copy file ke public
            $sourcePath = storage_path('app/public/profile-photos/' . $photoName);
            $destinationPath = public_path('storage/profile-photos/' . $photoName);
            
            // Pastikan folder tujuan ada
            if (!file_exists(public_path('storage/profile-photos'))) {
                mkdir(public_path('storage/profile-photos'), 0777, true);
            }
            
            // Copy file
            copy($sourcePath, $destinationPath);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Profile berhasil diperbarui');
    }

    public function removePhoto()
    {
        $user = Auth::user();
        
        if ($user->photo) {
            // Hapus file foto
            Storage::delete('public/profile-photos/' . $user->photo);
            
            // Hapus referensi foto di database
            $user->photo = null;
            $user->save();
            
            return redirect()->back()->with('success', 'Foto profile berhasil dihapus');
        }
        
        return redirect()->back()->with('error', 'Tidak ada foto profile untuk dihapus');
    }
}
