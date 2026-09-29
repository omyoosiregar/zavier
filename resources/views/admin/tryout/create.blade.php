<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Paket Tryout Psikologi POLRI - ZAVIER Learning Center</title>

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        /* Layout Sidebar Kiri */
        .sidebar {
            width: 260px;
            background: #111c30;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 24px 16px;
            z-index: 1000;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 12px 24px 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 20px;
        }

        .brand-logo-box {
            width: 42px;
            height: 42px;
            background: #ffffff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 900;
            color: #1d4ed8;
        }

        .brand-name {
            font-size: 17px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        .sidebar-heading {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 10px 14px 6px 14px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: #94a3b8;
            border-radius: 12px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.15s ease;
            margin-bottom: 4px;
        }

        .nav-link-custom:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.06);
        }

        .nav-link-custom.active {
            color: #ffffff;
            background: #2563eb;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        /* Konten Utama Kanan */
        .main-content {
            margin-left: 260px;
            padding: 28px 40px;
            min-height: 100vh;
        }

        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .card-panel {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            padding: 36px 44px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        .step-circle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #2563eb;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
        }

        .subtes-box {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 18px;
            padding: 20px;
            margin-bottom: 22px;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR PANEL ADMIN -->
    <aside class="sidebar">
        <div class="brand-logo">
            <div class="brand-logo-box">Z</div>
            <div>
                <div class="brand-name">ZAVIER</div>
                <small style="color: #64748b; font-size: 10.5px;">LEARNING CENTER</small>
            </div>
        </div>

        <div class="sidebar-heading">UTAMA</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link-custom">
            <i class="bi bi-grid-fill fs-5"></i> Dashboard
        </a>
        <a href="{{ route('admin.bank-soal.index') }}" class="nav-link-custom">
            <i class="bi bi-file-earmark-text-fill fs-5"></i> Bank Soal
        </a>
        <a href="{{ route('admin.paket-ujian.index') }}" class="nav-link-custom">
            <i class="bi bi-archive-fill fs-5"></i> Paket Ujian
        </a>

        <div class="sidebar-heading mt-3">PESERTA</div>
        <a href="{{ route('admin.mentor.index') }}" class="nav-link-custom">
            <i class="bi bi-person-badge-fill fs-5"></i> Mentor
        </a>
        <a href="{{ route('admin.murid') }}" class="nav-link-custom">
            <i class="bi bi-people-fill fs-5"></i> Murid
        </a>
        <a href="{{ route('admin.riwayat-kecerdasan.index') }}" class="nav-link-custom">
            <i class="bi bi-clock-history fs-5"></i> Riwayat Ujian
        </a>

        <div class="sidebar-heading mt-3">SIMULASI TERPADU</div>
        <a href="{{ route('admin.tryout.index') }}" class="nav-link-custom active">
            <i class="bi bi-patch-check-fill fs-5"></i> Tryout Psikologi
        </a>

        <div class="pt-4 mt-4 border-top border-secondary border-opacity-25">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link-custom text-danger w-100 bg-transparent border-0 text-start">
                    <i class="bi bi-box-arrow-right fs-5"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA HALAMAN -->
    <main class="main-content">

        <!-- Top Navbar -->
        <div class="top-navbar">
            <div>
                <h5 class="fw-bold mb-0 text-dark">Buat Paket Tryout Psikologi POLRI</h5>
                <small class="text-muted">Panel administrasi ZAVIER Learning Center</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold text-dark small">Super Admin</div>
                    <small class="text-muted" style="font-size: 11px;">Super Admin</small>
                </div>
                <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    S
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger rounded-4 mb-4">
                <ul class="mb-0 small fw-semibold">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card-panel">

                    <div class="mb-4 pb-2 border-bottom">
                        <h4 class="fw-bold text-dark mb-1">Buat Paket Tryout Psikologi POLRI Baru</h4>
                        <p class="text-muted small mb-0">
                            Gabungkan 3 paket ujian (Kecerdasan, Kepribadian, dan Kecermatan) ke dalam satu alur CAT bertahap otomatis.
                        </p>
                    </div>

                    <form action="{{ route('admin.tryout.store') }}" method="POST">
                        @csrf

                        <!-- 1. JUDUL TRYOUT -->
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark d-flex align-items-center gap-2">
                                <span class="step-circle">1</span>
                                Judul Tryout Psikologi <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="judul_tryout" class="form-control rounded-3 py-2 px-3 border-secondary-subtle" 
                                   placeholder="Contoh: SIMULASI AKBAR CAT PSIKOLOGI POLRI 2026 - GELOMBANG 1" 
                                   value="{{ old('judul_tryout') }}" required>
                        </div>

                        <!-- 2. SUBTES 1: KECERDASAN -->
                        <div class="subtes-box">
                            <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                                <span class="step-circle">2</span>
                                Subtes 1: Paket Soal Kecerdasan <span class="text-danger">*</span>
                            </label>
                            <select name="paket_kecerdasan_id" class="form-select rounded-3 py-2 border-secondary-subtle mb-3" required>
                                <option value="">-- Pilih Paket Soal Kecerdasan --</option>
                                @foreach($paketKecerdasans as $pk)
                                    <option value="{{ $pk->id }}" {{ old('paket_kecerdasan_id') == $pk->id ? 'selected' : '' }}>
                                        {{ $pk->nama_paket ?? $pk->judul ?? ('Paket Kecerdasan #' . $pk->id) }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="row align-items-center bg-white p-3 rounded-3 border">
                                <div class="col-md-7">
                                    <span class="small text-dark fw-bold">
                                        <i class="bi bi-clock-history text-primary me-1"></i> Tentukan Durasi Subtes Kecerdasan:
                                    </span>
                                    <small class="text-muted d-block" style="font-size: 11.5px;">Standar CAT POLRI: 90 menit</small>
                                </div>
                                <div class="col-md-5 mt-2 mt-md-0">
                                    <div class="input-group">
                                        <input type="number" name="durasi_kecerdasan" class="form-control text-center fw-bold" 
                                               value="{{ old('durasi_kecerdasan', 90) }}" min="1" max="300" required>
                                        <span class="input-group-text bg-light fw-bold text-dark small">Menit</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. SUBTES 2: KEPRIBADIAN -->
                        <div class="subtes-box">
                            <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                                <span class="step-circle">3</span>
                                Subtes 2: Paket Soal Kepribadian <span class="text-danger">*</span>
                            </label>
                            <select name="paket_kepribadian_id" class="form-select rounded-3 py-2 border-secondary-subtle mb-3" required>
                                <option value="">-- Pilih Paket Soal Kepribadian --</option>
                                @foreach($paketKepribadians as $pkp)
                                    <option value="{{ $pkp->id }}" {{ old('paket_kepribadian_id') == $pkp->id ? 'selected' : '' }}>
                                        {{ $pkp->nama_paket ?? $pkp->judul ?? ('Paket Kepribadian #' . $pkp->id) }}
                                    </option>
                                @endforeach
                            </select>

                            <div class="row align-items-center bg-white p-3 rounded-3 border">
                                <div class="col-md-7">
                                    <span class="small text-dark fw-bold">
                                        <i class="bi bi-clock-history text-success me-1"></i> Tentukan Durasi Subtes Kepribadian:
                                    </span>
                                    <small class="text-muted d-block" style="font-size: 11.5px;">Standar CAT POLRI: 60 menit</small>
                                </div>
                                <div class="col-md-5 mt-2 mt-md-0">
                                    <div class="input-group">
                                        <input type="number" name="durasi_kepribadian" class="form-control text-center fw-bold" 
                                               value="{{ old('durasi_kepribadian', 60) }}" min="1" max="300" required>
                                        <span class="input-group-text bg-light fw-bold text-dark small">Menit</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. SUBTES 3: KECERMATAN -->
                        <div class="subtes-box">
                            <label class="form-label fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                                <span class="step-circle">4</span>
                                Subtes 3: Paket Soal Kecermatan <span class="text-danger">*</span>
                            </label>
                            <select name="paket_kecermatan_id" class="form-select rounded-3 py-2 border-secondary-subtle mb-2" required>
                                <option value="">-- Pilih Paket Soal Kecermatan --</option>
                                @foreach($paketKecermatans as $pcm)
                                    <option value="{{ $pcm->id }}" {{ old('paket_kecermatan_id') == $pcm->id ? 'selected' : '' }}>
                                        {{ $pcm->nama_paket ?? $pcm->judul ?? ('Paket Kecermatan #' . $pcm->id) }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="alert alert-info py-2 px-3 mb-0 rounded-3 border-0 small">
                                <i class="bi bi-info-circle-fill me-1"></i> <strong>Khusus Kecermatan:</strong> Durasi pengerjaan otomatis membaca dan mengikuti pengaturan durasi per kolom dari paket soal yang dipilih.
                            </div>
                        </div>

                        <!-- 5. JEDA ISTIRAHAT -->
                        <div class="mb-4 pb-2">
                            <label class="form-label fw-bold text-dark d-flex align-items-center gap-2">
                                <span class="step-circle">5</span>
                                Durasi Jeda Istirahat Antar Subtes <span class="text-danger">*</span>
                            </label>
                            <div class="input-group" style="max-width: 200px;">
                                <input type="number" name="jeda_menit" class="form-control text-center fw-bold" 
                                       value="{{ old('jeda_menit', 5) }}" min="1" max="30" required>
                                <span class="input-group-text bg-white fw-bold text-muted small">Menit</span>
                            </div>
                        </div>

                        <!-- TOMBOL SUBMIT -->
                        <div class="pt-3 border-top d-flex gap-3">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-sm">
                                <i class="bi bi-save2 me-1"></i> Simpan & Publikasikan Paket Tryout
                            </button>
                            <a href="{{ route('admin.tryout.index') }}" class="btn btn-light rounded-pill px-4 py-3 fw-semibold text-muted">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </main>

</body>
</html>