<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>SDN Joglo 05 Pagi @yield('title', '')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS GLOBAL --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Bootstrap Icons (supaya ikon sosial media muncul) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Jika nanti butuh Font Awesome, aktifkan ini --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> --}}
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    @yield('styles')
</head>

<body class="d-flex flex-column min-vh-100" 
      style="margin:0; background:#f8f9fa; font-family:'Segoe UI', sans-serif;">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- PAGE CONTENT --}}
    <main class="flex-grow-1">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <x-site-footer />

</body>
</html>
