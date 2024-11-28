@extends('admin.layout')

@section('content')
<div class="container">


    <!-- Pesan sukses -->
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="{{ route('galleries.create') }}" class="btn btn-primary mb-3">+ Tambah Galeri</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Post</th>
                        <th>Posisi</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($galleries as $gallery)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $gallery->post->title }}</td>
                        <td>{{ $gallery->position }}</td>
                        <td>
                            @if ($gallery->status == 'aktif')
                            <span class="badge bg-success">{{ Str::ucfirst($gallery->status) }}</span>
                            @else
                            <span class="badge bg-warning">{{ Str::ucfirst($gallery->status) }}</span>
                            @endif
                        </td>
                        <td class="d-flex">
                            <a href="/daftargambar/{{ $gallery->id }}" class="btn btn-info btn-sm me-2">
                                <i data-feather="info"></i> Detail
                            </a>
                            <button class="btn btn-warning btn-sm me-2"
                                onclick="confirmEdit('{{ $gallery->id }}', '{{ $gallery->title }}')">
                                <i data-feather="edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm"
                                onclick="confirmDelete('{{ $gallery->id }}', '{{ $gallery->title }}')">
                                <i data-feather="trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmDelete(galleryId, galleryTitle) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan menghapus galeri " + galleryTitle + "!",
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
            form.action = '/galleries/' + galleryId; // Ganti dengan route yang sesuai
            form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
            document.body.appendChild(form);
            form.submit();
        }
    });
}

function confirmEdit(galleryId, galleryTitle) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan mengedit galeri " + galleryTitle + "!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, edit!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect ke halaman edit
            window.location.href = '/galleries/' + galleryId + '/edit'; // Ganti dengan route yang sesuai
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