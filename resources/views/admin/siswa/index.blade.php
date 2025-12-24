@extends('admin.layout')

@section('content')
<h3>Data Siswa</h3>

<a href="{{ route('admin.siswa.create') }}" class="btn btn-primary mb-3">
    + Tambah Siswa
</a>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIS</th>
        <th>Kelas</th>
        <th>Aksi</th>
    </tr>

    @foreach ($siswas as $no => $siswa)
    <tr>
        <td>{{ $no + 1 }}</td>
        <td>{{ $siswa->nama }}</td>
        <td>{{ $siswa->nis }}</td>
        <td>{{ $siswa->kelas }}</td>
        <td>
            <a href="{{ route('admin.siswa.edit', $siswa) }}" class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('admin.siswa.destroy', $siswa) }}"
                  method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Hapus data?')"
                        class="btn btn-danger btn-sm">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
