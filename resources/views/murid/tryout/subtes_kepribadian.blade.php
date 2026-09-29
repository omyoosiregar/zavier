<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subtes 2: Kepribadian - {{ $tryout->judul_tryout }}</title>

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

        html, body {
            height: 100vh;
            width: 100vw;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #f4f8fd;
            font-family: "Segoe UI", -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
            color: #1e293b;
        }

        .exam-viewport {
            height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 18px 28px;
            max-width: 880px;
            margin: auto;
        }

        .header-bar-compact {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 10px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
            flex-shrink: 0;
        }

        .timer-badge-kepribadian {
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 6px 14px;
            border-radius: 10px;
            background: #ecfdf5;
            color: #059669;
            border: 1.5px solid #a7f3d0;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Courier New', Courier, monospace;
        }

        .timer-warning {
            background: #fef2f2 !important;
            color: #dc2626 !important;
            border-color: #fca5a5 !important;
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .card-exam-compact {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            padding: 24px 32px;
            box-shadow: 0 8px 24px rgba(19, 42, 74, 0.04);
            flex-grow: 1;
            margin: 14px 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            max-height: calc(100vh - 140px);
        }

        .progress-indicator {
            height: 4px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, #10b981, #059669);
            transition: width 0.25s ease;
        }

        .question-statement-box {
            flex-shrink: 0;
            margin-bottom: 14px;
        }

        .question-statement-text {
            font-size: 18px;
            font-weight: 700;
            line-height: 1.5;
            color: #0f172a;
        }

        .options-list-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex-grow: 1;
            justify-content: center;
        }

        .option-item-label {
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            padding: 12px 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: all 0.15s ease;
            background: #ffffff;
            font-size: 15px;
            margin: 0;
        }

        .option-item-label:hover {
            border-color: #10b981;
            background: #f0fdf4;
            transform: translateY(-1px);
        }

        .option-item-label.active-choice {
            border-color: #059669;
            background: #ecfdf5;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.12);
        }

        .option-item-label.active-choice .option-text {
            color: #065f46;
            font-weight: 700;
        }

        .option-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.15s ease;
        }

        .option-item-label.active-choice .option-dot {
            border-color: #059669;
            background: #059669;
        }

        .option-item-label.active-choice .option-dot::after {
            content: '';
            width: 6px;
            height: 6px;
            background: #ffffff;
            border-radius: 50%;
        }

        .exam-footer-note {
            flex-shrink: 0;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
        }

        /* Custom Styling SweetAlert2 Popup */
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
            margin-top: 12px !important;
        }
        .swal2-html-container.cat-custom-html {
            font-size: 14.5px !important;
            color: #64748b !important;
            line-height: 1.6 !important;
        }
        .swal2-confirm.cat-custom-btn {
            border-radius: 50px !important;
            padding: 12px 32px !important;
            font-weight: 700 !important;
            font-size: 14.5px !important;
            box-shadow: 0 4px 14px rgba(220, 38, 38, 0.35) !important;
        }
    </style>
