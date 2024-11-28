@extends('admin.layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form id="categoryForm" action="/posts/{{ $post->id }}" method="post" onsubmit="return confirmSubmit();">
                @csrf
                @method('PUT') <!-- Jika Anda melakukan edit, pastikan untuk menyertakan metode PUT -->
                <div class="form-group mb-3">
                    <label for="title">Judul</label>
                    <input type="text" name="title" class="form-control" id="title" required value="{{ $post->title }}">
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="category_id">Kategori</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $post->category_id) selected @endif>{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="publish" @if($post->status == 'publish') selected @endif>Publish</option>
                                <option value="draft" @if($post->status == 'draft') selected @endif>Draft</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="content">Isi</label>
                    <textarea name="content" id="content" class="form-control" required>{{ $post->content }}</textarea>
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
        text: "Anda akan mengedit post " + title + "!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, simpan!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika ya, kirim formulir
            document.getElementById('categoryForm').submit();
        }
    });
    return false; // Mencegah pengiriman form secara langsung
}
</script>
@endsection
