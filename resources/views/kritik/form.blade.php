@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kritik & Saran</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

<div class="py-5">
    <div class="container">
        <div class="mx-auto" style="width: 800px; max-width: 100%;">

            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-dark mb-3">Kritik & Saran</h1>
                <p class="lead text-muted">Kami sangat menghargai masukan Anda untuk terus berkembang menjadi lebih baik.</p>
                <hr class="w-50 mx-auto border-2 opacity-50" style="border-color: #0d6efd;">
            </div>

            <!-- Daftar Kritik & Saran dalam Grid Card -->
            <div class="mb-5">
                <h2 class="h5 fw-semibold text-center mb-4 text-dark">
                    Daftar Kritik & Saran
                </h2>

                @if($kritikSaran->count() > 0)
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        @foreach($kritikSaran as $item)
                            <div class="col">
                                <div class="card h-100 shadow-sm border-0 rounded-4 hover-lift">
                                    <div class="card-header bg-light border-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person-circle fs-3 text-primary me-3"></i>
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $item->nama ?? 'Anonim' }}</h6>
                                                <small class="text-muted">
                                                    {{ $item->email ?? 'Tidak ada email' }} • {{ $item->created_at->format('d M Y, H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-3">
                                        <p class="card-text text-dark lh-lg mb-0">{{ $item->pesan }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-5 text-muted mb-3 opacity-50"></i>
                        <p class="text-muted mb-0 fs-5">Belum ada kritik dan saran yang masuk.</p>
                        <small class="text-muted">Jadilah yang pertama memberikan masukan!</small>
                    </div>
                @endif
            </div>

            <!-- Form Kirim Kritik -->
            <div class="bg-white rounded-4 shadow-lg overflow-hidden border">
                <div class="bg-primary text-white text-center py-4">
                    <h3 class="h5 mb-0 fw-medium">
                        Kirim Kritik atau Saran Anda
                    </h3>
                </div>
                <div class="p-5">

                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center mb-4 rounded-3">
                            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                    @endif

                    <form action="{{ route('kritik.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-6">
                                <label class="form-label fw-medium">Nama <small class="text-muted">(opsional)</small></label>
                                <input type="text" name="nama" class="form-control form-control-lg rounded-3" placeholder="Masukkan nama Anda">
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-medium">Email <small class="text-muted">(opsional)</small></label>
                                <input type="email" name="email" class="form-control form-control-lg rounded-3" placeholder="email@contoh.com">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-medium">
                                    Kritik / Saran <span class="text-danger">*</span>
                                </label>
                                <textarea name="pesan" rows="6" class="form-control form-control-lg rounded-3 @error('pesan') is-invalid @enderror" 
                                          placeholder="Tulis kritik, saran, atau masukan Anda di sini..." required></textarea>
                                @error('pesan')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5 py-3 rounded-3 shadow">
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer kecil -->
            <div class="text-center mt-5 text-muted">
                <p>Terima kasih atas waktu dan masukan Anda ❤️</p>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .rounded-4 { border-radius: 1rem; }
    .shadow-lg { box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important; }
    .hover-lift {
        transition: all 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
    }
    .card-header small {
        font-size: 0.85rem;
    }
</style>

</body>
</html>
@endsection