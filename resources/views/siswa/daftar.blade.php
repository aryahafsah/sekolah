@extends('layouts.app')

@section('content')

<style>
    .card-box {
        background: #ffffff;
        border-radius: 14px;
        padding: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }

    .search-input, .kelas-filter {
        width: 100%;
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        margin-bottom: 16px;
        font-size: 14px;
    }

    .table-wrapper {
        max-height: 420px;
        overflow-y: auto;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #2563eb;
        color: white;
        position: sticky;
        top: 0;
    }

    th, td {
        padding: 12px 14px;
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
        font-size: 14px;
    }

    tr:hover {
        background: #f1f5f9;
    }
</style>

<div class="container mt-4">
    <div class="card-box">
        <h3 style="margin-bottom:16px;">Daftar Siswa</h3>

        {{-- FILTER KELAS --}}
        <select id="kelasFilter" class="kelas-filter">
            <option value="">-- Filter Kelas (Semua) --</option>
            <option value="1">Kelas 1</option>
            <option value="2">Kelas 2</option>
            <option value="3">Kelas 3</option>
            <option value="4">Kelas 4</option>
            <option value="5">Kelas 5</option>
            <option value="6">Kelas 6</option>
        </select>

        {{-- SEARCH --}}
        <input type="text"
               id="searchInput"
               class="search-input"
               placeholder="Cari nama siswa...">

        {{-- TABLE --}}
        <div class="table-wrapper">
            <table id="siswaTable">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswas as $siswa)
                        <tr>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->kelas }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const searchInput = document.getElementById("searchInput");
    const kelasFilter = document.getElementById("kelasFilter");

    function filterTable() {
        let search = searchInput.value.toLowerCase();
        let kelas = kelasFilter.value;
        let rows = document.querySelectorAll("#siswaTable tbody tr");

        rows.forEach(row => {
            let nama = row.cells[0].innerText.toLowerCase();
            let kelasSiswa = row.cells[1].innerText.toLowerCase();

            let matchNama = nama.includes(search);

            // === PERBAIKAN DISINI ===
            let matchKelas = (kelas === "") || kelasSiswa.startsWith(kelas.toLowerCase());

            row.style.display = (matchNama && matchKelas) ? "" : "none";
        });
    }

    searchInput.addEventListener("keyup", filterTable);
    kelasFilter.addEventListener("change", filterTable);
</script>


@endsection
