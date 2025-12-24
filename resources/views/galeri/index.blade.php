@extends('layouts.app')

@section('content')
<div style="padding:40px">

    <h2 style="margin-bottom:20px">📷 EkstraKurikuler</h2>

    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(250px,1fr)); gap:20px">

        @foreach($galeris as $g)
        <a href="{{ route('galeri.show', $g->judul) }}"
           style="text-decoration:none; color:black">

            <div style="border:1px solid #ddd; border-radius:10px; overflow:hidden">

                {{-- FOTO --}}
                <img src="{{ asset('uploads/galeri/' . $g->foto) }}"
                     style="width:100%; height:180px; object-fit:cover">

                <div style="padding:15px">
                    <strong>{{ $g->judul }}</strong>

                    {{-- Jika memiliki kolom tanggal, tampilkan seperti agenda --}}
                    @if(!empty($g->tanggal))
                    <div style="font-size:13px; color:gray">
                        {{ \Carbon\Carbon::parse($g->tanggal)->translatedFormat('d F Y') }}
                    </div>
                    @endif
                </div>

            </div>

        </a>
        @endforeach

    </div>

</div>
@endsection
