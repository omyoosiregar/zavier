<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subtes 1: Kecerdasan - {{ $tryout->judul_tryout }}</title>

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        * {
            box-sizing: border-box;
            user-select: none;
        }

        body {
            background-color: #f0f6ff;
            color: #1e293b;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .top-navbar-exam {
            padding: 18px 36px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge-tahap {
            background: #2563eb;
            color: #ffffff;
            font-size: 11.5px;
            font-weight: 800;
            letter-spacing: 0.5px;
            padding: 6px 16px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .user-pill {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .exam-container {
            max-width: 1380px;
            margin: 0 auto;
            padding: 0 24px 30px 24px;
        }

        .card-soal {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 32px 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            min-height: 520px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .badge-no-soal {
            background: #eff6ff;
            color: #2563eb;
            font-size: 13px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 12px;
            display: inline-block;
        }

        .soal-text-content {
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.6;
            margin: 16px 0;
        }

        .soal-text-content img {
            max-width: 100%;
            height: auto;
            max-height: 350px;
            object-fit: contain;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            margin: 12px 0;
            display: block;
        }

        .img-soal-box {
            background: #f8fafc;
            border: 1.5px dashed #cbd5e1;
            border-radius: 14px;
            padding: 16px;
            text-align: center;
            margin: 14px 0 24px 0;
        }

        .img-soal-view {
            max-width: 100%;
            max-height: 320px;
            object-fit: contain;
            border-radius: 8px;
            display: inline-block;
        }

        .option-choice-item {
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 20px;
            margin-bottom: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.15s ease;
            background: #ffffff;
        }

        .option-choice-item:hover {
            border-color: #2563eb;
            background: #f8faff;
        }

        .option-choice-item.selected {
            border-color: #2563eb;
            background: #eff6ff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.08);
        }

        .radio-dot {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 2px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.15s ease;
        }

        .option-choice-item.selected .radio-dot {
            border-color: #2563eb;
            background: #2563eb;
        }

        .option-choice-item.selected .radio-dot::after {
            content: '';
            width: 8px;
            height: 8px;
            background: #ffffff;
            border-radius: 50%;
        }

        .img-opsi-view {
            max-height: 110px;
            max-width: 240px;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            padding: 6px;
            margin: 4px 0;
            display: block;
        }

        .sidebar-widget {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        .timer-card {
            background: #ef4444;
            color: #ffffff;
            border-radius: 18px;
            padding: 16px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.25);
            margin-bottom: 24px;
        }

        .timer-digits {
            font-size: 34px;
            font-weight: 800;
            letter-spacing: 2px;
            font-family: 'Courier New', Courier, monospace;
        }

        .nomor-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            margin-bottom: 24px;
        }

        .btn-nomor {
            height: 42px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #334155;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-nomor:hover {
            border-color: #2563eb;
            color: #2563eb;
        }

        .btn-nomor.active {
            border-color: #2563eb;
            background: #2563eb;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }

        .btn-nomor.answered {
            background: #3b82f6;
            border-color: #3b82f6;
            color: #ffffff;
        }

        .btn-kumpulkan {
            border: 1.5px solid #2563eb;
            color: #2563eb;
            background: #ffffff;
            border-radius: 12px;
            padding: 10px;
            width: 100%;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .btn-kumpulkan:hover {
            background: #2563eb;
            color: #ffffff;
        }

        /* Custom SweetAlert2 Styling */
        .swal2-popup.cat-custom-popup {
            border-radius: 24px !important;
            padding: 24px 28px !important;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.25) !important;
            border: 1px solid #f1f5f9 !important;
        }
        .swal2-title.cat-custom-title {
            font-size: 22px !important;
            font-weight: 800 !important;
            color: #0f172a !important;
            margin-top: 10px !important;
        }
        .swal2-html-container.cat-custom-html {
            font-size: 14.5px !important;
            color: #64748b !important;
            line-height: 1.6 !important;
        }
        .swal2-confirm.cat-custom-btn-blue {
            background-color: #2563eb !important;
            border-radius: 50px !important;
            padding: 12px 32px !important;
            font-weight: 700 !important;
            font-size: 14.5px !important;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35) !important;
        }
        .swal2-cancel.cat-custom-btn-cancel {
            border-radius: 50px !important;
            padding: 12px 28px !important;
            font-weight: 600 !important;
            font-size: 14.5px !important;
        }
    </style>
</head>
<body>

    <div class="top-navbar-exam">
        <div>
            <span class="badge-tahap mb-1">
                <i class="bi bi-shield-check"></i> TAHAP 1 DARI 3: TES KECERDASAN
            </span>
            <h4 class="fw-bold text-dark mb-0 mt-1">{{ $tryout->judul_tryout }}</h4>
        </div>
        <div>
            <div class="user-pill">
                <i class="bi bi-person-fill text-primary"></i>
                <span>{{ auth()->user()->name ?? 'Peserta Tryout' }}</span>
            </div>
        </div>
    </div>

    @php
        $totalSoal = $soals->count();

        $parseUrl = function($field) {
            if (empty($field)) return null;
            $val = trim((string)$field);
            if ($val === '' || $val === '-') return null;

            if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')) {
                return $val;
            }

            $clean = ltrim($val, '/');
            $clean = preg_replace('/^public\//', '', $clean);

            if (file_exists(public_path('storage/' . $clean))) {
                return asset('storage/' . $clean);
            }
            if (file_exists(public_path($clean))) {
                return asset($clean);
            }
            if (file_exists(public_path('uploads/' . $clean))) {
                return asset('uploads/' . $clean);
            }

            return asset('storage/' . $clean);
        };
    @endphp

    <div class="exam-container">
        <form action="{{ route('murid.tryout.submit.kecerdasan', $hasil->id) }}" method="POST" id="formKecerdasan">
            @csrf

            <div class="row g-4">
                <!-- KOLOM KIRI: LEMBAR SOAL -->
                <div class="col-lg-8 col-xl-9">
                    <div class="card-soal">
                        
                        @forelse($soals as $idx => $s)
                            @php
                                $nomor = $idx + 1;
                                $item = (object) $s;
                                
                                $teksSoal = $item->soal ?? $item->pertanyaan ?? $item->deskripsi ?? '';
                                
                                $rawImgSoal = $item->gambar 
                                            ?? $item->foto 
                                            ?? $item->image 
                                            ?? $item->file_gambar 
                                            ?? $item->gambar_soal 
                                            ?? $item->soal_gambar 
                                            ?? null;
                                $urlImgSoal = $parseUrl($rawImgSoal);

                                $opsiArr = [
                                    'A' => [
                                        'teks' => $item->pilihan_a ?? $item->opsi_a ?? $item->a ?? '',
                                        'img'  => $parseUrl($item->gambar_a ?? $item->foto_a ?? $item->image_a ?? $item->opsi_a_gambar ?? $item->pilihan_a_gambar ?? null)
                                    ],
                                    'B' => [
                                        'teks' => $item->pilihan_b ?? $item->opsi_b ?? $item->b ?? '',
                                        'img'  => $parseUrl($item->gambar_b ?? $item->foto_b ?? $item->image_b ?? $item->opsi_b_gambar ?? $item->pilihan_b_gambar ?? null)
                                    ],
                                    'C' => [
                                        'teks' => $item->pilihan_c ?? $item->opsi_c ?? $item->c ?? '',
                                        'img'  => $parseUrl($item->gambar_c ?? $item->foto_c ?? $item->image_c ?? $item->opsi_c_gambar ?? $item->pilihan_c_gambar ?? null)
                                    ],
                                    'D' => [
                                        'teks' => $item->pilihan_d ?? $item->opsi_d ?? $item->d ?? '',
                                        'img'  => $parseUrl($item->gambar_d ?? $item->foto_d ?? $item->image_d ?? $item->opsi_d_gambar ?? $item->pilihan_d_gambar ?? null)
                                    ],
                                    'E' => [
                                        'teks' => $item->pilihan_e ?? $item->opsi_e ?? $item->e ?? '',
                                        'img'  => $parseUrl($item->gambar_e ?? $item->foto_e ?? $item->image_e ?? $item->opsi_e_gambar ?? $item->pilihan_e_gambar ?? null)
                                    ],
                                ];
                            @endphp

                            <div class="soal-box-item" id="soal-box-{{ $nomor }}" style="display: {{ $nomor === 1 ? 'block' : 'none' }};">
                                
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge-no-soal">Soal No. {{ $nomor }}</span>
                                    <span class="text-muted small fw-semibold">
                                        <i class="bi bi-check2-all text-primary me-1"></i> Pilihan Ganda
                                    </span>
                                </div>

                                <!-- GAMBAR SOAL -->
                                @if($urlImgSoal)
                                    <div class="img-soal-box">
                                        <img src="{{ $urlImgSoal }}" alt="Gambar Soal {{ $nomor }}" class="img-soal-view">
                                    </div>
                                @endif

                                <!-- TEKS PERTANYAAN SOAL -->
                                @if(!empty(trim(strip_tags($teksSoal))) && trim($teksSoal) !== '-')
                                    <div class="soal-text-content">
                                        {!! $teksSoal !!}
                                    </div>
                                @endif

                                <!-- DAFTAR PILIHAN GANDA (A, B, C, D, E) -->
                                <div class="mt-4">
                                    @foreach($opsiArr as $huruf =>$dataOpsi)
                                        @php
                                            $finalImgUrl =$dataOpsi['img'];
                                            $rawTeks = trim((string)$dataOpsi['teks']);

                                            if (!$finalImgUrl && !empty($rawTeks)) {
                                                $lower = strtolower($rawTeks);
                                                if (str_ends_with($lower, '.png') || str_ends_with($lower, '.jpg') || str_ends_with($lower, '.jpeg') || str_ends_with($lower, '.webp') || str_ends_with($lower, '.svg')) {$finalImgUrl = $parseUrl($rawTeks);
                                                }
                                            }

                                            $isPlaceholder = in_array(strtolower($rawTeks), ['pilihan a', 'pilihan b', 'pilihan c', 'pilihan d', 'pilihan e', 'opsi a', 'opsi b', 'opsi c', 'opsi d', 'opsi e', '-']);
                                        @endphp

                                        <label class="option-choice-item w-100" onclick="pilihOpsi(this, {{ $nomor }})">
                                            <div class="radio-dot"></div>
                                            <input type="radio" 
                                                   name="jawaban[{{ $item->id }}]" 
                                                   value="{{ $huruf }}" 
                                                   class="d-none">
                                            
                                            <div class="d-flex align-items-center flex-wrap gap-3">
                                                <span class="fw-bold text-dark fs-5">{{ $huruf }}.</span>

                                                @if($finalImgUrl)
                                                    <img src="{{ $finalImgUrl }}" alt="Opsi {{ $huruf }}" class="img-opsi-view">
                                                @endif

                                                @if((!$isPlaceholder && !empty($rawTeks)) || (!$finalImgUrl))
                                                    <span class="fs-6">{!! $rawTeks !!}</span>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                </div>

                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>
                                <h6 class="fw-bold mt-2">Belum ada butir soal pada paket ini</h6>
                            </div>
                        @endforelse

                        <div class="d-flex justify-content-between align-items-center pt-4 border-top mt-4">
                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4 fw-bold" id="btnPrev" onclick="navigasi(-1)">
                                &larr; Sebelumnya
                            </button>
                            <button type="button" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" id="btnNext" onclick="navigasi(1)">
                                Selanjutnya &rarr;
                            </button>
                        </div>

                    </div>
                </div>

                <!-- KOLOM KANAN: TIMER & GRID NOMOR SOAL -->
                <div class="col-lg-4 col-xl-3">
                    <div class="sidebar-widget">
                        
                        <div class="timer-card">
                            <div class="small fw-bold text-uppercase mb-1" style="font-size: 11px; letter-spacing: 1px;">
                                <i class="bi bi-clock me-1"></i> Sisa Waktu Ujian
                            </div>
                            <div class="timer-digits" id="timerKecerdasan">00:00</div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-bold text-dark small">Navigasi Soal</span>
                            <span class="text-muted small fw-bold">
                                <span id="countDijawab" class="text-primary fw-bold">0</span> / {{ $totalSoal }} Dijawab
                            </span>
                        </div>

                        <div class="nomor-grid">
                            @for($i = 1; $i <= $totalSoal; $i++)
                                <div class="btn-nomor {{ $i === 1 ? 'active' : '' }}" id="nav-btn-{{ $i }}" onclick="bukaSoal({{ $i }})">
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>

                        <div class="d-flex align-items-center gap-3 mb-4 small text-muted" style="font-size: 12px;">
                            <div class="d-flex align-items-center gap-1">
                                <span style="width: 10px; height: 10px; border-radius: 2px; background: #3b82f6; display: inline-block;"></span> Dijawab
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <span style="width: 10px; height: 10px; border-radius: 2px; border: 1px solid #cbd5e1; background: #fff; display: inline-block;"></span> Belum
                            </div>
                        </div>

                        <button type="button" class="btn-kumpulkan" onclick="konfirmasiSelesai()">
                            Kumpulkan Ujian
                        </button>

                    </div>
                </div>
            </div>

        </form>
    </div>

    <!-- Bootstrap 5 JS & SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const totalSoal = {{ $totalSoal }};
        let nomorAktif = 1;

        function bukaSoal(nomor) {
            document.querySelectorAll('.soal-box-item').forEach(b => b.style.display = 'none');
            const target = document.getElementById('soal-box-' + nomor);
            if (target) target.style.display = 'block';

            document.querySelectorAll('.btn-nomor').forEach(b => b.classList.remove('active'));
            const navBtn = document.getElementById('nav-btn-' + nomor);
            if (navBtn) navBtn.classList.add('active');

            nomorAktif = nomor;
            document.getElementById('btnPrev').disabled = (nomorAktif === 1);
            document.getElementById('btnNext').innerText = (nomorAktif === totalSoal) ? 'Selesai & Kumpulkan' : 'Selanjutnya →';
        }

        function navigasi(arah) {
            let targetNomor = nomorAktif + arah;
            if (targetNomor >= 1 && targetNomor <= totalSoal) {
                bukaSoal(targetNomor);
            } else if (targetNomor > totalSoal) {
                konfirmasiSelesai();
            }
        }

        function pilihOpsi(labelEl, nomor) {
            const parent = document.getElementById('soal-box-' + nomor);
            parent.querySelectorAll('.option-choice-item').forEach(el => el.classList.remove('selected'));
            labelEl.classList.add('selected');

            const radio = labelEl.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;

            const navBtn = document.getElementById('nav-btn-' + nomor);
            if (navBtn) navBtn.classList.add('answered');

            updateHitunganDijawab();
        }

        function updateHitunganDijawab() {
            const terjawab = document.querySelectorAll('input[type="radio"]:checked').length;
            document.getElementById('countDijawab').innerText = terjawab;
            return terjawab;
        }

        // =========================================================================
        // POP-UP KONFIRMASI MODERN (MENGGANTIKAN ALERT BAWAAN BROWSER)
        // =========================================================================
        function konfirmasiSelesai() {
            const terjawab = updateHitunganDijawab();
            const belumDijawab = totalSoal - terjawab;

            Swal.fire({
                title: 'Kumpulkan Subtes Kecerdasan?',
                html: `
                    <div class="mt-2 text-start bg-light p-3 rounded-4 border mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-secondary small">Total Soal:</span>
                            <span class="fw-bold text-dark">${totalSoal} Soal</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-success small"><i class="bi bi-check-circle-fill me-1"></i> Sudah Dijawab:</span>
                            <span class="fw-bold text-success">${terjawab}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-danger small"><i class="bi bi-exclamation-circle-fill me-1"></i> Belum Dijawab:</span>
                            <span class="fw-bold text-danger">${belumDijawab}</span>
                        </div>
                    </div>
                    <p class="text-muted small mb-0">
                        Setelah dikumpulkan, Anda akan masuk ke masa jeda istirahat sebelum lanjut ke <strong>Subtes 2 (Kepribadian)</strong>.
                    </p>
                `,
                icon: 'question',
                iconColor: '#2563eb',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: '<i class="bi bi-check2-circle me-1"></i> Ya, Kumpulkan Jawaban',
                cancelButtonText: 'Periksa Kembali',
                customClass: {
                    popup: 'cat-custom-popup',
                    title: 'cat-custom-title',
                    htmlContainer: 'cat-custom-html',
                    confirmButton: 'cat-custom-btn-blue',
                    cancelButton: 'cat-custom-btn-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formKecerdasan').submit();
                }
            });
        }

        // Timer Hitung Mundur Sesuai $durasiMenit
        let sisaDetik = {{ ($durasiMenit ?? 90) * 60 }};
        const timerElement = document.getElementById('timerKecerdasan');

        function updateTimer() {
            let menit = Math.floor(sisaDetik / 60);
            let detik = sisaDetik % 60;
            timerElement.innerText = 
                String(menit).padStart(2, '0') + ':' + String(detik).padStart(2, '0');
        }

        updateTimer();
        bukaSoal(1);

        const timerInterval = setInterval(function() {
            sisaDetik--;
            updateTimer();

            // Saat waktu habis (0 detik)
            if (sisaDetik <= 0) {
                clearInterval(timerInterval);

                // Pop-up Modern Waktu Habis
                Swal.fire({
                    icon: 'warning',
                    iconColor: '#ef4444',
                    title: 'Waktu Ujian Telah Habis!',
                    html: `
                        <div class="mt-2">
                            <p class="mb-2 text-secondary">
                                Waktu pengerjaan untuk <strong>Subtes 1 (Kecerdasan)</strong> telah selesai.
                            </p>
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-bold">
                                Jawaban Anda tersimpan otomatis
                            </span>
                        </div>
                    `,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: true,
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'Lanjut ke Tahap Jeda <i class="bi bi-arrow-right-short fs-5 align-middle"></i>',
                    timer: 5000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'cat-custom-popup',
                        title: 'cat-custom-title',
                        htmlContainer: 'cat-custom-html',
                        confirmButton: 'cat-custom-btn-blue'
                    }
                }).then(() => {
                    document.getElementById('formKecerdasan').submit();
                });
            }
        }, 1000);
    </script>
</body>
</html>