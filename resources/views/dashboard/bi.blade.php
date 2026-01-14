@extends('layouts.app')

@section('content')
<style>
    .card { border-radius: 14px; }
    .chart-container { position: relative; height: 350px; }
</style>

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
        <h2 class="mb-2 mb-md-0 fw-bold">Dashboard Absensi Guru</h2>

        <div class="text-muted">
            <strong>Periode:</strong>
            {{ DateTime::createFromFormat('!m', request('bulan', 1))->format('F') }}
            {{ request('tahun', 2026) }}
        </div>
    </div>

    <!-- FILTER -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard.bi') }}" class="row g-3 align-items-end">

                <!-- Filter Bulan -->
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Bulan</label>
                    <select name="bulan" class="form-select">
                        @foreach (range(1, 12) as $b)
                            <option value="{{ $b }}"
                                {{ request('bulan', 1) == $b ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Tahun -->
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Tahun</label>
                    <select name="tahun" class="form-select">
                        @foreach (range(2023, date('Y') + 1) as $t)
                            <option value="{{ $t }}"
                                {{ request('tahun', 2026) == $t ? 'selected' : '' }}>
                                {{ $t }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Guru -->
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Guru</label>
                    <select name="guru" class="form-select">
                        <option value="">Semua Guru</option>
                        @foreach ($listGuru as $g)
                            <option value="{{ $g }}"
                                {{ request('guru') == $g ? 'selected' : '' }}>
                                {{ $g }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Filter -->
                <div class="col-md-3">
                    <button class="btn btn-primary w-100 fw-bold">
                        Terapkan Filter
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- KPI / Ringkasan -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 14px;">
        <div class="card-header bg-white border-0 pt-4 pb-2">
            <h5 class="fw-bold mb-0">Ringkasan Kehadiran Guru</h5>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered text-center align-middle mb-0 kpi-table">
                <thead class="table-light">
                    <tr>
                        <th>Rata-rata Kehadiran</th>
                        <th>Guru Terbaik</th>
                        <th>Guru Perlu Perhatian</th>
                        <th>Total Hari Kerja</th>
                    </tr>
                </thead>

                <tbody>
                    <tr style="font-size: 1.2rem;">
                        <td class="fw-semibold text-primary">
                            {{ number_format($rataHadir, 2) }}%
                        </td>
                        <td class="fw-semibold text-success">
                            {{ $guruTerbaik->nama_guru }}
                        </td>
                        <td class="fw-semibold text-danger">
                            {{ $guruTerendah->nama_guru }}
                        </td>
                        <td class="fw-semibold">
                            23
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<style>
    .kpi-table th, .kpi-table td {
        padding: 20px 10px;
        font-size: 1.05rem;
    }
    .kpi-table thead th {
        background: #f5f6fa !important;
        font-weight: 600;
    }
    .kpi-table tbody tr:hover {
        background: #f9fafc !important;
    }
    .card {
        border-radius: 14px !important;
    }
</style>

    <!-- Top Charts -->
    <div class="row g-4">

        <!-- Bar Chart -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">Persentase Kehadiran Guru</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="kehadiranGuruChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-info text-white fw-bold">Proporsi Status</div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div style="width: 80%;"><canvas id="proporsiStatusChart"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Line Chart -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white fw-bold">Tren Kehadiran Harian</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="trenHarianChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const guruLabels = @json($kehadiranPerGuru->pluck('nama_guru'));
const guruPersen = @json($kehadiranPerGuru->pluck('persen_hadir'));

const statusLabels = @json($proporsiStatus->pluck('status'));
const statusJumlah = @json($proporsiStatus->pluck('jumlah'));

const trenTanggal = @json($trenBulanan->pluck('tanggal_hari'));
const trenHadir = @json($trenBulanan->pluck('hadir_harian'));

// BAR
new Chart(document.getElementById('kehadiranGuruChart'), {
    type: 'bar',
    data: {
        labels: guruLabels,
        datasets: [{
            label: 'Persen Hadir (%)',
            data: guruPersen,
            backgroundColor: 'rgba(54,162,235,0.7)'
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

// PIE
new Chart(document.getElementById('proporsiStatusChart'), {
    type: 'pie',
    data: {
        labels: statusLabels,
        datasets: [{
            data: statusJumlah,
            backgroundColor: ['#4caf50', '#f44336', '#ff9800', '#03a9f4']
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

// LINE
new Chart(document.getElementById('trenHarianChart'), {
    type: 'line',
    data: {
        labels: trenTanggal,
        datasets: [{
            label: 'Kehadiran Harian',
            data: trenHadir,
            borderColor: '#2ecc71',
            borderWidth: 3,
            tension: 0.3
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});
</script>

@endsection
