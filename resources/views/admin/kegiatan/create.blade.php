@extends('admin.layout')

@section('content')
<div class="card">
    <h2>Tambah Kegiatan</h2>

    <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <label>Judul</label><br>
        <input type="text" name="judul" required><br><br>

        <label>Tanggal</label><br>
        <input type="date" name="tanggal" required><br><br>

        <label>Deskripsi</label><br>
        <textarea name="deskripsi" rows="6"></textarea><br><br>

        <label>Foto / Video</label><br>
        <input type="file" name="foto"><br><br>

        <button type="submit">Simpan</button>
    </form>

</div>
@endsection