@extends('admin.layout')

@section('content')
<div class="container">
    
    <!-- Pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">+ Tambah Admin</a>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="d-flex">
                    <button class="btn btn-warning btn-sm me-2" 
                            onclick="confirmEdit('{{ $user->id }}', '{{ $user->name }}')">
                        <i data-feather="edit"></i> Edit
                    </button>
                    <button class="btn btn-danger btn-sm" 
                            onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')">
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
    function confirmDelete(userId, userName) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menghapus admin " + userName + "!",
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
                form.action = '/users/' + userId; // Ganti dengan route yang sesuai
                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function confirmEdit(userId, userName) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan mengedit admin " + userName + "!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, edit!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke halaman edit
                window.location.href = '/users/' + userId + '/edit'; // Ganti dengan route yang sesuai
            }
        });
    }
</script>
@endsection

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
