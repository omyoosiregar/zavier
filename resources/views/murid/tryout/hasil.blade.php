<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Akhir Tryout Psikologi POLRI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f1f5f9; font-family: 'Segoe UI', sans-serif; }
        .card-hasil { background: white; border-radius: 24px; border: 1px solid #e2e8f0; padding: 40px; }
        .score-circle { width: 140px; height: 140px; border-radius: 50%; display: flex; flex-direction: column; align-items: center; justify-content: center; margin: 0 auto 20px; font-weight: 800; }
    </style>
</head>
<body class="py-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-hasil shadow-sm text-center">
                <span class="badge bg-primary-subtle text-primary border rounded-pill px-3 py-2 mb-2">RAPOR AKHIR CAT PSIKOLOGI POLRI</span>
                <h2 class="fw-bold text-dark">{{ $hasil->paketTryout->judul_tryout }}</h2>
                <p class="text-muted small mb-4">Peserta: {{ auth()->user()->name }} &middot; Selesai: {{ $hasil->updated_at->format('d M Y, H:i') }} WIB</p>

                @php
                    $isMS = $hasil->nilai_akhir >= 61;
                    $circleBg = $isMS ? '#ecfdf5' : '#fef2f2';
                    $circleColor = $isMS ? '#059669' : '#dc2626';
                @endphp

                <div class="score-circle" style="background: {{ $circleBg }}; color: {{ $circleColor }}; border: 4px solid {{ $circleColor }};">
                    <span style="font-size: 48px; line-height: 1;">{{ round($hasil->nilai_akhir) }}</span>
                    <small style="font-size: 11px;">NILAI AKHIR</small>
                </div>

                <h3 class="fw-bold mb-4" style="color: {{ $circleColor }};">
                    {{ $hasil->status_kelulusan }}
                </h3>

                <!-- Rincian 3 Subtes -->
                <div class="row g-3 mb-4 text-start">
                    <div class="col-4">
                        <div class="p-3 bg-light rounded-4 border text-center">
                            <small class="text-muted d-block mb-1">1. Kecerdasan</small>
                            <h4 class="fw-bold text-primary mb-0">{{ round($hasil->nilai_kecerdasan) }}</h4>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 bg-light rounded-4 border text-center">
                            <small class="text-muted d-block mb-1">2. Kepribadian</small>
                            <h4 class="fw-bold text-success mb-0">{{ round($hasil->nilai_kepribadian) }}</h4>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 bg-light rounded-4 border text-center">
                            <small class="text-muted d-block mb-1">3. Kecermatan</small>
                            <h4 class="fw-bold text-info mb-0">{{ round($hasil->nilai_kecermatan) }}</h4>
                        </div>
                    </div>
                </div>

                <a href="{{ route('murid.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-semibold">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>