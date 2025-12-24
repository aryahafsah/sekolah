@extends('admin.layout')

@section('title','Dashboard')

@section('content')
<div class="card">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, {{ auth()->user()->name }}</p>

    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-top:20px">
        <div class="card">Galeri</div>
        <div class="card">Kegiatan</div>
        <div class="card">Guru</div>
        <div class="card">Siswa</div>
        <div class="card">Lulusan</div>
    </div>
</div>
@endsection