</head>
<body>

    <div class="exam-viewport">

        <!-- Top Header Kompak -->
        <header class="header-bar-compact">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-success px-2 py-1 rounded-pill fw-bold" style="font-size: 10px;">
                    SUBTES 2
                </span>
                <span class="fw-bold text-dark small text-truncate" style="max-width: 320px;">
                    {{ $tryout->judul_tryout }}
                </span>
            </div>
            <div>
                <div class="timer-badge-kepribadian" id="timerBadgeKepribadian">
                    <i class="bi bi-stopwatch-fill"></i>
                    <span id="countdownKepribadian">--:--</span>
                </div>
            </div>
        </header>

        <!-- Form Ujian Kepribadian -->
        <form action="{{ route('murid.tryout.submit.kepribadian', $hasil->id) }}" method="POST" id="formKepribadian" style="display: contents;">
            @csrf

            @php
                $totalSoal =$soalsKepribadian->count();
            @endphp

            @forelse($soalsKepribadian as $idx =>$sk)
                @php
                    $nomor =$idx + 1;
                    $item = (object)$sk;
                    $teksPernyataan =$item->pernyataan ?? $item->soal ?? $item->pertanyaan ?? ('Pernyataan No. ' . $nomor);

                    $opsiList = [];
                    if (isset($item->pilihan_a) && isset($item->pilihan_b)) {
                        foreach(['A' => 'pilihan_a', 'B' => 'pilihan_b', 'C' => 'pilihan_c', 'D' => 'pilihan_d', 'E' => 'pilihan_e'] as $key =>$col) {
                            if (isset($item->$col) && trim($item->$col) !== '') {$opsiList[] = [
                                    'value' => $key,
                                    'text'  => $item->$col,
                                ];
                            }
                        }
                    } else {
                        $opsiList = [
                            ['value' => 'A', 'text' => 'Sangat Sesuai (SS)'],
                            ['value' => 'B', 'text' => 'Sesuai (S)'],
                            ['value' => 'C', 'text' => 'Ragu-ragu (R)'],
                            ['value' => 'D', 'text' => 'Tidak Sesuai (TS)'],
                            ['value' => 'E', 'text' => 'Sangat Tidak Sesuai (STS)'],
                        ];
                    }
                @endphp

                <div class="card-exam-compact soal-single-item" id="soal-box-{{ $nomor }}" style="display: {{ $nomor === 1 ? 'flex' : 'none' }};">

                    <!-- Progress dan Pertanyaan -->
                    <div class="question-statement-box">
                        <div class="progress-indicator">
                            <div class="progress-bar-fill" style="width: {{ ($nomor / max($totalSoal, 1)) * 100 }}%;"></div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-bold" style="font-size: 12px;">
                                Soal {{ $nomor }} dari {{$totalSoal }}
                            </span>
                            <span class="text-muted" style="font-size: 11px;">
                                <i class="bi bi-shield-check me-1"></i> Penilaian Sikap Kerja
                            </span>
                        </div>

                        <div class="question-statement-text mt-2">
                            {{ $teksPernyataan }}
                        </div>
                    </div>

                    <!-- Pilihan Jawaban -->
                    <div class="options-list-container">
                        @foreach($opsiList as $optIdx =>$opt)
                            @php
                                $labelHuruf = chr(65 +$optIdx);
                            @endphp
                            <label class="option-item-label w-100" onclick="autoPilihLanjut(this, {{ $nomor }})">
                                <div class="option-dot"></div>
                                <input type="radio"
                                       name="jawaban_kepribadian[{{ $item->id }}]"
                                       value="{{ $opt['value'] }}"
                                       class="d-none">
                                <span class="option-text">
                                    <strong>{{ $labelHuruf }}.</strong> {{$opt['text'] }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    <div class="exam-footer-note">
                        <i class="bi bi-lock-fill me-1"></i> Jawaban langsung tersimpan dan tidak dapat diubah kembali.
                    </div>

                </div>

            @empty
                <div class="card-exam-compact text-center justify-content-center">
                    <i class="bi bi-folder-x text-muted" style="font-size: 40px;"></i>
                    <h6 class="fw-bold mt-2 text-dark">Belum Ada Soal Kepribadian</h6>
                    <p class="text-muted small mb-0">Paket ini belum memiliki butir soal kepribadian aktif di database.</p>
                </div>
            @endforelse

        </form>

    </div>

    <!-- Bootstrap 5 JS & SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const totalSoal = {{ $totalSoal }};
        let activeNomor = 1;
        let isProcessing = false;

        function autoPilihLanjut(element, nomor) {
            if (isProcessing) return;
            isProcessing = true;

            const parentBox = document.getElementById('soal-box-' + nomor);
            parentBox.querySelectorAll('.option-item-label').forEach(lbl => lbl.classList.remove('active-choice'));
            element.classList.add('active-choice');

            const radio = element.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;

            setTimeout(function() {
                if (nomor < totalSoal) {
                    parentBox.style.display = 'none';

                    activeNomor = nomor + 1;
                    const nextBox = document.getElementById('soal-box-' + activeNomor);
                    if (nextBox) {
                        nextBox.style.display = 'flex';
                    }
                    isProcessing = false;
                } else {
                    // Ketika nomor terakhir selesai -> Munculkan Modal Modern Konfirmasi
                    isProcessing = false;
                    Swal.fire({
                        title: 'Selesai Subtes Kepribadian?',
                        text: 'Seluruh butir pernyataan telah Anda jawab. Ingin mengakhiri sesi dan melanjutkan ke tahap berikutnya?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#059669',
                        cancelButtonColor: '#94a3b8',
                        confirmButtonText: '<i class="bi bi-check2-circle me-1"></i> Ya, Akhiri Subtes',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'cat-custom-popup',
                            title: 'cat-custom-title',
                            htmlContainer: 'cat-custom-html',
                            confirmButton: 'cat-custom-btn'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('formKepribadian').submit();
                        }
                    });
                }
            }, 180);
        }

        // =========================================================================
        // PENGATURAN TIMER & NOTIFIKASI WAKTU HABIS YANG ELEGAN & MENARIK
        // =========================================================================
        let sisaDetik = {{ ($durasiMenit ?? 60) * 60 }};
        const timerDigits = document.getElementById('countdownKepribadian');
        const timerBadge  = document.getElementById('timerBadgeKepribadian');

        function formatTimer() {
            let menit = Math.floor(sisaDetik / 60);
            let detik = Math.floor(sisaDetik % 60);
            timerDigits.innerText = String(menit).padStart(2, '0') + ':' + String(detik).padStart(2, '0');
        }

        formatTimer();

        const timerInterval = setInterval(function() {
            sisaDetik--;
            formatTimer();

            // Beri efek berkedip merah jika waktu tersisa 5 menit
            if (sisaDetik <= 300) {
                timerBadge.classList.add('timer-warning');
            }

            // Saat waktu habis (0 detik)
            if (sisaDetik <= 0) {
                clearInterval(timerInterval);

                // TAMPILKAN NOTIFIKASI MODERN SWEETALERT2
                Swal.fire({
                    icon: 'warning',
                    iconColor: '#ef4444',
                    title: 'Waktu Ujian Telah Habis!',
                    html: `
                        <div class="mt-2">
                            <p class="mb-2 text-secondary">
                                Waktu pengerjaan untuk <strong>Subtes 2 (Kepribadian)</strong> telah selesai.
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
                    confirmButtonText: 'Lanjut ke Tahap Berikutnya <i class="bi bi-arrow-right-short fs-5 align-middle"></i>',
                    timer: 5000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'cat-custom-popup',
                        title: 'cat-custom-title',
                        htmlContainer: 'cat-custom-html',
                        confirmButton: 'cat-custom-btn'
                    }
                }).then(() => {
                    document.getElementById('formKepribadian').submit();
                });
            }
        }, 1000);
    </script>
</body>
</html>