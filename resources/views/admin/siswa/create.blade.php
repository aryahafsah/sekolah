@extends('admin.layout')

@section('content')
<h3>Tambah Siswa</h3>

<form method="POST" action="{{ route('admin.siswa.store') }}">
    @csrf

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control">
    </div>

    <div class="mb-3">
        <label>NIS</label>
        <input type="text" name="nis" class="form-control">
    </div>

    <div class="mb-3">
        <label>Kelas</label>
        <input type="text" name="kelas" class="form-control">
    </div>

    <button class="btn btn-success">Simpan</button>
</form>
@endsection
