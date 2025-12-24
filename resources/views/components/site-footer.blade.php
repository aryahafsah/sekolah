<footer class="footer">
    <style>
        .footer {
            background: #000;
            color: #fff;
            padding: 60px 0;
            font-family: 'Segoe UI', sans-serif;
        }
        .footer-container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 40px;
        }
        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        .footer-logo {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
        }
        .footer h3 { font-size: 18px; }
        .footer h4 {
            margin-bottom: 15px;
            font-size: 16px;
        }
        .footer-menu {
            list-style: none;
            padding: 0;
        }
        .footer-menu li { margin-bottom: 8px; }
        .footer-menu a {
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }
        .footer-menu a:hover { color: #fff; }
        .visitor-box {
            border: 1px solid #555;
            border-radius: 6px;
            padding: 15px;
        }
        .visitor-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px dashed #444;
            font-size: 14px;
        }
        .visitor-row:last-child { border-bottom: none; }
        .social-icons {
            display: flex;
            gap: 15px;
            font-size: 26px;
        }
        .social-icons a {
            color: #fff;
            transition: 0.3s;
        }
        .social-icons a:hover { color: #4ade80; }
        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr; }
        }
    </style>

    @php
        use App\Models\Visitor;
        $total = Visitor::where('page', 'site')->value('count') ?? 0;
    @endphp

    <div class="footer-container">
        <div class="footer-grid">

            <!-- KIRI -->
            <div>
                <div class="footer-brand">
                    <img src="{{ asset('uploads/sdn.png') }}" alt="Logo SDN Joglo 05 Pagi" class="footer-logo">
                    <h3>SDN Joglo 05 Pagi</h3>
                </div>

                <h4>Profil Sekolah</h4>
                <ul class="footer-menu">
                    <li><a href="{{ url('/profil') }}">Profil Sekolah</a></li>
                    <li><a href="{{ url('/galeri') }}">Galeri</a></li>
                    <li><a href="{{ url('/kegiatan') }}">Kegiatan</a></li>
                    <li><a href="{{ url('/daftar-guru') }}">Daftar Guru</a></li>
                    <li><a href="{{ url('/siswa') }}">Daftar Siswa</a></li>
                    <li><a href="{{ url('/lulusan') }}">Lulusan</a></li>
                </ul>
            </div>

            <!-- TENGAH -->
            <div>
                <h4>Statistik Pengunjung</h4>
                <div class="visitor-box">
                    <div class="visitor-row">
                        <span>Total Pengunjung</span>
                        <span>{{ number_format($total) }}</span>
                    </div>
                </div>
            </div>

            <!-- KANAN -->
            <div>
    <h4>Sosial Media</h4>
    <div class="social-icons">
        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
        <a href="#"><i class="fa-brands fa-youtube"></i></a>
    </div>
</div>


                <!-- BAGIAN BARU : KONTAK KAMI -->
                <h4 style="margin-top:25px;">Kontak Kami</h4>
                <ul class="footer-menu">
                    <li><a>📧 Email: sdn.joglo05pg@gmail.com</a></li>
                    <li><a>📞 Telepon: (021) 22541652 </a></li>
                </ul>
            </div>

        </div>
    </div>
</footer>
