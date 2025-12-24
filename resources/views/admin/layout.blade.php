<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Admin')</title>

    <style>
        body {
            margin:0;
            font-family: 'Segoe UI', sans-serif;
            background:#f1f5f9;
        }
        .sidebar {
            width:240px;
            background:#0f172a;
            color:white;
            position:fixed;
            top:0; bottom:0;
            padding:20px;
        }
        .sidebar h2 {
            font-size:18px;
            margin-bottom:30px;
        }
        .sidebar a {
            display:block;
            color:#cbd5f5;
            text-decoration:none;
            padding:10px;
            border-radius:6px;
            margin-bottom:6px;
        }
        .sidebar a:hover {
            background:#1e293b;
            color:white;
        }
        .content {
            margin-left:260px;
            padding:30px;
        }
        .card {
            background:white;
            border-radius:12px;
            padding:20px;
            box-shadow:0 5px 20px rgba(0,0,0,.08);
        }
    </style>

    @yield('styles')
</head>
<body>

<div class="sidebar">
    <h2>Admin Sekolah</h2>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ url('admin/galeri') }}">Galeri</a>
    <a href="{{ url('admin/kegiatan') }}">Kegiatan</a>
    <a href="{{ url('admin/guru') }}">Guru</a>
    <a href="{{ url('admin/siswa') }}">Siswa</a>
    <a href="{{ url('admin/lulusan') }}">Lulusan</a>

    <form method="POST" action="{{ route('logout') }}" style="margin-top:20px">
        @csrf
        <button style="
            width:100%;
            background:#ef4444;
            border:none;
            padding:10px;
            border-radius:6px;
            color:white;
            cursor:pointer;
        ">
            Logout
        </button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
