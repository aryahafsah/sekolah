@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Daftar Kegiatan (Admin)</h2>

        <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-primary mb-3">Tambah Kegiatan Baru</a>

        @if($kegiatans->count() == 0)
            <p>Belum ada data kegiatan.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kegiatans as $kegiatan)
                        <tr>
                            <td>{{ $kegiatan->judul }}</td>
                            <td>{{ $kegiatan->tanggal }}</td>
                            <td>
                                <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}">Edit</a>
                                |
                                <form action="{{ route('admin.kegiatan.destroy', $kegiatan) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection