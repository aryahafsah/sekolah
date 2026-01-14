{{-- resources/views/sekolah/info.blade.php --}}
@extends('layouts.app')

@section('title', $school->name ?? 'Profil Sekolah')
@section('meta_description', $school->meta_description ?? 'Profil lengkap Sekolah Dasar ...')

@section('content')
@php
    // Contoh variabel yang bisa dikirim dari controller:
    // $school (object): name, npsn, address, akreditasi, telp, email, website, hero_image (path)
    // $stats (array): ['guru'=>int,'siswa'=>int,'ruang'=>int,'rombel'=>int]
    // $kurikulum (array of ['title','desc','outcomes'])
    // $prestasi (array of ['tahun','judul','keterangan'])
    // $fasilitas (array of ['icon','title','desc'])
    // $gurus (collection of Guru models: nama,jk,foto,jabatan)
    // $extracurriculars (array of ['title','desc'])
    // $gallery (array of image paths)
@endphp

<style>
/* GENERAL */
.container-wide { max-width: 1200px; margin: 32px auto; padding: 0 20px; }
.section-card { background:#fff;border-radius:12px;padding:22px;box-shadow:0 6px 24px rgba(15,23,42,0.06); margin-bottom:28px; }
.h1 { font-size:28px; font-weight:800; margin:0 0 10px; color:#0f172a; }
.lead { color:#475569; margin-bottom:8px; }

/* HERO */
.hero {
    border-radius:12px;
    overflow:hidden;
    display:flex;
    gap:24px;
    align-items:center;
    background: linear-gradient(90deg, rgba(37,99,235,0.06), rgba(148,163,184,0.02));
}
.hero-left { flex:1; padding:28px; }
.hero-right { width:420px; min-height:220px; position:relative; }
.hero-cover { width:100%; height:100%; object-fit:cover; display:block; }

/* KEY STATS */
.stats-grid { display:flex; gap:12px; margin-top:16px; flex-wrap:wrap; }
.stat {
    background:#fff; padding:14px; border-radius:10px; min-width:140px; text-align:center;
    box-shadow:0 4px 12px rgba(2,6,23,0.04);
}
.stat .num { font-size:20px; font-weight:800; color:#0f172a; }
.stat .label { font-size:13px; color:#64748b; }

/* TWO COLUMNS */
.columns { display:grid; grid-template-columns: 1fr 420px; gap:20px; align-items:start; }

/* CURRICULUM & ACADEMIC */
.kurikulum-item { margin-bottom:14px; }
.kurikulum-item h4 { margin:0 0 6px; font-size:16px; }
.kurikulum-item p { margin:0; color:#475569; font-size:14px; }

/* FACILITIES GRID */
.facilities { display:grid; grid-template-columns:repeat(2,1fr); gap:12px; }
.facility { display:flex; gap:12px; align-items:flex-start; padding:10px; border-radius:8px; background:#f8fafc; }
.facility .icon { width:44px;height:44px;border-radius:8px;background:#e6eefc;display:flex;align-items:center;justify-content:center;font-weight:700;color:#1e40af; }

/* GURU CARDS */
.guru-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:12px; }
.guru-card { display:flex; gap:12px; align-items:center; padding:10px; border-radius:10px; background:#fff; }
.guru-card img { width:72px;height:72px;border-radius:8px; object-fit:cover; }

/* GALLERY */
.gallery-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:10px; }
.gallery-grid img { width:100%; height:140px; object-fit:cover; border-radius:8px; }

/* EXTRACURRICULAR LIST */
.ex-list { display:flex; flex-direction:column; gap:8px; }
.ex-item { padding:12px; background:#f8fafc; border-radius:8px; }

/* RESPONSIVE */
@media (max-width: 980px) {
    .columns { grid-template-columns: 1fr; }
    .hero-right { display:none; } /* optional hide for narrow screens */
    .gallery-grid { grid-template-columns:repeat(2,1fr); }
}
</style>

<!-- JSON-LD (templated; fill with real data from $school) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "School",
  "name": "{{ $school->name ?? 'SDN Joglo 05 Pagi' }}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ $school->address ?? 'Alamat sekolah' }}",
    "addressLocality": "{{ $school->city ?? 'Jakarta Barat' }}",
    "postalCode": "{{ $school->postal_code ?? '' }}"
  },
  "telephone": "{{ $school->telp ?? '' }}",
  "email": "{{ $school->email ?? '' }}",
  "url": "{{ $school->website ?? url('/') }}"
}
</script>

<div class="container-wide">

    {{-- HERO --}}
    <div class="section-card hero" role="region" aria-label="Profil Sekolah">
        <div class="hero-left">
            <h1 class="h1">{{ $school->name ?? 'SDN Negeri Joglo 05 Pagi' }}</h1>
            <p class="lead">{{ $school->tagline ?? 'Mendidik dengan hati, menginspirasi masa depan.' }}</p>

            <div style="display:flex; gap:14px; flex-wrap:wrap; margin-top:10px;">
                <div style="min-width:220px">
                    <div style="color:#64748b;font-weight:700;font-size:13px">NPSN</div>
                    <div style="font-weight:800;font-size:16px">{{ $school->npsn ?? '20105254' }}</div>
                </div>
                <div style="min-width:220px">
                    <div style="color:#64748b;font-weight:700;font-size:13px">Akreditasi</div>
                    <div style="font-weight:800;font-size:16px">{{ $school->akreditasi ?? 'A' }}</div>
                </div>
            </div>

            {{-- key stats --}}
            <div class="stats-grid" style="margin-top:18px;">
                <div class="stat"><div class="num">{{ $stats['guru'] ?? ($gurus->count() ?? '—') }}</div><div class="label">Guru</div></div>
                <div class="stat"><div class="num">{{ $stats['siswa'] ?? '—' }}</div><div class="label">Siswa</div></div>
                <div class="stat"><div class="num">{{ $stats['rombel'] ?? '—' }}</div><div class="label">Rombel</div></div>
                <div class="stat"><div class="num">{{ $stats['ruang'] ?? '—' }}</div><div class="label">Ruang Kelas</div></div>
            </div>

            <div style="margin-top:18px;">
                <a href="mailto:{{ $school->email ?? 'email@sekolah.sch.id' }}" style="text-decoration:none;color:#2563eb;font-weight:700;">Hubungi Sekolah</a>
                <span style="margin-left:12px;color:#64748b;">| {{ $school->telp ?? '(021) 000000' }}</span>
            </div>
        </div>

        <div class="hero-right">
            <img src="{{ asset($school->hero_image ?? 'uploads/header.jpg') }}" alt="Foto sekolah" class="hero-cover">
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="columns">

        {{-- LEFT: detail panjang --}}
        <div>

            {{-- Tentang & visi misi --}}
            <div class="section-card">
                <h2 class="h1">Tentang Sekolah</h2>
                <p style="color:#475569;">
                    {!! $school->about_html ?? ('<strong>' . ($school->name ?? 'SDN Joglo 05 Pagi') . '</strong>') !!}
                </p>

                <div style="display:flex; gap:20px; margin-top:12px; flex-wrap:wrap;">
                    <div style="min-width:180px;">
                        <div style="color:#64748b;font-weight:700;font-size:13px">Alamat</div>
                        <div style="font-weight:700">{{ $school->address ?? 'Joglo, Kembangan, Jakarta Barat' }}</div>
                    </div>
                    <div style="min-width:180px;">
                        <div style="color:#64748b;font-weight:700;font-size:13px">Email</div>
                        <div style="font-weight:700">{{ $school->email ?? 'info@sekolah.sch.id' }}</div>
                    </div>
                    <div style="min-width:180px;">
                        <div style="color:#64748b;font-weight:700;font-size:13px">Website</div>
                        <div style="font-weight:700">{{ $school->website ?? url('/') }}</div>
                    </div>
                </div>
            </div>

            {{-- Akademik & Kurikulum --}}
            <div class="section-card">
                <h2 class="h1">Akademik & Kurikulum</h2>

                <p style="color:#475569;">Sekolah menerapkan kurikulum nasional (Kurikulum Merdeka / Kurikulum 2013 — sesuaikan) dengan penekanan pada pembelajaran aktif, literasi, numerasi, dan kecakapan abad 21.</p>

                @if(!empty($kurikulum))
                    @foreach($kurikulum as $k)
                        <div class="kurikulum-item">
                            <h4>{{ $k['title'] }}</h4>
                            <p>{{ $k['desc'] }}</p>
                            @if(!empty($k['outcomes']))
                                <small style="color:#64748b;">Learning outcomes: {{ implode(', ', $k['outcomes']) }}</small>
                            @endif
                        </div>
                    @endforeach
                @else
                    {{-- contoh isi default --}}
                    <div class="kurikulum-item">
                        <h4>Pembelajaran Tematik Integratif</h4>
                        <p>Untuk kelas 1–3, menggunakan pendekatan tematik yang menggabungkan beberapa muatan pelajaran dalam satu tema.</p>
                    </div>
                    <div class="kurikulum-item">
                        <h4>Pembelajaran Berbasis Proyek</h4>
                        <p>Proyek sains, literasi, dan kewirausahaan sederhana diikutsertakan untuk meningkatkan kompetensi praktis siswa.</p>
                    </div>
                @endif

                {{-- Penilaian --}}
                <div style="margin-top:12px;">
                    <h4>Penilaian & Evaluasi</h4>
                    <p style="color:#475569;">Sekolah menggunakan kombinasi penilaian formatif dan sumatif, rubrik keterampilan, dan portofolio. Nilai akhir memadukan aspek kognitif, afektif, dan psikomotor.</p>
                </div>

                {{-- Kalender singkat --}}
                <div style="margin-top:12px;">
                    <h4>Kalender Akademik (ringkas)</h4>
                    <ul style="color:#475569;">
                        <li>Semester 1: Juli — Desember</li>
                        <li>Semester 2: Januari — Juni</li>
                        <li>Ulangan Tengah Semester & Ulangan Akhir Semester sesuai jadwal tahunan</li>
                    </ul>
                    <small style="color:#64748b;">(Lengkapi dengan file kalender akademik resmi bila tersedia)</small>
                </div>
            </div>

            {{-- Prestasi --}}
            <div class="section-card">
                <h2 class="h1">Prestasi & Penghargaan</h2>
                @if(!empty($prestasi))
                    <ul style="color:#475569;">
                        @foreach($prestasi as $p)
                            <li><strong>{{ $p['tahun'] }}</strong> — {{ $p['judul'] }} @if(!empty($p['ket'])) — <em>{{ $p['ket'] }}</em>@endif</li>
                        @endforeach
                    </ul>
                @else
                    <p style="color:#475569;">Beberapa prestasi sekolah: juara lomba kebersihan antar SD tingkat kecamatan, pemenang lomba cerdas cermat tingkat kota (tahun terakhir). (Isi berdasarkan data resmi sekolah.)</p>
                @endif
            </div>

            {{-- Ekstrakurikuler --}}
            <div class="section-card">
                <h2 class="h1">Ekstrakurikuler</h2>
                @if(!empty($extracurriculars))
                    <div class="ex-list">
                        @foreach($extracurriculars as $ex)
                            <div class="ex-item"><strong>{{ $ex['title'] }}</strong> — <span style="color:#475569">{{ $ex['desc'] }}</span></div>
                        @endforeach
                    </div>
                @else
                    <div class="ex-list">
                        <div class="ex-item"><strong>Pramuka</strong> — Pengembangan kepemimpinan & ketrampilan lapangan.</div>
                        <div class="ex-item"><strong>Marawis / Musik</strong> — Seni & kebudayaan.</div>
                        <div class="ex-item"><strong>Olah Raga</strong> — Sepak bola, voli, atletik sederhana.</div>
                    </div>
                @endif
            </div>

            {{-- Galeri --}}
            <div class="section-card">
                <h2 class="h1">Galeri Kegiatan</h2>
                <div class="gallery-grid">
                    @if(!empty($gallery))
                        @foreach($gallery as $img)
                            <img src="{{ asset($img) }}" alt="Galeri">
                        @endforeach
                    @else
                        {{-- placeholder --}}
                        <img src="{{ asset('uploads/placeholder1.jpg') }}" alt="galeri">
                        <img src="{{ asset('uploads/placeholder2.jpg') }}" alt="galeri">
                        <img src="{{ asset('uploads/placeholder3.jpg') }}" alt="galeri">
                        <img src="{{ asset('uploads/placeholder4.jpg') }}" alt="galeri">
                    @endif
                </div>
            </div>

        </div>

        {{-- RIGHT: ringkasan cepat, fasilitas, guru --}}
        <aside>
            {{-- Fasilitas --}}
            <div class="section-card">
                <h3 style="margin:0 0 10px;">Fasilitas</h3>
                <div class="facilities">
                    @if(!empty($fasilitas))
                        @foreach($fasilitas as $f)
                        <div class="facility">
                            <div class="icon">{!! $f['icon'] ?? '&#x1F3EB;' !!}</div>
                            <div>
                                <div style="font-weight:700">{{ $f['title'] }}</div>
                                <div style="color:#64748b;font-size:13px">{{ $f['desc'] }}</div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="facility"><div class="icon">🏫</div><div><div style="font-weight:700">Ruang Kelas</div><div style="color:#64748b;font-size:13px">Ruang belajar representatif</div></div></div>
                        <div class="facility"><div class="icon">💻</div><div><div style="font-weight:700">Labor Komputer</div><div style="color:#64748b;font-size:13px">Untuk pembelajaran digital</div></div></div>
                        <div class="facility"><div class="icon">⚽</div><div><div style="font-weight:700">Lapangan Olahraga</div><div style="color:#64748b;font-size:13px">Untuk ekstrakurikuler & olahraga</div></div></div>
                        <div class="facility"><div class="icon">📚</div><div><div style="font-weight:700">Perpustakaan</div><div style="color:#64748b;font-size:13px">Program literasi & peminjaman</div></div></div>
                    @endif
                </div>
            </div>

            {{-- Guru unggulan --}}
            <div class="section-card">
                <h3 style="margin:0 0 10px;">Guru Unggulan</h3>
                <div class="guru-grid">
                    @if(!empty($gurus) && $gurus->count())
                        @foreach($gurus->take(4) as $g)
                        <div class="guru-card">
                            <img src="{{ asset($g->foto ?? 'uploads/default-guru.png') }}" alt="{{ $g->nama }}">
                            <div>
                                <div style="font-weight:700">{{ $g->nama }}</div>
                                <div style="color:#64748b;font-size:13px">{{ $g->jabatan ?? ($g->mapel ?? 'Guru Kelas') }}</div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="guru-card">
                            <img src="{{ asset('uploads/default-guru.png') }}" alt="Default">
                            <div><div style="font-weight:700">Nama Guru</div><div style="color:#64748b;font-size:13px">Mapel / Jabatan</div></div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Kontak singkat --}}
            <div class="section-card">
                <h3 style="margin:0 0 10px;">Kontak Cepat</h3>
                <div style="color:#475569;">
                    <div style="font-weight:700">{{ $school->name ?? 'SDN Joglo 05 Pagi' }}</div>
                    <div style="font-size:13px;color:#64748b;margin-bottom:6px">{{ $school->address ?? 'Alamat sekolah' }}</div>
                    <div style="font-weight:700">{{ $school->telp ?? '(021) 000000' }}</div>
                    <div style="font-size:13px;color:#64748b">{{ $school->email ?? 'info@sekolah.sch.id' }}</div>
                    <div style="margin-top:10px;"><a href="{{ $school->website ?? '#' }}" style="color:#2563eb;font-weight:700;">Kunjungi website</a></div>
                </div>
            </div>

            {{-- Download (placeholder) --}}
            <div class="section-card">
                <h3 style="margin:0 0 10px;">Dokumen Penting</h3>
                <ul style="color:#475569; padding-left:18px;">
                    <li><a href="{{ asset('files/kalender_akademik.pdf') }}" target="_blank">Kalender Akademik (PDF)</a></li>
                    <li><a href="{{ asset('files/kurikulum.pdf') }}" target="_blank">Ringkasan Kurikulum</a></li>
                    <li><a href="{{ asset('files/akreditasi.pdf') }}" target="_blank">Sertifikat Akreditasi</a></li>
                </ul>
            </div>
        </aside>
    </div>

</div>

<script>
/* small enhancement: click image to open in centered modal (simple lightbox) */
(function(){
    document.addEventListener('click', function(e){
        if(e.target.tagName === 'IMG' && e.target.closest('.gallery-grid')){
            const src = e.target.getAttribute('src');
            const modal = document.createElement('div');
            modal.style.position='fixed';
            modal.style.inset='0';
            modal.style.background='rgba(0,0,0,0.85)';
            modal.style.display='flex';
            modal.style.alignItems='center';
            modal.style.justifyContent='center';
            modal.style.zIndex='99999';
            modal.addEventListener('click', function(){ modal.remove(); });
            const img = document.createElement('img');
            img.src = src;
            img.style.maxWidth='90%';
            img.style.maxHeight='90%';
            img.style.borderRadius='8px';
            modal.appendChild(img);
            document.body.appendChild(modal);
        }
    });
})();
</script>

@endsection
