@extends('layouts.app')

@section('content')
<style>
    .detail-card {
        background: #fff;
        border-radius: 18px;
        padding: 26px;
        box-shadow: 0 10px 30px rgba(0,0,0,.12);
    }

    .detail-title {
        font-size: 26px;
        font-weight: 800;
        margin-bottom: 18px;
        line-height: 1.3;
    }

    .detail-image-wrapper {
        overflow: hidden;
        border-radius: 16px;
        margin-bottom: 24px;
        box-shadow: 0 8px 22px rgba(0,0,0,.18);
    }

    .detail-image-wrapper img {
        width: 100%;
        max-height: 460px;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .detail-image-wrapper:hover img {
        transform: scale(1.05);
    }

    .detail-content {
        font-size: 15.5px;
        line-height: 1.9;
        color: #444;
        text-align: justify;
    }

    .detail-back {
        display: inline-block;
        margin-top: 26px;
        padding: 10px 18px;
        background: #2563eb;
        color: #fff;
        border-radius: 10px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: background .25s ease, transform .2s ease;
    }

    .detail-back:hover {
        background: #1e40af;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .detail-title {
            font-size: 22px;
        }
    }
</style>

<div class="main-container">

    <div class="detail-card">

        <h2 class="detail-title">{{ $galeri->judul }}</h2>

        @if($galeri->foto)
            <div class="detail-image-wrapper">
                <img src="{{ asset('uploads/galeri/' . $galeri->foto) }}"
                     alt="{{ $galeri->judul }}">
            </div>
        @endif

        <div class="detail-content">
            {!! nl2br(e($galeri->isi_berita)) !!}
        </div>

        <a href="{{ url('/galeri') }}" class="detail-back">
            ← Kembali ke Galeri
        </a>

    </div>

</div>
@endsection
