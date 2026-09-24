<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $paket->nama_paket }} - Ujian Kecerdasan</title>

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-cbt: #2563eb;
            --primary-dark: #1d4ed8;
            --border-ui: #e2e8f0;
            --bg-canvas: #f1f5f9;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-canvas);
            color: var(--text-dark);
            margin: 0;
            padding-bottom: 50px;
        }

        /* Navbar Header Standar */
        .cbt-navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--border-ui);
            padding: 12px 24px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .exam-info-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .exam-info-sub {
            font-size: 13px;
            color: var(--text-muted);
        }

        .timer-badge {
            background: #0f172a;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            letter-spacing: 0.5px;
        }

        .timer-badge.warning {
            background: #dc2626;
        }

        /* Lembar Soal */
        .exam-card {
            background: #ffffff;
            border: 1px solid var(--border-ui);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .q-header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-ui);
            padding-bottom: 14px;
            margin-bottom: 20px;
        }

        .q-number-pill {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            background: #f8fafc;
            border: 1px solid var(--border-ui);
            padding: 6px 14px;
            border-radius: 6px;
        }

        .question-statement {
            font-size: 16px;
            line-height: 1.7;
            font-weight: 500;
            color: #0f172a;
            margin-bottom: 20px;
        }

        .question-img-container {
            margin: 15px 0 25px;
        }

        .question-img-container img {
            max-height: 320px;
            max-width: 100%;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            object-fit: contain;
        }

        /* Pilihan Ganda Vertikal */
        .options-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 30px;
        }

        .option-row {
            border: 1.5px solid var(--border-ui);
            border-radius: 8px;
            padding: 12px 18px;
            background: #ffffff;
            cursor: pointer;
            transition: all 0.15s ease;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .option-row:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }

        .option-row.selected {
            border-color: var(--primary-cbt);
            background: #eff6ff;
        }

        .option-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1.5px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            background: #ffffff;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .option-row.selected .option-circle {
            border-color: var(--primary-cbt);
            background: var(--primary-cbt);
            color: #ffffff;
        }

        .option-body {
            font-size: 15px;
            color: #1e293b;
            line-height: 1.6;
            margin-top: 4px;
            flex: 1;
        }

        .option-body img {
            max-height: 120px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            margin-top: 8px;
            display: block;
        }

        /* Navigasi Bawah */
        .nav-footer {
            border-top: 1px solid var(--border-ui);
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-cbt {
            border-radius: 8px;
            padding: 10px 22px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.15s ease;
        }

        /* Sidebar Nomor Soal & Ringkasan */
        .sidebar-card {
            background: #ffffff;
            border: 1px solid var(--border-ui);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 85px;
        }

        .status-summary {
            background: #f8fafc;
            border: 1px solid var(--border-ui);
            border-radius: 8px;
            padding: 14px 16px;
            margin-bottom: 20px;
        }

        .stat-line {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .stat-line:last-child {
            margin-bottom: 0;
        }

        .number-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
            margin-bottom: 24px;
            max-height: 280px;
            overflow-y: auto;
            padding-right: 4px;
        }

        .btn-number {
            height: 38px;
            width: 100%;
            border: 1px solid var(--border-ui);
            background: #ffffff;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-number:hover {
            border-color: #64748b;
        }

        .btn-number.active {
            border-color: var(--primary-cbt);
            background: #dbeafe;
            color: var(--primary-dark);
            box-shadow: 0 0 0 1.5px var(--primary-cbt);
        }

        .btn-number.answered {
            background: #16a34a;
            border-color: #16a34a;
            color: #ffffff;
        }

        .btn-finish-test {
            background: #dc2626;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 14px;
            font-weight: 600;
            width: 100%;
        }

        .btn-finish-test:hover {
            background: #b91c1c;
            color: #ffffff;
        }

        /* Modal Selesai Ujian Modern */
        .modal-confirm-content {
            border-radius: 18px;
            border: none;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.2);
            padding: 10px;
        }

        .modal-icon-wrap {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: #fef2f2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 16px;
        }
    </style>
</head>

