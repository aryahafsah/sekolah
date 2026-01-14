<nav style="background:#ffffff;">
    <div style="
        max-width:1200px;
        margin:auto;
        padding:24px 40px;
        display:flex;
        align-items:center;
        justify-content:space-between;
    ">

        {{-- KIRI : LOGO --}}
        <div style="display:flex; align-items:center; gap:14px;">
            <img 
                src="{{ asset('uploads/sdn.png') }}" 
                alt="Logo SDN Joglo 05 Pagi"
                style="width:64px;height:64px;border-radius:50%;object-fit:cover;"
            >
            <span style="font-size:30px;font-weight:800;color:#000;">
                SDN JOGLO 05 PAGI
            </span>
        </div>

        {{-- MENU --}}
        <div style="display:flex; gap:36px; font-weight:700; position:relative;">

            <a href="{{ url('/') }}" class="nav-link">BERANDA</a>

            <a href="{{ route('agenda.index') }}" class="nav-link">
                AGENDA
            </a>

            <a href="{{ route('galeri.index') }}" class="nav-link">
                GALERI
            </a>

            {{-- DROPDOWN PROFIL --}}
            <div class="dropdown">
                <span class="dropbtn">PROFIL ▾</span>

                <div class="dropdown-content">
                    <a href="{{ url('profil/sekolah') }}">Profil Sekolah</a>
                    <a href="{{ route('siswa.daftar') }}">Daftar Siswa</a>
                    <a href="{{ route('guru.daftar') }}">Daftar Guru</a>
                    <a href="{{ url('lulusan') }}">Lulusan</a>
                </div>
            </div>

            {{-- KRITIK & SARAN --}}
            <a href="{{ route('kritik.form') }}" class="nav-link">
                KRITIK & SARAN
            </a>

         </div>
        {{-- ADMIN --}}
        <a href="{{ route('login') }}"
           style="font-weight:600;color:#000;text-decoration:none;">
            masuk admin →
        </a>

    </div>
</nav>

<style>
.nav-link {
    color: #000;
    text-decoration: none;
    position: relative;
}

.nav-link:hover {
    color: #2563eb;
}

/* DROPDOWN */
.dropdown {
    position: relative;
}

.dropbtn {
    cursor: pointer;
}

.dropdown-content {
    display: none;
    position: absolute;
    top: 32px;
    left: 0;
    background: white;
    min-width: 190px;
    box-shadow: 0 8px 25px rgba(0,0,0,.15);
    border-radius: 10px;
    overflow: hidden;
    z-index: 999;
}

.dropdown-content a {
    display: block;
    padding: 12px 16px;
    color: #000;
    text-decoration: none;
    font-weight: 600;
}

.dropdown-content a:hover {
    background: #f3f4f6;
}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
