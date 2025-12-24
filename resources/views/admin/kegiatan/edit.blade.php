@extends('admin.layout')

@section('content')
<div class="card">
    <h2>Edit Kegiatan</h2>

    <form method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Judul</label><br>
        <input name="judul" value="{{ $kegiatan->judul }}"><br><br>

        <label>Tanggal</label><br>
        <input type="date" name="tanggal"
               value="{{ $kegiatan->tanggal->format('Y-m-d') }}"><br><br>

        <label>Deskripsi</label><br>
        <textarea name="deskripsi" rows="5">{{ $kegiatan->deskripsi }}</textarea><br><br>

        @if($kegiatan->foto)
            @if(Str::endsWith($kegiatan->foto,['mp4','webm']))
                <video src="{{ asset($kegiatan->foto) }}" width="200" controls></video>
            @else
                <img src="{{ asset($kegiatan->foto) }}" width="150">
            @endif
        @endif
        <br><br>

        <label>Ganti Media</label><br>
        <input type="file" name="foto"><br><br>

        <button>Update</button>
    </form>
</div>
@endsection
