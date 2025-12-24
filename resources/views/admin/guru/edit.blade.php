@extends('admin.layout')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Guru</h3>

    <form action="{{ route('admin.guru.update', $guru) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" value="{{ $guru->nama }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jk" class="form-control" required>
                <option value="L" {{ $guru->jk == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                <option value="P" {{ $guru->jk == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Guru</label><br>

            @if($guru->foto_guru)
                <img src="{{ asset($guru->foto_guru) }}" width="120" class="mb-2" style="border-radius: 8px;">
            @endif

            <input type="file" name="foto_guru" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
