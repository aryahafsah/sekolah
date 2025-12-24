@extends('admin.layout')

@section('content')
<div class="container">
    <h3 class="mb-4">Tambah Guru</h3>

    <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jk" class="form-control" required>
                <option value="">-- Pilih JK --</option>
                <option value="L">Laki-laki (L)</option>
                <option value="P">Perempuan (P)</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Guru</label>
            <input type="file" name="foto_guru" class="form-control">
            <small class="text-muted">* Opsional. JPG/PNG maks 2MB.</small>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
