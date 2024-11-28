@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form id="categoryForm" action="/categories" method="post" onsubmit="return confirmSubmit();">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Judul</label>
                    <input type="text" name="title" class="form-control" id="title" required>
                </div>

                <button type="submit" class="btn btn-primary d-block mx-auto">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmSubmit() {
        const title = document.getElementById('title').value;
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan menambahkan kategori " + title + "!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('categoryForm').submit();
            }
        });
        return false; // Mencegah pengiriman form secara langsung
    }
</script>
@endsection
