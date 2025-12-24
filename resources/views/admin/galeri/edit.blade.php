@extends('admin.layout')

@section('content')
<div class="card">
    <h2>Edit Galeri</h2>

    <form method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Judul</label><br>
        <input name="judul" value="{{ $galeri->judul }}"><br><br>

        <label>Berita Singkat</label><br>
        <textarea name="berita singkat">{{ $galeri->berita_singkat }}</textarea><br><br>

        <label>Isi Berita</label><br>
        <textarea name="isi berita" rows="6">{{ $galeri->isi_berita }}</textarea><br><br>

        <img src="{{ asset($galeri->foto) }}" width="150"><br><br>

        <label>Ganti Foto</label><br>
        <input type="file" name="foto"><br><br>

        <button>Update</button>
    </form>
</div>
@endsection