<body>

    <!-- Header / Navbar Ujian -->
    <header class="cbt-navbar">
        <div class="container-fluid px-lg-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="exam-info-title">{{ $paket->nama_paket }}</h1>
                <div class="exam-info-sub">
                    Peserta: <strong>{{ auth()->user()->name ?? 'Peserta' }}</strong> | Kategori: Tes Kecerdasan
                </div>
            </div>

            <!-- Sisa Waktu Ujian -->
            <div class="timer-badge" id="timerBox">
                <i class="bi bi-clock"></i>
                <span id="timerText">--:--</span>
            </div>
        </div>
    </header>

    <div class="container-fluid px-lg-4 py-4">
        <div class="row g-4">

            <!-- Kolom Kiri: Lembar Soal -->
            <div class="col-lg-8">
                <form id="examForm" method="POST" action="{{ route('murid.kecerdasan.selesai', $hasil->id) }}">
                    @csrf

                    @foreach($soals as $index => $soal)
                        @php
                            $jawabanSaya = optional($hasil->jawaban)->firstWhere('soal_kecerdasan_id', $soal->id);
                        @endphp

                        <div class="exam-card question-item"
                             id="question-{{ $index }}"
                             data-number="{{ $index }}"
                             style="{{ $index === 0 ? '' : 'display:none;' }}">

                            <!-- Header Bar Nomor Soal -->
                            <div class="q-header-bar">
                                <span class="q-number-pill">Soal No. {{ $index + 1 }}</span>
                                <span class="text-muted small">Total: {{ $soals->count() }} Butir Soal</span>
                            </div>

                            <!-- Teks Soal -->
                            <div class="question-statement">
                                {!! $soal->pertanyaan !!}
                            </div>

                            <!-- Gambar Soal (Jika ada) -->
                            @if($soal->gambar_soal)
                                <div class="question-img-container text-start">
                                    <img src="{{ asset('storage/' . $soal->gambar_soal) }}"
                                         alt="Gambar Soal {{ $index + 1 }}">
                                </div>
                            @endif

                            <!-- Pilihan Jawaban Vertikal (A - E) -->
                            <div class="options-list">
                                @foreach([
                                    'A' => 'pilihan_a',
                                    'B' => 'pilihan_b',
                                    'C' => 'pilihan_c',
                                    'D' => 'pilihan_d',
                                    'E' => 'pilihan_e',
                                ] as $huruf => $field)
                                    @php
                                        $gambarField = 'gambar_' . strtolower($huruf);
                                    @endphp

                                    @if($soal->{$field} || $soal->{$gambarField})
                                        <div class="option-row {{ optional($jawabanSaya)->jawaban === $huruf ? 'selected' : '' }}"
                                             data-soal="{{ $soal->id }}"
                                             data-jawaban="{{ $huruf }}"
                                             onclick="pilihJawaban({{ $soal->id }}, '{{ $huruf }}', this)">

                                            <div class="option-circle">{{ $huruf }}</div>

                                            <div class="option-body">
                                                @if($soal->{$field})
                                                    <div>{!! nl2br(e($soal->{$field})) !!}</div>
                                                @endif

                                                @if($soal->{$gambarField})
                                                    <img src="{{ asset('storage/' . $soal->{$gambarField}) }}"
                                                         alt="Gambar Opsi {{ $huruf }}">
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Navigasi Bawah (Sebelumnya & Selanjutnya) -->
                            <div class="nav-footer">
                                <button type="button"
                                        class="btn btn-outline-secondary btn-cbt"
                                        onclick="previousQuestion()"
                                        id="prevBtn-{{ $index }}"
                                        {{ $index === 0 ? 'disabled' : '' }}>
                                    <i class="bi bi-chevron-left me-1"></i> Sebelumnya
                                </button>

                                @if($index < $soals->count() - 1)
                                    <button type="button"
                                            class="btn btn-primary btn-cbt"
                                            onclick="nextQuestion()">
                                        Selanjutnya <i class="bi bi-chevron-right ms-1"></i>
                                    </button>
                                @else
                                    <button type="button"
                                            class="btn btn-danger btn-cbt"
                                            onclick="bukaModalKonfirmasi()">
                                        <i class="bi bi-check2-circle me-1"></i> Selesai Ujian
                                    </button>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </form>
            </div>

            <!-- Kolom Kanan: Navigasi Nomor Soal & Ringkasan -->
            <div class="col-lg-4">
                <div class="sidebar-card">
                    <h6 class="fw-bold mb-3 text-dark">Navigasi Soal</h6>

                    <!-- Ringkasan Jawaban Terisi -->
                    <div class="status-summary">
                        <div class="stat-line">
                            <span class="text-muted">Sudah Dijawab:</span>
                            <strong class="text-success" id="answeredCount">{{ $hasil->jumlah_dijawab ?? 0 }}</strong>
                        </div>
                        <div class="stat-line">
                            <span class="text-muted">Belum Dijawab:</span>
                            <strong class="text-secondary" id="unansweredCount">{{ $soals->count() - ($hasil->jumlah_dijawab ?? 0) }}</strong>
                        </div>
                        <div class="stat-line border-top pt-1 mt-1">
                            <span class="text-muted">Total Soal:</span>
                            <strong>{{ $soals->count() }}</strong>
                        </div>
                    </div>

                    <!-- Palet Nomor Soal -->
                    <div class="number-grid">
                        @foreach($soals as $index => $soal)
                            @php
                                $sudahDijawab = optional($hasil->jawaban)->contains('soal_kecerdasan_id', $soal->id);
                            @endphp
                            <button type="button"
                                    class="btn-number {{ $sudahDijawab ? 'answered' : '' }} {{ $index === 0 ? 'active' : '' }}"
                                    id="nav-{{ $index }}"
                                    onclick="showQuestion({{ $index }})">
                                {{ $index + 1 }}
                            </button>
                        @endforeach
                    </div>

                    <!-- Tombol Akhiri & Keluar -->
                    <button type="button" class="btn btn-finish-test mb-2" onclick="bukaModalKonfirmasi()">
                        Selesai & Kumpulkan Ujian
                    </button>

                    <a href="{{ route('murid.paket-soal') }}"
                       class="btn btn-light w-100 border text-muted"
                       style="font-size: 13px;"
                       onclick="return confirm('Progres pengerjaan telah tersimpan otomatis. Yakin ingin kembali ke daftar paket?')">
                        Kembali ke Menu
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL KONFIRMASI AKHIRI UJIAN (POP-UP TENGAH MODERN) -->
    <div class="modal fade" id="modalSelesaiUjian" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-confirm-content">
                <div class="modal-body text-center p-4">
                    
                    <div class="modal-icon-wrap">
                        <i class="bi bi-question-circle-fill"></i>
                    </div>

                    <h4 class="fw-bold text-dark mb-1">Akhiri Ujian Sekarang?</h4>
                    <p class="text-muted small mb-4">
                        Pastikan Anda telah memeriksa semua butir pertanyaan sebelum mengirimkan lembar ujian.
                    </p>

                    <!-- Ringkasan Jawaban Dalam Modal -->
                    <div class="p-3 bg-light rounded-3 mb-4 text-start">
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted">Total Butir Soal:</span>
                            <strong class="text-dark">{{ $soals->count() }} Soal</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted">Soal Sudah Dijawab:</span>
                            <strong class="text-success" id="modalAnsweredText">0 Soal</strong>
                        </div>
                        <div class="d-flex justify-content-between small">
                            <span class="text-muted">Soal Belum Terjawab:</span>
                            <strong class="text-danger" id="modalUnansweredText">0 Soal</strong>
                        </div>
                    </div>

                    <!-- Tombol Aksi Modal -->
                    <div class="row g-2">
                        <div class="col-6">
                            <button type="button" class="btn btn-light w-100 py-2 rounded-3 border fw-semibold" data-bs-dismiss="modal">
                                Batal
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-danger w-100 py-2 rounded-3 fw-bold" onclick="kirimUjian()">
                                Ya, Kumpulkan
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Kontrol & Ajax -->
    <script>
        const questions = document.querySelectorAll('.question-item');
        let currentQuestion = 0;
        const totalQuestions = questions.length;
        let confirmModalInstance = null;

        document.addEventListener('DOMContentLoaded', function () {
            const modalEl = document.getElementById('modalSelesaiUjian');
            if (modalEl) {
                confirmModalInstance = new bootstrap.Modal(modalEl);
            }
        });

        function showQuestion(index) {
            if (index < 0 || index >= totalQuestions) return;

            questions.forEach((q, i) => q.style.display = (i === index) ? 'block' : 'none');
            document.querySelectorAll('.btn-number').forEach((btn, i) => btn.classList.toggle('active', i === index));

            currentQuestion = index;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function nextQuestion() { showQuestion(currentQuestion + 1); }
        function previousQuestion() { showQuestion(currentQuestion - 1); }

        function pilihJawaban(soalId, jawaban, element) {
            fetch("{{ route('murid.kecerdasan.jawab', $hasil->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ soal_id: soalId, jawaban: jawaban })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    alert(data.message || 'Gagal menyimpan jawaban.');
                    return;
                }

                // Ganti tanda centang/selected
                const parent = element.parentElement;
                parent.querySelectorAll('.option-row').forEach(opt => opt.classList.remove('selected'));
                element.classList.add('selected');

                // Tandai nomor soal hijau
                const navButtons = document.querySelectorAll('.btn-number');
                navButtons[currentQuestion].classList.add('answered');

                updateAnsweredCount();
            })
            .catch(() => alert('Terjadi gangguan jaringan saat menyimpan jawaban.'));
        }

        function updateAnsweredCount() {
            const answered = document.querySelectorAll('.btn-number.answered').length;
            document.getElementById('answeredCount').textContent = answered;
            document.getElementById('unansweredCount').textContent = totalQuestions - answered;
        }

        // Timer Pengerjaan
        let remainingSeconds = {{ ((int) $paket->durasi) * 60 }};
        function updateTimer() {
            const minutes = Math.floor(remainingSeconds / 60);
            const seconds = remainingSeconds % 60;
            const timerEl = document.getElementById('timerText');
            const timerBox = document.getElementById('timerBox');

            timerEl.textContent = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');

            if (remainingSeconds <= 60) {
                timerBox.classList.add('warning');
            }

            if (remainingSeconds <= 0) {
                clearInterval(timerInterval);
                document.getElementById('examForm').submit();
                return;
            }
            remainingSeconds--;
        }

        updateTimer();
        const timerInterval = setInterval(updateTimer, 1000);

        // Buka Modal Pop-up Tengah
        function bukaModalKonfirmasi() {
            const answered = document.querySelectorAll('.btn-number.answered').length;
            const unanswered = totalQuestions - answered;

            document.getElementById('modalAnsweredText').textContent = answered + ' Soal';
            document.getElementById('modalUnansweredText').textContent = unanswered + ' Soal';

            if (confirmModalInstance) {
                confirmModalInstance.show();
            }
        }

        // Submit Lembar Ujian
        function kirimUjian() {
            document.getElementById('examForm').submit();
        }
    </script>
</body>

</html>