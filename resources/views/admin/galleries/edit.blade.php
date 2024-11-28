@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form id="galleryForm" action="/galleries/{{ $gallery->id }}" method="post" onsubmit="return confirmSubmit();">
                @csrf
                @method('put')
                <div class="form-group mb-3">
                    <label for="post_id">Judul Post</label>
                    <select name="post_id" id="post_id" class="form-control" required>
                        <option value="">Pilih Post</option>
                        @foreach ($posts as $post)
                        <option value="{{ $post->id }}" @if($post->id == $gallery->post_id) selected @endif>{{ $post->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label for="position">Posisi</label>
                            <input type="number" name="position" class="form-control" id="position" required value="{{ $gallery->position }}">
                            <small>Nilai posisi harus berupa angka</small>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="aktif" @if($gallery->status =='aktif') selected @endif>Aktif</option>
                                <option value="tidak-aktif" @if($gallery->status =='tidak-aktif') selected @endif>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary d-block mx-auto">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script>
function confirmSubmit() {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan memperbarui galeri ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, simpan!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('galleryForm').submit();
        }
    });
    return false; // Mencegah pengiriman form secara langsung
}
</script>
@endsection
