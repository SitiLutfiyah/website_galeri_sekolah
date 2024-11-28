@extends('admin.layout')

@section('content')
<div class="welcome-section mb-4">
    <div class="card bg-gradient-pro border-0">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="welcome-content">
                        <h4 class="text-white mb-1">
                            Selamat Datang Di Halaman Dashboard {{ Auth::user()->name }}
                        </h4>
                        <p class="text-white-50 mb-0">
                            <i class="fas fa-clock me-2"></i><span id="current-datetime">Loading...</span>
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="quick-stats text-end">
                        <span class="badge bg-white bg-opacity-25 text-white">
                            <i class="fas fa-user-shield me-1"></i>
                            Administrator
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        {{-- Card untuk User --}}
        @include('admin.partials._primary_card', [
            'title' => 'Admin',
            'icon' => 'fas fa-users',
            'count' => $counts['users'],
            'route' => 'users.index',
            'clickable' => true,
            'color' => 'primary'
        ])

        {{-- Card untuk Categories --}}
        @include('admin.partials._primary_card', [
            'title' => 'Kategori',
            'icon' => 'fas fa-cogs',
            'count' => $counts['categories'],
            'route' => 'categories.index',
            'clickable' => true,
            'color' => 'success'
        ])

        {{-- Card untuk Posts --}}
        @include('admin.partials._primary_card', [
            'title' => 'Post',
            'icon' => 'fas fa-upload',
            'count' => $counts['posts'],
            'route' => 'posts.index',
            'clickable' => true,
            'color' => 'info'
        ])

        {{-- Card untuk Galleries --}}
        @include('admin.partials._primary_card', [
            'title' => 'Galeri',
            'icon' => 'fas fa-images',
            'count' => $counts['galleries'],
            'route' => 'galleries.index',
            'clickable' => true,
            'color' => 'warning'
        ])

        {{-- Card untuk Profile --}}
        @include('admin.partials._primary_card', [
            'title' => 'Manajemen Halaman',
            'icon' => 'fas fa-file-alt',
            'count' => $counts['profiles'],
            'route' => 'profiles.index',
            'clickable' => true,
            'color' => 'secondary'
        ])

        {{-- Card untuk Images --}}
        @include('admin.partials._primary_card', [
            'title' => 'Foto',
            'icon' => 'fas fa-image',
            'count' => $counts['images'],
            'clickable' => false,
            'color' => 'danger'
        ])
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endpush
@endsection