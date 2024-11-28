@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form id="profileForm" action="/profiles/{{ $profile->id }}" method="post" onsubmit="return confirmSubmit();">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" class="form-control" id="judul" value="{{ $profile->judul }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="isi">Isi</label>
                    <textarea name="isi" class="form-control" id="isi" rows="5" required>{{ $profile->isi }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary d-block mx-auto">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmSubmit() {
        const judul = document.getElementById('judul').value;
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan mengedit halaman " + judul + "!",
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
