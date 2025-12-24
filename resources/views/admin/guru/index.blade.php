@extends('admin.layout')

@section('content')
<h3>Data Guru</h3>

<a href="{{ route('admin.guru.create') }}" class="btn btn-primary mb-3">
    + Tambah Guru
</a>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>

    @foreach ($gurus as $no => $guru)
    <tr>
        <td>{{ $no + 1 }}</td>
        <td>{{ $guru->nama }}</td>
        <td>{{ $guru->nip }}</td>
        <td>{{ $guru->mapel }}</td>
        <td>{{ $guru->jabatan }}</td>
        <td>
            <a href="{{ route('admin.guru.edit', $guru) }}"
               class="btn btn-warning btn-sm">
                Edit
            </a>

            <form action="{{ route('admin.guru.destroy', $guru) }}"
                  method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Hapus data guru?')"
                        class="btn btn-danger btn-sm">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
