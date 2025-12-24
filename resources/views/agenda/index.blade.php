@extends('layouts.app')

@section('content')
<div style="padding:40px">

    <h2 style="margin-bottom:20px">📅 Agenda & Kegiatan Sekolah</h2>

    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(250px,1fr)); gap:20px">
        @foreach($kegiatans as $item)
        <a href="{{ route('agenda.show', $item->id) }}"
           style="text-decoration:none; color:black">

            <div style="border:1px solid #ddd; border-radius:10px; overflow:hidden">
                @if($item->foto)
                    @if(Str::endsWith($item->foto, ['.mp4']))
                        <video src="{{ asset($item->foto) }}" controls style="width:100%; height:180px; object-fit:cover"></video>
                    @else
                        <img src="{{ asset($item->foto) }}" style="width:100%; height:180px; object-fit:cover">
                    @endif
                @endif

                <div style="padding:15px">
                    <strong>{{ $item->judul }}</strong>
                    <div style="font-size:13px; color:gray">
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>

        </a>
        @endforeach
    </div>

</div>
@endsection
