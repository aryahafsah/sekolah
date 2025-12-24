@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('styles')
<style>
    body {
        background: #f4f6f9;
        font-family: "Segoe UI", sans-serif;
    }

    /* HERO */
    .hero-section {
        background: url('/uploads/header.jpg') center / cover no-repeat;
        padding: 110px 20px;
        color: white;
        text-align: center;
        position: relative;
    }
    .hero-section::after {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.15);
    }
    .hero-content {
        position: relative;
        max-width: 750px;
        margin: auto;
    }
    .hero-title {
        font-size: 42px;
        font-weight: 800;
    }
    .hero-sub {
        font-size: 18px;
        color: #e2e8f0;
    }

    .main-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .section-card {
        background: white;
        border-radius: 14px;
        padding: 32px;
        margin-bottom: 40px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }
    .section-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #1e293b;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3,1fr);
        gap: 20px;
    }
    .stats-box {
        background: #2563eb;
        color: white;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
    }
    .stats-number {
        font-size: 38px;
        font-weight: 800;
    }

    .kegiatans-scroll {
        display: flex;
        gap: 16px;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    .kegiatans-card {
        min-width: 260px;
        background: #f8fafc;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    .kegiatans-date {
        font-size: 13px;
        color: #2563eb;
        font-weight: 600;
    }
    .kegiatans-title {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(4,1fr);
        gap: 12px;
    }
    .gallery-grid img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-radius: 10px;
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Selamat Datang di Website SDN 05 Pagi Joglo</h1>
        <p class="hero-sub">Portal informasi resmi sekolah</p>
    </div>
</div>

<div class="main-container">

{{-- STATISTIK --}}
<div class="section-card">
    <h2 class="section-title">Data Statistik</h2>
    <div class="stats-grid">
        <div class="stats-box">
            <div class="stats-number">{{ $jumlahGuru ?? 0 }}</div>
            Guru
        </div>
        <div class="stats-box">
            <div class="stats-number">{{ $jumlahSiswa ?? 0 }}</div>
            Siswa
        </div>
        <div class="stats-box">
            <div class="stats-number">{{ $jumlahRombel ?? 0 }}</div>
            Rombel
        </div>
    </div>
</div>

{{-- KEGIATAN --}}
<div class="section-card">
    <h2 class="section-title">Kegiatan Sekolah</h2>

    <div class="kegiatans-scroll">
        @foreach($kegiatans ?? [] as $item)
            <a href="{{ route('agenda.show', $item->id) }}" style="text-decoration:none;color:inherit;">
                <div class="kegiatans-card">
                    @if($item->foto)
                        @if(Str::endsWith($item->foto, ['.mp4','.webm']))
                            <video src="{{ asset($item->foto) }}" controls style="width:100%;height:160px;object-fit:cover;"></video>
                        @else
                            <img src="{{ asset($item->foto) }}" style="width:100%;height:160px;object-fit:cover;">
                        @endif
                    @endif

                    <div style="padding:14px">
                        <div class="kegiatans-date">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </div>
                        <div class="kegiatans-title">{{ $item->judul }}</div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>


<div class="section-card">
    

    <div class="kegiatans-scroll">
        @foreach($agendas ?? [] as $agenda)
            <a href="{{ route('agenda.show', $agenda->id) }}" style="text-decoration:none;color:inherit;">
                <div class="kegiatans-card">
                    @if($agenda->foto)
                        @if(Str::endsWith($agenda->foto, ['.mp4','.webm']))
                            <video src="{{ asset($agenda->foto) }}" controls style="width:100%;height:160px;object-fit:cover;"></video>
                        @else
                            <img src="{{ asset($agenda->foto) }}" style="width:100%;height:160px;object-fit:cover;">
                        @endif
                    @endif

                    <div style="padding:14px">
                        <div class="kegiatans-date">
                            {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}
                        </div>
                        <div class="kegiatans-title">{{ $agenda->judul }}</div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>

{{-- GALERI --}}
<div class="section-card">
    <h2 class="section-title">Galeri Foto</h2>

    <div class="gallery-grid">
        @foreach($galeris ?? [] as $g)
            <a href="{{ route('galeri.show', $g->judul) }}" style="text-decoration:none;color:inherit;">
                <div>
                   <img src="{{ asset('uploads/galeri/' . $g->foto) }}"
                     alt="{{ $g->judul }}">
                    <div style="padding:8px">
                        <strong>{{ $g->judul }}</strong><br>
                        <small>{{ $g->berita_singkat }}</small>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div style="text-align:right;margin-top:10px">
        <a href="{{ route('galeri.index') }}" style="color:#2563eb;font-weight:600;">
            Lihat Semua Galeri →
        </a>
    </div>
</div>

</div>
@endsection
