@extends('layouts.app')

@section('content')
<div style="max-width:900px; margin:auto; padding:40px">

    <a href="{{ route('agenda.index') }}">← Kembali ke Agenda</a>

    <h1 style="margin:20px 0">{{ $kegiatan->judul }}</h1>

    <div style="color:gray; margin-bottom:20px">
        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}
    </div>

    @if($kegiatan->foto)
        @if(Str::endsWith($kegiatan->foto, ['.mp4']))
            <video src="{{ asset($kegiatan->foto) }}" controls style="width:100%; border-radius:10px"></video>
        @else
            <img src="{{ asset($kegiatan->foto) }}" style="width:100%; border-radius:10px">
        @endif
    @endif

    <div style="margin-top:30px; line-height:1.8">
        {!! nl2br(e($kegiatan->deskripsi)) !!}
    </div>

</div>
@endsection
