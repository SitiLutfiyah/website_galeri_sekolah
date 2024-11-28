@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form id="profileForm" action="{{ route('profiles.store') }}" method="POST" onsubmit="return confirmSubmit();">
                @csrf
                <div class="form-group mb-3">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" class="form-control" id="judul" required>
                </div>

                <div class="form-group mb-3">
                    <label for="isi">Isi</label>
                    <textarea name="isi" class="form-control" id="isi" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary d-block mx-auto">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmSubmit() {
        const judul = document.getElementById('judul').value;
        const isi = document.getElementById('isi').value;
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menambahkan halaman '" + judul + "' dengan isi: " + isi.substr(0, 50) + "...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('profileForm').submit();
            }
        });
        return false; // Mencegah pengiriman form secara langsung
    }
</script>
@endsection
