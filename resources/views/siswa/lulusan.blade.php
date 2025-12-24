@extends('layouts.app')

@section('content')

<style>
    .card-box {
        background: #ffffff;
        border-radius: 14px;
        padding: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }

    .search-input {
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
        <h3 style="margin-bottom:16px;">Daftar Lulusan</h3>

        {{-- SEARCH --}}
        <input type="text"
               id="searchInput"
               class="search-input"
               placeholder="Cari nama lulusan...">

        {{-- TABLE --}}
        <div class="table-wrapper">
            <table id="lulusanTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Peserta</th>
                        <th>Nama</th>
                        <th>Tahun Lulus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lulusans as $index => $lulusan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $lulusan->Nomor_Peserta }}</td>
                            <td>{{ $lulusan->Nama }}</td>
                            <td>{{ $lulusan->tahun_lulus }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#lulusanTable tbody tr");

        rows.forEach(row => {
            let nama = row.cells[2].innerText.toLowerCase();
            row.style.display = nama.includes(filter) ? "" : "none";
        });
    });
</script>

@endsection
