@extends('admin.layout')

@section('content')
<style>
    .profile-card {
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        text-align: center;
        width: 300px; /* You can adjust the width based on preference */
    }

    .profile-photo img {
        border-radius: 50%; /* Ensures the image is round */
        object-fit: cover;
    }
    
    .container {
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<div class="container">
    <div class="profile-card">
        <!-- Display Profile Photo -->
        <div class="profile-photo mb-3">
            @if ($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="rounded-circle" width="150" height="150">
            @else
                <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Photo" class="rounded-circle" width="150" height="150">
            @endif
        </div>

        <!-- Profile Details -->
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <!-- Form to Update Profile Photo -->
        <form action="{{ route('profile.update-photo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="profile_photo">Update Profile Photo</label>
                <input type="file" name="profile_photo" id="profile_photo" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update Photo</button>
        </form>
    </div>
</div>
@endsection
