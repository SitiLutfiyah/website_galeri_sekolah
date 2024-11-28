@extends('admin.layout')

@section('content')
<div class="container">
   

    <!-- Pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->title }}</td>
                        <td class="d-flex">
                            <button class="btn btn-warning btn-sm me-2" 
                                    onclick="confirmEdit('{{ $category->id }}', '{{ $category->title }}')">
                                <i data-feather="edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm" 
                                    onclick="confirmDelete('{{ $category->id }}', '{{ $category->title }}')">
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
    function confirmDelete(categoryId, categoryTitle) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menghapus kategori " + categoryTitle + "!",
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
                form.action = '/categories/' + categoryId; // Ganti dengan route yang sesuai
                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function confirmEdit(categoryId, categoryTitle) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan mengedit kategori " + categoryTitle + "!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, edit!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke halaman edit
                window.location.href = '/categories/' + categoryId + '/edit'; // Ganti dengan route yang sesuai
            }
        });
    }
</script>

@push('styles')
<style>
    .btn {
        border-radius: 8px;
        padding: 0.5rem 1rem;
    }
    .table td {
        vertical-align: middle;
    }
</style>
@endpush
@endsection
