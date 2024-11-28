@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form id="editAdminForm" action="{{ route('users.update', $user->id) }}" method="POST" onsubmit="return confirmUpdate();">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password (opsional)*</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small id="passwordHelp" class="form-text text-muted">
                        *Password harus terdiri dari minimal 6 karakter.
                    </small>
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password (opsional)*</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
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
    function confirmUpdate() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan memperbarui informasi admin!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, perbarui!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('editAdminForm').submit(); // Pastikan form disubmit
            }
        });
        return false; // Mencegah pengiriman form secara langsung
    }
</script>
@endsection
