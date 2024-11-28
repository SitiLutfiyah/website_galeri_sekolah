@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form id="addAdminForm" action="{{ route('users.store') }}" method="POST" onsubmit="return confirmAdd();">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password*</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <small id="passwordHelp" class="form-text text-muted">
                        *Password harus terdiri dari minimal 6 karakter.
                    </small>
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password*</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    <small id="passwordHelp" class="form-text text-muted">
                        *Password harus terdiri dari minimal 6 karakter.
                    </small>
                </div>

                <button type="submit" class="btn btn-primary d-block mx-auto">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmAdd() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menambahkan admin baru!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tambahkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika ya, kirim form
                document.getElementById('addAdminForm').submit();
            }
        });
        return false; // Mencegah pengiriman form secara langsung
    }
</script>
@endsection
