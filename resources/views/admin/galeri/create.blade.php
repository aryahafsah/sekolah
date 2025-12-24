@extends('admin.layout')

@section('content')
<div class="card">
    <h2>Tambah Galeri</h2>

    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Judul</label><br>
    <input name="judul" required><br><br>

    <label>Berita Singkat</label><br>
    <textarea name="berita singkat"></textarea><br><br>

    <label>Isi Berita</label><br>
    <textarea name="isi berita" rows="6"></textarea><br><br>

    <label>Foto</label><br>
    <input type="file" name="foto" required><br><br>

    <button type="submit">Simpan</button>
</form>

</div>
@endsection
