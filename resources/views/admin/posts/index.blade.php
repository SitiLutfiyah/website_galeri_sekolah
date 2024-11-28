@extends('admin.layout')

@section('content')

<!-- Pesan sukses -->
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">+ Tambah Post</a>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Petugas</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $key => $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        @if (Str::lower($post->status) == 'publish')
                        <span class="badge bg-success text-white">{{ Str::ucfirst($post->status) }}</span>
                        @else
                        <span class="badge bg-warning text-white">{{ Str::ucfirst($post->status) }}</span>
                        @endif
                    </td>
                    <td class="d-flex">
                        <button type="button" class="btn btn-info btn-sm me-2" 
                                data-bs-toggle="modal" 
                                data-bs-target="#postDetail{{ $post->id }}">
                            <i data-feather="info"></i> Detail
                        </button>
                        <button class="btn btn-warning btn-sm me-2" 
                                onclick="confirmEdit('{{ $post->id }}', '{{ $post->title }}')">
                            <i data-feather="edit"></i> Edit
                        </button>
                        <button class="btn btn-danger btn-sm" 
                                onclick="confirmDelete('{{ $post->id }}', '{{ $post->title }}')">
                            <i data-feather="trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach ($posts as $post)

<!-- Modal detail Post-->
<div class="modal fade" id="postDetail{{ $post->id }}" tabindex="-1" aria-labelledby="postDetail{{ $post->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="postDetail{{ $post->id }}Label"><i data-feather="info"></i>Detail Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Dibuat</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td>Dibuat Oleh</td>
                        <td>:</td>
                        <td>{{ $post->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>{{ Str::ucfirst($post->status) }}</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td>{{ $post->category->title }}</td>
                    </tr>
                    <tr>
                        <td>Isi</td>
                        <td>:</td>
                        <td>{{ $post->content }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
function confirmDelete(postId, postTitle) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan menghapus post " + postTitle + "!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika ya, buat form dan kirim
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/posts/' + postId; // Ganti dengan route yang sesuai
            form.innerHTML =
                '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                '<input type="hidden" name="_method" value="DELETE">';
            document.body.appendChild(form);
            form.submit();
        }
    });
}

function confirmEdit(postId, postTitle) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan mengedit post " + postTitle + "!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, edit!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect ke halaman edit
            window.location.href = '/posts/' + postId + '/edit'; // Ganti dengan route yang sesuai
        }
    });
}
</script>

@push('styles')
<style>
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        line-height: 1.5;
        border-radius: 4px;
    }

    .table td {
        vertical-align: middle;
        font-size: 0.875rem;
    }

    .btn-sm i {
        width: 14px;
        height: 14px;
        stroke-width: 2.5;
    }
</style>
@endpush
@endsection