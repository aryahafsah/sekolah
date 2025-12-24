@extends('admin.layout')

@section('content')
<h3>Edit Siswa</h3>

<form method="POST" action="{{ route('admin.siswa.update', $siswa) }}">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama"
               value="{{ $siswa->nama }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>NIS</label>
        <input type="text" name="nis"
               value="{{ $siswa->nis }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Kelas</label>
        <input type="text" name="kelas"
               value="{{ $siswa->kelas }}"
               class="form-control">
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection
