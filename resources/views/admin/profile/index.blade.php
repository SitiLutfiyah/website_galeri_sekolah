@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mt-0">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4 class="card-title">Profile Saya</h4>
                        <p class="text-muted">Kelola informasi profile Anda di sini</p>
                    </div>
                    
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                @if($user->photo)
                                    <img src="{{ asset('storage/profile-photos/'.$user->photo) }}" 
                                         alt="Profile Photo" 
                                         class="rounded-circle border shadow-sm"
                                         style="width: 200px; height: 200px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle border d-flex align-items-center justify-content-center bg-light"
                                         style="width: 200px; height: 200px;">
                                        <i class="fas fa-user fa-5x text-secondary"></i>
                                    </div>
                                @endif
                                
                                <label for="photo-upload" class="position-absolute bottom-0 end-0 mb-2 me-2">
                                    <div class="btn btn-sm btn-primary rounded-circle p-2">
                                        <i class="fas fa-camera fa-lg"></i>
                                    </div>
                                    <input type="file" id="photo-upload" name="photo" class="d-none" 
                                           onchange="document.getElementById('upload-label').textContent = this.files[0].name">
                                </label>
                            </div>
                            <small id="upload-label" class="text-muted d-block mt-2"></small>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" 
                                       placeholder="Masukkan nama lengkap">
                            </div>
                            @error('name')
                                <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                       placeholder="Masukkan email">
                            </div>
                            @error('email')
                                <small class="text-danger"><i class="fas fa-exclamation-circle"></i> {{ $message }}</small>
                            @enderror
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .container-fluid {
        background-color: #f8f9fa;
        min-height: calc(100vh - 60px);
        padding: 0;
    }
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0,0,0,0.08);
        border-radius: 15px;
        margin-top: 0;
        background: white;
    }
    .card-body {
        padding: 2rem 1.5rem;
    }
    .form-control {
        border-radius: 8px;
        padding: 0.5rem 1rem;
    }
</style>
@endpush
@endsection 