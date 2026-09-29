<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Istirahat - {{ $tryout->judul_tryout }}</title>

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: #0f172a;
            color: #f8fafc;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .break-box {
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 40px 32px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .badge-stage {
            background: rgba(56, 189, 248, 0.12);
            color: #38bdf8;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.8px;
            padding: 6px 14px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
        }

        /* Container Timer Minimalis */
        .timer-card {
            background: #0f172a;
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            padding: 24px;
            margin: 28px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .timer-digits {
            font-size: 52px;
            font-weight: 800;
            letter-spacing: 3px;
            color: #38bdf8;
            font-family: 'Segoe UI', monospace;
            line-height: 1;
        }

        .timer-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #64748b;
            font-weight: 600;
            margin-top: 8px;
        }

        /* Kotak Motivasi */
        .quote-box {
            background: rgba(15, 23, 42, 0.6);
            border-left: 3px solid #38bdf8;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 28px;
            text-align: left;
        }

        .quote-text {
            font-size: 13.5px;
            color: #cbd5e1;
            line-height: 1.5;
            font-style: italic;
            margin-bottom: 6px;
        }

        .quote-sub {
            font-size: 11.5px;
            color: #94a3b8;
            font-weight: 600;
        }

        /* Tombol Lanjut */
        .btn-lanjut {
            background: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 14px;
            padding: 14px 28px;
            font-weight: 700;
            font-size: 15px;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-lanjut:hover {
            background: #1d4ed8;
            color: #ffffff;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <div class="break-box">
        @php
            $targetSubtes = ($hasil->tahap_sekarang === 'jeda_1') ? 'Subtes 2: Kepribadian' : 'Subtes 3: Kecermatan';
            $iconTarget   = ($hasil->tahap_sekarang === 'jeda_1') ? 'bi-person-badge-fill' : 'bi-bullseye';
        @endphp

        <span class="badge-stage mb-3">
            <i class="bi bi-cup-hot-fill"></i> Jeda Istirahat
        </span>

        <h4 class="fw-bold text-white mb-2">Tarik Napas & Istirahat Sejenak</h4>
        <p class="small mb-0" style="color: #94a3b8; font-size: 13px;">
            Subtes sebelumnya telah tersimpan. Istirahatkan mata dan pikiran sebelum masuk ke tahap berikutnya.
        </p>

        <!-- Kotak Hitung Mundur Bersih (MM:SS) -->
        <div class="timer-card">
            <div class="timer-digits" id="timerDisplay">05:00</div>
            <div class="timer-label">Sisa Waktu Jeda</div>
        </div>

        <!-- Kata Motivasi Psikologi -->
        <div class="quote-box">
            <div class="quote-text" id="quoteText">
                "Ketenangan adalah kunci ketelitian. Atur napas dan siapkan fokus terbaikmu."
            </div>
            <div class="quote-sub">
                <i class="bi {{ $iconTarget }} me-1 text-info"></i> Lanjut Ke: <strong>{{ $targetSubtes }}</strong>
            </div>
        </div>

        <!-- Tombol Lanjut ke Subtes Berikutnya -->
        <form action="{{ route('murid.tryout.skip_jeda', $hasil->id) }}" method="POST" id="formLanjut">
            @csrf
            <button type="submit" class="btn-lanjut">
                <span>Lanjut ke {{ $targetSubtes }}</span>
                <i class="bi bi-arrow-right"></i>
            </button>
        </form>
    </div>

    <script>
        // Acak kutipan motivasi
        const motivasi = [
            "“Ketenangan adalah kunci ketelitian. Atur napas dan siapkan fokus terbaikmu.”",
            "“Setiap subtes adalah kesempatan baru. Berikan performa konsisten hingga akhir.”",
            "“Jaga ritme dan konsentrasi. Ujian ini menguji daya tahan mental Anda.”",
            "“Tinggalkan lembar sebelumnya, satukan energi penuh untuk subtes berikutnya.”"
        ];
        document.getElementById('quoteText').innerText = motivasi[Math.floor(Math.random() * motivasi.length)];

        // Ambil sisa detik dari server
        @php
            $waktuSelesai = $hasil->jeda_selesai_pada ? \Carbon\Carbon::parse($hasil->jeda_selesai_pada) : now()->addMinutes(5);
            $sisaDetikServer = (int) now()->diffInSeconds($waktuSelesai, false);
        @endphp

        let sisaDetik = Math.floor({{ $sisaDetikServer > 0 ? $sisaDetikServer : 300 }});
        const timerDisplay = document.getElementById('timerDisplay');
        const formLanjut = document.getElementById('formLanjut');

        function renderTimer() {
            let menit = Math.floor(sisaDetik / 60);
            let detik = Math.floor(sisaDetik % 60);

            // Tampilkan murni MM:SS
            timerDisplay.innerText = 
                String(menit).padStart(2, '0') + ':' + 
                String(detik).padStart(2, '0');
        }

        renderTimer();

        const jedaInterval = setInterval(function() {
            sisaDetik--;

            if (sisaDetik <= 0) {
                clearInterval(jedaInterval);
                timerDisplay.innerText = "00:00";
                formLanjut.submit();
            } else {
                renderTimer();
            }
        }, 1000);
    </script>
</body>
</html>