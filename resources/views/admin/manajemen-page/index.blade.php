@extends('admin.layout')

@section('content')
<div class="container">
    <!-- Pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="{{ route('profiles.create') }}" class="btn btn-primary mb-3">+ Tambah Halaman</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Isi</th> <!-- Kolom untuk menampilkan isi halaman -->
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $key => $profile)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $profile->judul }}</td>
                        <td>{{ \Str::limit($profile->isi, 50) }} <!-- Menampilkan isi halaman dengan batasan karakter -->
                        </td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-info btn-sm me-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#profileDetail{{ $profile->id }}">
                                <i data-feather="info"></i> Detail
                            </button>
                            <button class="btn btn-warning btn-sm me-1" 
                                    onclick="confirmEdit('{{ $profile->id }}', '{{ $profile->judul }}')">
                                <i data-feather="edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm" 
                                    onclick="confirmDelete('{{ $profile->id }}', '{{ $profile->judul }}')">
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

<!-- Tambahkan ini sebelum tag script -->
@foreach ($profiles as $profile)
<!-- Modal detail Profile -->
<div class="modal fade" id="profileDetail{{ $profile->id }}" tabindex="-1" aria-labelledby="profileDetail{{ $profile->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="profileDetail{{ $profile->id }}Label">
                    <i data-feather="info"></i> Detail Halaman
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td>{{ $profile->judul }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Dibuat</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($profile->created_at)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td>Isi</td>
                        <td>:</td>
                        <td>{{ $profile->isi }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    function confirmDelete(profileId, profileTitle) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menghapus halaman " + profileTitle + "!",
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
                form.action = '/profiles/' + profileId; // Ganti dengan route yang sesuai
                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function confirmEdit(profileId, profileTitle) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan mengedit halaman " + profileTitle + "!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, edit!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke halaman edit
                window.location.href = '/profiles/' + profileId + '/edit'; // Ganti dengan route yang sesuai
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
