<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Ujian - {{ $paket->nama_paket }}</title>

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0d6efd;
            --primary-soft: #eff6ff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-ui: #e2e8f0;
            --bg-canvas: #f8fafc;
        }

        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-canvas);
            color: var(--text-dark);
            min-height: 100vh;
            margin: 0;
            padding-bottom: 60px;
        }

        .result-card {
            background: #ffffff;
            border: 1px solid var(--border-ui);
            border-radius: 20px;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
            padding: 36px 32px;
        }

        .score-circle {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: #ffffff;
            border: 4px solid var(--primary);
            box-shadow: 0 0 0 6px var(--primary-soft);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .score-val {
            font-size: 46px;
            font-weight: 800;
            line-height: 1;
            color: var(--text-dark);
        }

        .stat-box {
            background: #f8fafc;
            border: 1px solid var(--border-ui);
            border-radius: 14px;
            padding: 16px;
            text-align: center;
        }

        .stat-val {
            font-size: 26px;
            font-weight: 800;
        }

        .review-card {
            background: #ffffff;
            border: 1px solid var(--border-ui);
            border-radius: 20px;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
            padding: 28px;
        }

        .badge-correct {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .badge-incorrect {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .btn-action {
            border-radius: 12px;
            padding: 10px 24px;
            font-weight: 700;
            font-size: 14px;
        }

        .kunci-badge {
            background: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
            padding: 6px 14px;
            border-radius: 10px;
            font-weight: 800;
            font-size: 15px;
            display: inline-block;
        }

        .jawaban-badge {
            padding: 6px 14px;
            border-radius: 10px;
            font-weight: 800;
            font-size: 15px;
            display: inline-block;
        }
    </style>
</head>

<body>

    {{-- NAVBAR TETAP TAMPIL --}}
    @if(view()->exists('layouts.navbar-murid'))
        @include('layouts.navbar-murid')
    @endif

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- Kartu Skor & Ringkasan Nilai -->
                <div class="result-card mb-4 text-center">
                    <span class="badge bg-light text-primary border px-3 py-2 rounded-pill fw-bold mb-3">
                        <i class="bi bi-file-earmark-check-fill me-1"></i> Hasil Evaluasi Ujian
                    </span>

                    <h2 class="fw-bold text-dark mb-1">{{ $paket->nama_paket }}</h2>
                    <p class="text-muted small mb-4">
                        Nama Peserta: <strong class="text-dark">{{ auth()->user()->name }}</strong> &middot; Selesai: {{ $hasil->updated_at->format('d M Y, H:i') }} WIB
                    </p>

                    <!-- Lingkaran Nilai -->
                    <div class="score-circle">
                        <span class="score-val">{{ round($hasil->nilai) }}</span>
                        <small class="text-muted fw-bold" style="font-size: 11px;">DARI 100</small>
                    </div>

                    @php
                        $skor = $hasil->nilai;
                        $kategoriPredikat = $skor >= 80 ? 'Sangat Baik' : ($skor >= 65 ? 'Baik' : ($skor >= 50 ? 'Cukup' : 'Perlu Latihan'));
                        $predikatClass = $skor >= 65 ? 'text-success' : ($skor >= 50 ? 'text-warning' : 'text-danger');
                    @endphp

                    <h5 class="fw-bold mb-4">
                        Predikat: <span class="{{ $predikatClass }}">{{ $kategoriPredikat }}</span>
                    </h5>

                    <!-- Kotak Statistik -->
                    <div class="row g-3 justify-content-center mb-4 text-start">
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <span class="text-muted small d-block mb-1">Total Soal</span>
                                <div class="stat-val text-dark">{{ $hasil->total_soal }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <span class="text-muted small d-block mb-1">Jawaban Benar</span>
                                <div class="stat-val text-success">{{ $hasil->jumlah_benar }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <span class="text-muted small d-block mb-1">Jawaban Salah</span>
                                <div class="stat-val text-danger">{{ $hasil->jumlah_salah }}</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="stat-box">
                                <span class="text-muted small d-block mb-1">Akurasi</span>
                                <div class="stat-val text-primary">{{ round($hasil->nilai) }}%</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('murid.paket-soal') }}" class="btn btn-outline-secondary btn-action">
                            <i class="bi bi-arrow-left me-1"></i> Daftar Paket
                        </a>
                        <a href="{{ route('murid.kecerdasan.mulai', $paket->id) }}" class="btn btn-primary btn-action">
                            <i class="bi bi-arrow-repeat me-1"></i> Ulangi Ujian
                        </a>
                    </div>
                </div>

                <!-- Tabel Pembahasan & Kunci Jawaban -->
                <div class="review-card">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Detail Jawaban & Pembahasan</h5>
                            <p class="text-muted small mb-0">Tinjau butir soal beserta kunci jawaban yang benar.</p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-muted small">
                                <tr>
                                    <th style="width: 50px;" class="text-center">No</th>
                                    <th>Pertanyaan & Pembahasan</th>
                                    <th style="width: 150px;" class="text-center">Jawaban Kamu</th>
                                    <th style="width: 150px;" class="text-center">Kunci Jawaban</th>
                                    <th style="width: 120px;" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($soals as $idx => $s)
                                    @php
                                        // 1. Jawaban Murid
                                        $jwbn = collect($detailJawaban)->firstWhere('soal_kecerdasan_id', $s->id);
                                        $pilihan = $jwbn ? strtoupper(trim($jwbn->jawaban)) : '-';

                                        // 2. Kunci Jawaban (Mencakup semua kemungkinan nama field di database)
                                        $rawKunci = $s->jawaban_benar 
                                                 ?? $s->kunci_jawaban 
                                                 ?? $s->kunci 
                                                 ?? $s->jawaban 
                                                 ?? '';

                                        $kunci = !empty($rawKunci) ? strtoupper(trim($rawKunci)) : '-';

                                        // 3. Cek Status Benar / Salah
                                        $isCorrect = ($kunci !== '-' && $pilihan !== '-' && $pilihan === $kunci);

                                        // 4. Ambil teks/gambar opsi kunci jawaban
                                        $kunciFieldText = 'pilihan_' . strtolower($kunci);
                                        $kunciFieldImg  = 'gambar_' . strtolower($kunci);
                                        $kunciTeks = ($kunci !== '-' && isset($s->$kunciFieldText)) ? $s->$kunciFieldText : null;
                                        $kunciImg  = ($kunci !== '-' && isset($s->$kunciFieldImg)) ? $s->$kunciFieldImg : null;
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold text-muted">{{ $idx + 1 }}</td>
                                        
                                        <!-- Kolom Soal -->
                                        <td>
                                            <div class="small fw-semibold text-dark mb-1">{!! strip_tags($s->pertanyaan) !!}</div>
                                            @if($s->gambar_soal)
                                                <div class="my-2">
                                                    <img src="{{ asset('storage/' . $s->gambar_soal) }}" alt="Gambar Soal" style="max-height: 80px; border-radius: 6px; border: 1px solid var(--border-ui);">
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Kolom Jawaban Kamu -->
                                        <td class="text-center">
                                            @if($pilihan !== '-')
                                                <span class="jawaban-badge {{ $isCorrect ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle' }}">
                                                    {{ $pilihan }}
                                                </span>
                                            @else
                                                <span class="text-muted fw-bold">-</span>
                                            @endif
                                        </td>

                                        <!-- Kolom Kunci Jawaban -->
                                        <td class="text-center">
                                            @if($kunci !== '-')
                                                <span class="kunci-badge">
                                                    {{ $kunci }}
                                                </span>
                                                @if($kunciTeks)
                                                    <div class="small text-muted mt-1 text-truncate" style="max-width: 140px;">
                                                        {{ $kunciTeks }}
                                                    </div>
                                                @endif
                                                @if($kunciImg)
                                                    <div class="mt-1">
                                                        <img src="{{ asset('storage/' . $kunciImg) }}" alt="Kunci" style="max-height: 35px; border-radius: 4px;">
                                                    </div>
                                                @endif
                                            @else
                                                <span class="text-muted fw-bold">-</span>
                                            @endif
                                        </td>

                                        <!-- Kolom Status -->
                                        <td class="text-center">
                                            @if($isCorrect)
                                                <span class="badge-correct"><i class="bi bi-check-circle-fill me-1"></i>Benar</span>
                                            @else
                                                <span class="badge-incorrect"><i class="bi bi-x-circle-fill me-1"></i>Salah</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>