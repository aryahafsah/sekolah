@extends('layouts.app')

@section('content')
<style>
    .page-title {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .btn-add {
        background: #2563eb;
        color: white;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
    }

    .btn-add:hover {
        background: #1e40af;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,.05);
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background: #f3f4f6;
        font-weight: 600;
    }

    img {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
    }

    .btn {
        padding: 6px 10px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-edit {
        background: #f59e0b;
        color: white;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .alert {
        padding: 12px;
        background: #dcfce7;
        color: #166534;
        border-radius: 8px;
        margin-bottom: 15px;
    }
</style>

<div class="container">
    <div class="page-title">📸 Manajemen Galeri</div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

<a href="{{ route('admin.galeri.create') }}" class="btn-add">
    + Tambah Galeri
</a>



    <br><br>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Judul</th>
                <th>Berita Singkat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($galeris as $galeri)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                   @if($galeri->foto)
    <img src="{{ asset('uploads/galeri/' . $galeri->foto) }}">
@else
    -
@endif

                </td>
                <td>{{ $galeri->judul }}</td>
                <td>{{ Str::limit($galeri->berita_singkat, 60) }}</td>
                <td>
<a href="{{ route('admin.galeri.edit', ['galeri' => $galeri->id]) }}"
   class="btn btn-edit">
    Edit
</a>




<form action="{{ route('admin.galeri.destroy', ['galeri' => $galeri->id]) }}"
      method="POST"
      style="display:inline"
      onsubmit="return confirm('Hapus galeri ini?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-delete">Hapus</button>
</form>

            @empty
            <tr>
                <td colspan="5" style="text-align:center; padding:20px">
                    Belum ada data galeri
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
