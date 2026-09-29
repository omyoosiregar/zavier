<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian Kecermatan - {{ $tryout->judul_tryout }}</title>
    
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
            background-color: #f8fafc;
            color: #1e293b;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }

        .exam-page-container {
            max-width: 1200px;
            margin: 16px auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            height: calc(100vh - 32px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        /* Top Header */
        .exam-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 16px;
            margin-bottom: 20px;
        }

        .exam-title {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .kolom-badge {
            background-color: #0284c7;
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            padding: 6px 16px;
            border-radius: 6px;
            display: inline-block;
        }

        .kolom-total-text {
            font-size: 15px;
            font-weight: 600;
            color: #334155;
            margin-left: 6px;
        }

        .timer-box {
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            padding: 6px 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            background: #ffffff;
        }

        /* Tabel Panduan Karakter Induk */
        .table-panduan-container {
            max-width: 720px;
            margin: 0 auto 20px auto;
            width: 100%;
        }

        .table-panduan {
            width: 100%;
            border: 1px solid #94a3b8;
            border-collapse: collapse;
            text-align: center;
            background: #ffffff;
        }

        .table-panduan .th-header {
            border: 1px solid #94a3b8;
            padding: 8px;
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            background-color: #ffffff;
        }

        .table-panduan .td-karakter {
            border: 1px solid #94a3b8;
            padding: 10px 6px;
            font-size: 30px;
            font-weight: 700;
            height: 64px;
            vertical-align: middle;
        }

        .table-panduan .td-huruf {
            border: 1px solid #94a3b8;
            padding: 6px;
            font-size: 17px;
            font-weight: 600;
            color: #0f172a;
            background-color: #ffffff;
        }

        /* Kotak Soal Karakter Hilang */
        .box-soal-display {
            border: 2px solid #334155;
            max-width: 520px;
            margin: 0 auto 22px auto;
            padding: 12px 20px;
            background: #ffffff;
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 72px;
        }

        .soal-item-char {
            font-size: 32px;
            font-weight: 700;
            color: #0f172a;
        }

        /* Tombol Pilihan Jawaban A, B, C, D, E */
        .options-button-row {
            display: flex;
            justify-content: center;
            gap: 16px;
            max-width: 820px;
            margin: 0 auto 20px auto;
        }

        .btn-option-choice {
            flex: 1;
            height: 54px;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 22px;
            font-weight: 500;
            color: #1e293b;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.1s ease;
        }

        .btn-option-choice:hover:not(:disabled) {
            background-color: #f1f5f9;
            border-color: #94a3b8;
        }

        .btn-option-choice:active:not(:disabled),
        .btn-option-choice.clicked {
            background-color: #0284c7;
            color: #ffffff;
            border-color: #0284c7;
        }

        .btn-option-choice:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Alert Petunjuk */
        .alert-instruction {
            background-color: #f0f9ff;
            border: 1px solid #bae6fd;
            color: #0369a1;
            border-radius: 6px;
            padding: 10px 16px;
            font-size: 13.5px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Footer Bawah */
        .footer-action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 14px;
            margin-top: 10px;
        }

        .btn-akhiri-ujian {
            background-color: #dc2626;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 8px 18px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background-color 0.15s ease;
            cursor: pointer;
        }

        .btn-akhiri-ujian:hover {
            background-color: #b91c1c;
        }

        .btn-keluar-preview {
            background: transparent;
            border: 1px solid #cbd5e1;
            color: #475569;
            border-radius: 6px;
            padding: 7px 16px;
            font-size: 13.5px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        /* Overlay Blackout 3 Detik */
        .blackout-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #000000;
            z-index: 99999;
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #ffffff;
        }

        .blackout-countdown {
            font-size: 120px;
            font-weight: 900;
            font-family: 'Courier New', Courier, monospace;
            color: #ef4444;
            text-shadow: 0 0 30px rgba(239, 68, 68, 0.8);
            animation: pulseBig 1s infinite;
        }

        .blackout-text {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #cbd5e1;
            text-transform: uppercase;
            margin-top: 10px;
        }

        @keyframes pulseBig {
            0% { transform: scale(1); }
            50% { transform: scale(1.08); }
            100% { transform: scale(1); }
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
            margin-top: 10px !important;
        }
        .swal2-html-container.cat-custom-html {
            font-size: 14.5px !important;
            color: #64748b !important;
            line-height: 1.6 !important;
        }
        .swal2-confirm.cat-custom-btn-danger {
            background-color: #dc2626 !important;
            border-radius: 50px !important;
            padding: 12px 32px !important;
            font-weight: 700 !important;
            font-size: 14.5px !important;
            box-shadow: 0 4px 14px rgba(220, 38, 38, 0.35) !important;
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

    <!-- OVERLAY BLACKOUT 3 DETIK -->
    <div class="blackout-overlay" id="blackoutOverlay">
        <div class="blackout-countdown" id="blackoutSeconds">3</div>
        <div class="blackout-text">PERSIAPAN KOLOM BERIKUTNYA...</div>
    </div>

    <div class="exam-page-container">
        
        <form action="{{ route('murid.tryout.submit.kecermatan', $hasil->id) }}" method="POST" id="formSubmitKecermatan" style="display: contents;">
            @csrf
            <input type="hidden" name="nilai_kecermatan" id="inputNilaiKecermatan" value="80">

            <div>
                <!-- TOP HEADER -->
                <div class="exam-header">
                    <h1 class="exam-title">Ujian Kecermatan</h1>

                    <div>
                        <span class="kolom-badge" id="kolomBadgeTitle">Kolom</span>
                        <span class="kolom-total-text" id="kolomNumberText">1 / 10</span>
                    </div>

                    <div class="timer-box">
                        <i class="bi bi-stopwatch"></i>
                        <span id="countdownTimer">01:00</span>
                    </div>
                </div>

                <!-- 1. TABEL PANDUAN -->
                <div class="table-panduan-container">
                    <table class="table-panduan">
                        <thead>
                            <tr>
                                <th colspan="5" class="th-header" id="labelNamaKolom">Kolom 1</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td-karakter" id="char-A">🌙</td>
                                <td class="td-karakter" id="char-B">🌊</td>
                                <td class="td-karakter" id="char-C">🚢</td>
                                <td class="td-karakter" id="char-D">🚦</td>
                                <td class="td-karakter" id="char-E">🚒</td>
                            </tr>
                            <tr>
                                <td class="td-huruf">A</td>
                                <td class="td-huruf">B</td>
                                <td class="td-huruf">C</td>
                                <td class="td-huruf">D</td>
                                <td class="td-huruf">E</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 2. KOTAK SOAL -->
                <div class="box-soal-display" id="soalBoxContainer">
                    <span class="soal-item-char" id="soal-1">🚒</span>
                    <span class="soal-item-char" id="soal-2">🌙</span>
                    <span class="soal-item-char" id="soal-3">🌊</span>
                    <span class="soal-item-char" id="soal-4">🚢</span>
                </div>

                <!-- 3. TOMBOL PILIHAN A, B, C, D, E -->
                <div class="options-button-row">
                    <button type="button" class="btn-option-choice" onclick="jawab('A')">A</button>
                    <button type="button" class="btn-option-choice" onclick="jawab('B')">B</button>
                    <button type="button" class="btn-option-choice" onclick="jawab('C')">C</button>
                    <button type="button" class="btn-option-choice" onclick="jawab('D')">D</button>
                    <button type="button" class="btn-option-choice" onclick="jawab('E')">E</button>
                </div>

                <!-- ALERT PETUNJUK -->
                <div class="alert-instruction">
                    <i class="bi bi-info-circle-fill"></i>
                    <span>Pilih huruf yang sesuai dengan pola berdasarkan kunci jawaban di atas.</span>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="footer-action-bar">
                <button type="button" class="btn-akhiri-ujian" onclick="konfirmasiSelesai()">
                    <i class="bi bi-arrow-right"></i> Akhiri Ujian
                </button>
                <a href="{{ route('murid.paket-soal') }}" class="btn-keluar-preview" onclick="konfirmasiKeluar(event, this.href)">
                    <i class="bi bi-arrow-right"></i> Keluar
                </a>
            </div>

        </form>

    </div>

    @php
        $listKolomRaw = [];
        if (isset($kolomList) &&$kolomList->isNotEmpty()) {
            foreach ($kolomList as$idx => $k) {$listKolomRaw[] = [
                    'nama' => 'Kolom ' . ($idx + 1),
                    'A' => $k->karakter_a ?? $k->a ?? '🌙',
                    'B' => $k->karakter_b ?? $k->b ?? '🌊',
                    'C' => $k->karakter_c ?? $k->c ?? '🚢',
                    'D' => $k->karakter_d ?? $k->d ?? '🚦',
                    'E' => $k->karakter_e ?? $k->e ?? '🚒',
                ];
            }
        }

        if (empty($listKolomRaw)) {$listKolomRaw = [
                ['nama' => 'Kolom 1',  'A' => '🌙', 'B' => '🌊', 'C' => '🚢', 'D' => '🚦', 'E' => '🚒'],
                ['nama' => 'Kolom 2',  'A' => '7',  'B' => 'K',  'C' => '4',  'D' => 'B',  'E' => '9'],
                ['nama' => 'Kolom 3',  'A' => 'M',  'B' => '8',  'C' => 'R',  'D' => '5',  'E' => 'P'],
                ['nama' => 'Kolom 4',  'A' => '3',  'B' => 'X',  'C' => '6',  'D' => 'T',  'E' => '2'],
                ['nama' => 'Kolom 5',  'A' => 'H',  'B' => '9',  'C' => 'W',  'D' => '7',  'E' => 'Q'],
                ['nama' => 'Kolom 6',  'A' => '5',  'B' => 'J',  'C' => '1',  'D' => 'S',  'E' => '8'],
                ['nama' => 'Kolom 7',  'A' => 'B',  'B' => '6',  'C' => 'F',  'D' => '3',  'E' => 'N'],
                ['nama' => 'Kolom 8',  'A' => 'Z',  'B' => '2',  'C' => 'L',  'D' => '9',  'E' => 'Y'],
                ['nama' => 'Kolom 9',  'A' => '4',  'B' => 'D',  'C' => '8',  'D' => 'G',  'E' => '1'],
                ['nama' => 'Kolom 10', 'A' => 'V',  'B' => '5',  'C' => 'K',  'D' => '7',  'E' => 'C'],
            ];
        }
    @endphp

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const kolomData = @json($listKolomRaw);
        const totalKolom = kolomData.length;
        const durasiPerKolomDetik = 60; // 1 Menit per kolom

        let currentKolomIndex = 0;
        let sisaDetik = durasiPerKolomDetik;
        let karakterHilangKunci = '';
        let canAnswer = true;

        let totalJawaban = 0;
        let totalBenar = 0;

        const blackoutOverlay = document.getElementById('blackoutOverlay');
        const blackoutSeconds = document.getElementById('blackoutSeconds');

        function loadKolom(index) {
            const data = kolomData[index];
            document.getElementById('labelNamaKolom').innerText = data.nama || `Kolom ${index + 1}`;
            document.getElementById('kolomNumberText').innerText = `${index + 1} / ${totalKolom}`;

            document.getElementById('char-A').innerText = data.A;
            document.getElementById('char-B').innerText = data.B;
            document.getElementById('char-C').innerText = data.C;
            document.getElementById('char-D').innerText = data.D;
            document.getElementById('char-E').innerText = data.E;

            canAnswer = true;
            blackoutOverlay.style.display = 'none';
            document.querySelectorAll('.btn-option-choice').forEach(b => b.disabled = false);

            generateSoal();
        }

        function generateSoal() {
            const data = kolomData[currentKolomIndex];
            const keys = ['A', 'B', 'C', 'D', 'E'];

            const indexHilang = Math.floor(Math.random() * keys.length);
            karakterHilangKunci = keys[indexHilang];

            const tampilKeys = keys.filter(k => k !== karakterHilangKunci);
            tampilKeys.sort(() => Math.random() - 0.5);

            document.getElementById('soal-1').innerText = data[tampilKeys[0]];
            document.getElementById('soal-2').innerText = data[tampilKeys[1]];
            document.getElementById('soal-3').innerText = data[tampilKeys[2]];
            document.getElementById('soal-4').innerText = data[tampilKeys[3]];
        }

        function jawab(huruf) {
            if (!canAnswer) return;

            totalJawaban++;
            if (huruf === karakterHilangKunci) {
                totalBenar++;
            }

            const kalkulasiNilai = Math.min(100, Math.round((totalBenar / Math.max(1, totalJawaban)) * 100));
            document.getElementById('inputNilaiKecermatan').value = kalkulasiNilai > 0 ? kalkulasiNilai : 75;

            document.querySelectorAll('.btn-option-choice').forEach(btn => {
                if (btn.innerText.trim() === huruf) {
                    btn.classList.add('clicked');
                    setTimeout(() => btn.classList.remove('clicked'), 100);
                }
            });

            generateSoal();
        }

        window.addEventListener('keydown', function(e) {
            if (!canAnswer) return;
            const key = e.key.toUpperCase();
            if (['A', 'B', 'C', 'D', 'E'].includes(key)) {
                jawab(key);
            }
        });

        function updateTimerDisplay() {
            let menit = Math.floor(sisaDetik / 60);
            let detik = sisaDetik % 60;
            document.getElementById('countdownTimer').innerText = 
                String(menit).padStart(2, '0') + ':' + String(detik).padStart(2, '0');
        }

        loadKolom(currentKolomIndex);
        updateTimerDisplay();

        const timerInterval = setInterval(function() {
            sisaDetik--;
            updateTimerDisplay();

            // Mekanisme 3 Detik Terakhir: Layar Hitam
            if (sisaDetik <= 3 && sisaDetik > 0) {
                canAnswer = false;
                document.querySelectorAll('.btn-option-choice').forEach(b => b.disabled = true);

                blackoutOverlay.style.display = 'flex';
                blackoutSeconds.innerText = sisaDetik;
            }

            // Saat waktu kolom habis (0 detik)
            if (sisaDetik <= 0) {
                if (currentKolomIndex < totalKolom - 1) {
                    currentKolomIndex++;
                    sisaDetik = durasiPerKolomDetik;
                    loadKolom(currentKolomIndex);
                    updateTimerDisplay();
                } else {
                    clearInterval(timerInterval);
                    blackoutOverlay.style.display = 'none';

                    // Pop-up Modern saat Seluruh Kolom Selesai
                    Swal.fire({
                        icon: 'success',
                        iconColor: '#0284c7',
                        title: 'Seluruh Kolom Selesai!',
                        html: `
                            <p class="mb-2 text-secondary">
                                Rangkaian <strong>Subtes 3 (Kecermatan)</strong> telah selesai dikerjakan.
                            </p>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-bold">
                                Mengkalkulasi nilai akhir Tryout Psikologi...
                            </span>
                        `,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: true,
                        confirmButtonText: 'Lihat Hasil Akhir & Rapor <i class="bi bi-arrow-right-short fs-5 align-middle"></i>',
                        timer: 5000,
                        timerProgressBar: true,
                        customClass: {
                            popup: 'cat-custom-popup',
                            title: 'cat-custom-title',
                            htmlContainer: 'cat-custom-html',
                            confirmButton: 'cat-custom-btn-danger'
                        }
                    }).then(() => {
                        document.getElementById('formSubmitKecermatan').submit();
                    });
                }
            }
        }, 1000);

        // =========================================================================
        // POP-UP KONFIRMASI MODERN (PENGGANTI ALERT BAWAAN BROWSER)
        // =========================================================================
        function konfirmasiSelesai() {
            Swal.fire({
                title: 'Akhiri Ujian Kecermatan?',
                html: `
                    <div class="mt-2 text-start bg-light p-3 rounded-4 border mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-secondary small">Kolom Sedang Berjalan:</span>
                            <span class="fw-bold text-dark">Kolom ${currentKolomIndex + 1} dari ${totalKolom}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-secondary small">Total Jawaban Terinput:</span>
                            <span class="fw-bold text-primary">${totalJawaban} Karakter</span>
                        </div>
                    </div>
                    <p class="text-muted small mb-0">
                        Apakah Anda yakin ingin mengakhiri rangkaian tryout sekarang dan langsung mengkalkulasi rapor nilai akhir?
                    </p>
                `,
                icon: 'warning',
                iconColor: '#dc2626',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: '<i class="bi bi-check2-circle me-1"></i> Ya, Akhiri & Lihat Hasil',
                cancelButtonText: 'Lanjutkan Ujian',
                customClass: {
                    popup: 'cat-custom-popup',
                    title: 'cat-custom-title',
                    htmlContainer: 'cat-custom-html',
                    confirmButton: 'cat-custom-btn-danger',
                    cancelButton: 'cat-custom-btn-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    clearInterval(timerInterval);
                    document.getElementById('formSubmitKecermatan').submit();
                }
            });
        }

        function konfirmasiKeluar(e, targetUrl) {
            e.preventDefault();
            Swal.fire({
                title: 'Keluar dari Ujian?',
                text: 'Progress ujian kecermatan Anda akan dihentikan jika Anda meninggalkan halaman ini.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#64748b',
                cancelButtonColor: '#0284c7',
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Kembali Ujian',
                customClass: {
                    popup: 'cat-custom-popup',
                    title: 'cat-custom-title',
                    htmlContainer: 'cat-custom-html',
                    confirmButton: 'cat-custom-btn-danger',
                    cancelButton: 'cat-custom-btn-cancel'
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    window.location.href = targetUrl;
                }
            });
        }
    </script>
</body>
</html>