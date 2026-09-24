<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Paket Soal Kecerdasan - Admin ZAVIER</title>

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Font: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0d6efd;
            --primary-soft: #eaf3ff;
            --dark-navy: #132a4a;
            --border-color: #e2eaf5;
            --bg-page: #f5f8fc;
        }

        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-page);
            color: var(--dark-navy);
            min-height: 100vh;
            padding-bottom: 50px;
        }

        .admin-header-banner {
            background: linear-gradient(135deg, #0d6efd 0%, #1555b7 55%, #0dcaf0 100%);
            border-radius: 24px;
            padding: 32px 36px;
            color: #ffffff;
            margin-bottom: 28px;
            box-shadow: 0 12px 30px rgba(13, 110, 253, 0.18);
        }

        .back-link-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 16px;
        }

        .back-link-pill:hover {
            background: #ffffff;
            color: var(--primary);
        }

        .glass-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 22px;
            box-shadow: 0 10px 30px rgba(19, 42, 74, 0.04);
            padding: 32px;
        }

        .step-pill {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: var(--primary-soft);
            color: var(--primary);
            font-weight: 800;
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .custom-input, .custom-select {
            border: 1.5px solid #d9e4f2;
            border-radius: 14px;
            padding: 12px 16px;
            font-size: 14px;
        }

        /* Tabel Checklist Soal */
        .table-soal-wrapper {
            max-height: 480px;
            overflow-y: auto;
            border: 1.5px solid #e1e9f4;
            border-radius: 16px;
            background: #ffffff;
        }

        .soal-item-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 18px;
            border-bottom: 1px solid #edf2f9;
            transition: all 0.15s ease;
        }

        .soal-item-row:hover:not(.row-disabled) {
            background: #f8fbff;
        }

        .row-disabled {
            background: #fdf2f2;
            opacity: 0.65;
            cursor: not-allowed;
        }

        .soal-checkbox {
            width: 20px;
            height: 20px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .row-disabled .soal-checkbox {
            cursor: not-allowed;
        }

        .soal-img-thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            flex-shrink: 0;
        }

        .badge-status-used {
            background: #fee2e2;
            color: #dc2626;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid #fca5a5;
            white-space: nowrap;
        }

        .badge-status-available {
            background: #dcfce7;
            color: #15803d;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid #86efac;
            white-space: nowrap;
        }

        /* Preview Card */
        .preview-sticky {
            position: sticky;
            top: 24px;
        }

        .preview-box {
            background: #ffffff;
            border: 1.5px solid var(--border-color);
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(19, 42, 74, 0.04);
        }

        .preview-mock-card {
            background: #fbfdff;
            border: 1.5px dashed #cadcf4;
            border-radius: 18px;
            padding: 22px;
        }

        .mock-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 15px;
            background: linear-gradient(135deg, #0d6efd, #0dcaf0);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 14px;
        }

        .btn-submit-save {
            background: linear-gradient(135deg, #0d6efd, #0953c7);
            border: none;
            color: #ffffff;
            font-weight: 700;
            padding: 13px 28px;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(13, 110, 253, 0.22);
            transition: all 0.2s ease;
        }

        .btn-submit-save:hover {
            transform: translateY(-2px);
            color: #ffffff;
        }
    </style>
</head>

<body>

@if(view()->exists('layouts.navbar-admin'))
    @include('layouts.navbar-admin')
@endif

<div class="container py-4">

    <!-- Header Banner -->
    <div class="admin-header-banner">
        <a href="{{ route('admin.paket-kecerdasan.index') }}" class="back-link-pill">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Paket
        </a>
        <h2 class="fw-bold mb-1">Buat Paket Soal Kecerdasan</h2>
        <p class="mb-0 text-white-50 small">
            Pilih butir soal yang ingin dimasukkan ke paket ini. Soal yang telah digunakan di paket lain otomatis terkunci agar tidak terulang.
        </p>
    </div>

    <!-- Error Validasi -->
    @if($errors->any())
        <div class="alert alert-danger rounded-4 shadow-sm border-0 mb-4 p-3">
            <div class="fw-bold small mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Periksa kembali data berikut:</div>
            <ul class="mb-0 small ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        <!-- Kolom Kiri: Form Input & Checklist Soal -->
        <div class="col-lg-7">
            <div class="glass-card">
                <form method="POST" action="{{ route('admin.paket-kecerdasan.store') }}">
                    @csrf

                    <!-- 1. Nama Paket -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="step-pill">1</span>
                            <label for="nama_paket" class="fw-bold fs-6">Nama Paket Ujian <span class="text-danger">*</span></label>
                        </div>
                        <input type="text"
                               id="nama_paket"
                               name="nama_paket"
                               class="form-control custom-input @error('nama_paket') is-invalid @enderror"
                               value="{{ old('nama_paket') }}"
                               placeholder="Contoh: Kecerdasan 1 - Logika & Penalaran"
                               autocomplete="off"
                               required>
                        @error('nama_paket')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 2. Tingkat Kesulitan & Durasi -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="step-pill">2</span>
                                <label for="tingkat" class="fw-bold fs-6">Tingkat Kesulitan <span class="text-danger">*</span></label>
                            </div>
                            <select id="tingkat" name="tingkat" class="form-select custom-select @error('tingkat') is-invalid @enderror" required>
                                <option value="Mudah" {{ old('tingkat') == 'Mudah' ? 'selected' : '' }}>Mudah</option>
                                <option value="Sedang" {{ old('tingkat') == 'Sedang' || !old('tingkat') ? 'selected' : '' }}>Sedang</option>
                                <option value="Sulit" {{ old('tingkat') == 'Sulit' ? 'selected' : '' }}>Sulit</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="step-pill">3</span>
                                <label for="durasi" class="fw-bold fs-6">Durasi Ujian <span class="text-danger">*</span></label>
                            </div>
                            <div class="input-group">
                                <input type="number"
                                       id="durasi"
                                       name="durasi"
                                       class="form-control custom-input @error('durasi') is-invalid @enderror"
                                       value="{{ old('durasi', 30) }}"
                                       min="1"
                                       placeholder="30"
                                       required>
                                <span class="input-group-text bg-white border-start-0 text-muted" style="border-radius: 0 14px 14px 0; border-color: #d9e4f2;">Menit</span>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Checklist Pemilihan Butir Soal -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="step-pill">4</span>
                                <label class="fw-bold fs-6 mb-0">Pilih Butir Soal Dari Bank Soal <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-check small">
                                <input class="form-check-input" type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)">
                                <label class="form-check-label fw-semibold text-primary" for="selectAllCheckbox">
                                    Pilih Semua yang Tersedia
                                </label>
                            </div>
                        </div>

                        <div class="table-soal-wrapper">
                            @forelse($soals as $index => $item)
                                @php
                                    $isUsed = in_array($item->id, $usedSoalIds ?? []);
                                @endphp
                                <div class="soal-item-row {{ $isUsed ? 'row-disabled' : '' }}">
                                    <!-- Checkbox -->
                                    <input type="checkbox"
                                           name="soal_ids[]"
                                           value="{{ $item->id }}"
                                           class="soal-checkbox item-checkbox"
                                           {{ $isUsed ? 'disabled' : '' }}
                                           {{ is_array(old('soal_ids')) && in_array($item->id, old('soal_ids')) ? 'checked' : '' }}
                                           onchange="updateCount()">

                                    <!-- Thumbnail Gambar (Jika ada) -->
                                    @if($item->gambar_soal)
                                        <img src="{{ asset('storage/' . $item->gambar_soal) }}" class="soal-img-thumb" alt="Thumb Soal">
                                    @else
                                        <div class="soal-img-thumb bg-light d-flex align-items-center justify-content-center text-muted fs-5">
                                            <i class="bi bi-file-text"></i>
                                        </div>
                                    @endif

                                    <!-- Cuplikan Teks Soal -->
                                    <div class="flex-grow-1 overflow-hidden">
                                        <div class="fw-bold text-dark small mb-1">
                                            Soal #{{ $index + 1 }}
                                        </div>
                                        <div class="text-muted small text-truncate" style="max-width: 320px;">
                                            {{ strip_tags($item->pertanyaan) ?: 'Soal berupa visual gambar' }}
                                        </div>
                                    </div>

                                    <!-- Status Ketersediaan -->
                                    <div>
                                        @if($isUsed)
                                            <span class="badge-status-used">
                                                <i class="bi bi-x-circle-fill me-1"></i>Sudah Digunakan
                                            </span>
                                        @else
                                            <span class="badge-status-available">
                                                <i class="bi bi-check-circle-fill me-1"></i>Tersedia
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 text-center text-muted small">
                                    Belum ada soal aktif di Bank Soal Kecerdasan.
                                </div>
                            @endforelse
                        </div>
                        <small class="text-muted mt-2 d-block">
                            <i class="bi bi-info-circle me-1"></i>Soal berstatus <strong class="text-danger">Sudah Digunakan</strong> terkunci otomatis agar butir soal tidak dobel di paket lainnya.
                        </small>
                    </div>

                    <!-- 5. Keterangan -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="step-pill">5</span>
                            <label for="keterangan" class="fw-bold fs-6">Keterangan Tambahan</label>
                        </div>
                        <textarea class="form-control custom-input"
                                  id="keterangan"
                                  name="keterangan"
                                  rows="2"
                                  placeholder="Paket latihan Zavier Learning Center untuk mengasah penalaran dan kognitif.">{{ old('keterangan') }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end align-items-center gap-3 pt-3 border-top">
                        <a href="{{ route('admin.paket-kecerdasan.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold border">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-submit-save">
                            <i class="bi bi-cloud-check-fill me-1"></i> Terbitkan Paket Soal
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- Kolom Kanan: Live Preview Card -->
        <div class="col-lg-5">
            <div class="preview-sticky">
                <div class="preview-box">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="fw-bold small text-muted text-uppercase">
                            <i class="bi bi-eye-fill me-1 text-primary"></i> Tampilan di Halaman Murid
                        </div>
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Pratinjau Langsung</span>
                    </div>

                    <!-- Mock Card Siswa -->
                    <div class="preview-mock-card">
                        <div class="mock-icon-wrap">
                            <i class="bi bi-lightbulb-fill"></i>
                        </div>

                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="fw-bold text-dark mb-0" id="previewNama">Kecerdasan 1</h5>
                            <span class="badge bg-primary-subtle text-primary border rounded-pill" id="previewTingkat">Sedang</span>
                        </div>

                        <p class="text-muted small mb-3" id="previewKeterangan">
                            Paket latihan Zavier Learning Center untuk mengasah penalaran dan kognitif.
                        </p>

                        <div class="p-3 bg-white rounded-3 border mb-3">
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted"><i class="bi bi-patch-check-fill text-primary me-1"></i> Kategori:</span>
                                <strong class="text-dark">Tes Kecerdasan</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted"><i class="bi bi-check2-square text-primary me-1"></i> Soal Dipilih:</span>
                                <strong class="text-primary fw-bold fs-6" id="previewJumlah">0 Soal</strong>
                            </div>
                            <div class="d-flex justify-content-between small">
                                <span class="text-muted"><i class="bi bi-clock-history text-primary me-1"></i> Waktu Pengerjaan:</span>
                                <strong class="text-dark" id="previewDurasi">30 Menit</strong>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary w-100 rounded-3 py-2 fw-bold disabled" style="opacity: 0.9;">
                            Mulai Ujian <i class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <small class="text-muted" style="font-size: 11px;">
                            <i class="bi bi-info-circle me-1"></i>Centang butir soal di tabel untuk menambahkan ke paket.
                        </small>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Script Hitung Centang & Preview -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputNama = document.getElementById('nama_paket');
    const selectTingkat = document.getElementById('tingkat');
    const inputDurasi = document.getElementById('durasi');
    const inputKet = document.getElementById('keterangan');

    const prevNama = document.getElementById('previewNama');
    const prevTingkat = document.getElementById('previewTingkat');
    const prevDurasi = document.getElementById('previewDurasi');
    const prevKet = document.getElementById('previewKeterangan');

    function syncPreview() {
        if (prevNama) prevNama.textContent = inputNama.value.trim() || 'Judul Paket Belum Diisi';
        if (prevTingkat) prevTingkat.textContent = selectTingkat.value || 'Sedang';
        if (prevDurasi) prevDurasi.textContent = inputDurasi.value ? inputDurasi.value + ' Menit' : '0 Menit';
        if (prevKet) prevKet.textContent = inputKet.value.trim() || 'Paket latihan Zavier Learning Center untuk mengasah penalaran dan kognitif.';
    }

    [inputNama, selectTingkat, inputDurasi, inputKet].forEach(elem => {
        if (elem) {
            elem.addEventListener('input', syncPreview);
            elem.addEventListener('change', syncPreview);
        }
    });

    syncPreview();
    updateCount();
});

// Hitung jumlah soal yang dicentang
function updateCount() {
    const checkedItems = document.querySelectorAll('.item-checkbox:checked').length;
    document.getElementById('previewJumlah').textContent = checkedItems + ' Soal';
}

// Fitur Pilih Semua Soal yang Aktif/Tersedia
function toggleSelectAll(master) {
    const checkboxes = document.querySelectorAll('.item-checkbox:not(:disabled)');
    checkboxes.forEach(cb => {
        cb.checked = master.checked;
    });
    updateCount();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>