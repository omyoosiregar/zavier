<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $materi->judul }} - ZAVIER Secure Reader</title>

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- SweetAlert2 untuk Notifikasi Peringatan Screenshot -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- PDF.js Engine -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    </script>

    <style>
        /* ========================================================
           1. PENCEGAHAN PRINT / COPY / SELEKSI
           ======================================================== */
        @media print {
            * {
                visibility: hidden !important;
                background: #ffffff !important;
                color: #ffffff !important;
            }
            html, body {
                background: #ffffff !important;
                height: 100vh !important;
                overflow: hidden !important;
            }
        }

        * {
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            user-select: none !important;
            -webkit-touch-callout: none !important;
            box-sizing: border-box;
        }

        body {
            background-color: #f8fafc;
            color: #0f172a;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow-x: hidden;
            padding-bottom: 90px;
        }

        /* ========================================================
           2. TIRAI HITAM/PUTIH SAAT DETEKSI SCREENSHOT
           ======================================================== */
        #securityCurtain {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: #000000 !important;
            z-index: 2147483647;
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #ffffff;
            text-align: center;
            padding: 24px;
        }

        #securityCurtain i {
            font-size: 64px;
            color: #ef4444;
            margin-bottom: 16px;
        }

        body.is-captured #readerContainer {
            display: none !important;
        }

        /* ========================================================
           3. AREA BACA MATERI
           ======================================================== */
        .reader-wrapper {
            max-width: 860px;
            margin: 0 auto;
            padding: 12px 14px 20px 14px;
        }

        .reader-navbar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 12px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .document-stage-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 14px;
            min-height: 70vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            position: relative;
        }

        #pdfCanvas {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            display: block;
        }

        .protected-img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            pointer-events: none;
        }

        .protected-text-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            color: #1e293b;
            font-size: 15px;
            line-height: 1.85;
            width: 100%;
            min-height: 65vh;
            white-space: pre-wrap;
            font-family: 'Consolas', 'Courier New', monospace;
        }

        /* Floating Nav Bar Bawah (Mudah Pindah Halaman) */
        .bottom-sticky-nav {
            position: fixed;
            bottom: 14px;
            left: 50%;
            transform: translateX(-50%);
            background: #0f172a;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50px;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            z-index: 1000;
        }

        .bottom-sticky-nav button {
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
        }

        .bottom-sticky-nav .page-counter {
            color: #f8fafc;
            font-size: 13.5px;
            font-weight: 700;
            min-width: 85px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- 1. TIRAI PENGAMAN KETIKA DETEKSI SCREENSHOT / BLUR -->
    <div id="securityCurtain">
        <i class="bi bi-shield-fill-x"></i>
        <h4 class="fw-bold mb-2">AKSES DIKUNCI SEMENTARA</h4>
        <p class="text-secondary small mb-3" style="max-width: 440px; line-height: 1.6;">
            Aplikasi mendeteksi upaya penangkapan layar (screenshot) atau perekaman. 
            Materi ini adalah dokumen internal rahasia.
        </p>
        <button type="button" class="btn btn-outline-light rounded-pill px-4 fw-bold btn-sm shadow-sm" onclick="resumeView()">
            <i class="bi bi-unlock-fill me-1"></i> Buka Kunci Layar
        </button>
    </div>

    <!-- 2. KONTEN DOKUMEN -->
    <div class="reader-wrapper" id="readerContainer">
        <!-- Header -->
        <div class="reader-navbar">
            <div>
                <a href="{{ route('murid.pembahasan.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill mb-1" style="font-size: 11px;">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
                <h6 class="fw-bold text-dark mb-0 mt-1" style="font-size: 15px;">{{ $materi->judul }}</h6>
                <small class="text-secondary" style="font-size: 11px;">
                    Kategori: <strong class="text-primary">{{ $materi->kategori }}</strong>
                </small>
            </div>
            <div>
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill fw-bold" style="font-size: 10px;">
                    <i class="bi bi-shield-lock-fill me-1"></i> Mode Rahasia
                </span>
            </div>
        </div>

        <!-- Stage Materi -->
        <div class="document-stage-box">
            @php
                $ext = strtolower($materi->file_extension);
                $streamUrl = route('murid.pembahasan.stream',$materi->id);
            @endphp

            @if($ext === 'pdf')
                <div class="w-100 d-flex flex-column align-items-center">
                    <div id="pdfLoading" class="text-secondary small my-5 text-center">
                        <div class="spinner-border spinner-border-sm text-primary mb-2" role="status"></div>
                        <div>Memuat dokumen materi...</div>
                    </div>
                    <canvas id="pdfCanvas"></canvas>
                </div>

            @elseif(in_array($ext, ['png', 'jpg', 'jpeg', 'webp']))
                <div class="text-center w-100">
                    <img src="{{ $streamUrl }}" alt="{{ $materi->judul }}" class="protected-img" ondragstart="return false;">
                </div>

            @elseif($ext === 'txt')
                <div class="protected-text-box">
                    {{ $materi->konten_teks ?? (file_exists(storage_path('app/public/' . $materi->file_path)) ? file_get_contents(storage_path('app/public/' . $materi->file_path)) : 'Konten materi tidak dapat dimuat.') }}
                </div>

            @else
                <div class="text-center p-3">
                    <i class="bi bi-file-earmark-word text-primary" style="font-size: 48px;"></i>
                    <h6 class="fw-bold text-dark mt-2">{{ $materi->file_name }}</h6>
                    <iframe src="https://docs.google.com/viewer?url={{ urlencode(asset('storage/' . $materi->file_path)) }}&embedded=true" style="width:100%; height:70vh; border-radius:8px; border:none;"></iframe>
                </div>
            @endif
        </div>
    </div>

    {{-- FLOATING TOOLBAR BAWAH UNTUK PDF --}}
    @if($ext === 'pdf')
    <div class="bottom-sticky-nav" id="pdfBottomBar">
        <button id="prevBtn" type="button" title="Halaman Sebelumnya">
            <i class="bi bi-chevron-left"></i>
        </button>
        <span class="page-counter">
            Hal <span id="pageNum">1</span> / <span id="pageCount">-</span>
        </span>
        <button id="nextBtn" type="button" title="Halaman Berikutnya">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>
    @endif

    <script>
        const curtain = document.getElementById('securityCurtain');
        const reader = document.getElementById('readerContainer');
        const pdfBar = document.getElementById('pdfBottomBar');
        let hasWarned = false;

        // Fungsi Kunci Layar & Munculkan Notifikasi Peringatan
        function triggerLockdown(reasonText) {
            document.body.classList.add('is-captured');
            if (reader) reader.style.display = 'none';
            if (pdfBar) pdfBar.style.display = 'none';
            if (curtain) curtain.style.display = 'flex';

            // Bersihkan clipboard HP jika ada tangkapan yang sempat tercopy
            if (navigator.clipboard) {
                navigator.clipboard.writeText('');
            }

            // Munculkan dialog peringatan tegas SweetAlert
            if (!hasWarned) {
                hasWarned = true;
                Swal.fire({
                    icon: 'error',
                    title: 'PERINGATAN KEAMANAN!',
                    html: `
                        <div class="text-start small" style="line-height: 1.6;">
                            <p class="mb-2 text-danger fw-bold">Upaya tangkapan layar (screenshot) / perekaman terdeteksi!</p>
                            <p class="mb-2 text-muted">Materi pembahasan ini bersifat rahasia dan dilindungi hak cipta ZAVIER.</p>
                            <div class="p-2 bg-light rounded border text-secondary" style="font-size: 11.5px;">
                                <strong>Pencatatan Sistem:</strong><br>
                                Akun: <b>{{ auth()->user()->name }}</b> (ID: {{ auth()->user()->id }})<br>
                                Waktu: <b>${new Date().toLocaleTimeString()} WIB</b>
                            </div>
                        </div>
                    `,
                    confirmButtonText: 'Saya Mengerti',
                    confirmButtonColor: '#ef4444',
                    allowOutsideClick: false
                }).then(() => {
                    hasWarned = false;
                    resumeView();
                });
            }
        }

        function resumeView() {
            document.body.classList.remove('is-captured');
            if (curtain) curtain.style.display = 'none';
            if (reader) reader.style.display = 'block';
            if (pdfBar) pdfBar.style.display = 'flex';
        }

        // ========================================================
        // 1. SENSOR DETEKSI SCREENSHOT DI HP (ANDROID & IOS)
        // ========================================================

        // A. Gestur Multi-Jari (3 Jari Screenshot Bawaan Android Xiaomi/Oppo/Realme/Vivo)
        window.addEventListener('touchstart', function(e) {
            if (e.touches.length >= 2) {
                triggerLockdown('Gestur Multi-Jari Terdeteksi');
            }
        }, { passive: true });

        // B. Ketika Tombol Fisik Screenshot HP Ditekan (OS memicu event visibilitychange / blur)
        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'hidden') {
                triggerLockdown('Tangkapan Layar Sistem');
            }
        });

        window.addEventListener('blur', function() {
            triggerLockdown('Layar Kehilangan Fokus');
        });

        window.addEventListener('pagehide', function() {
            triggerLockdown('Aplikasi Berpindah');
        });

        // C. Blokir Tombol PrintScreen & DevTools di Komputer / Laptop
        window.addEventListener('keyup', function(e) {
            if (e.key === 'PrintScreen' || e.code === 'PrintScreen') {
                triggerLockdown('Tombol PrintScreen Ditekan');
            }
        });

        window.addEventListener('keydown', function(e) {
            if (
                e.key === 'F12' || 
                e.keyCode === 123 ||
                (e.ctrlKey && ['s', 'S', 'p', 'P', 'u', 'U'].includes(e.key)) ||
                (e.ctrlKey && e.shiftKey && ['i', 'I', 'j', 'J', 'c', 'C', 's', 'S'].includes(e.key)) ||
                (e.metaKey && e.shiftKey && ['3', '4', 's', 'S'].includes(e.key))
            ) {
                e.preventDefault();
                triggerLockdown('Shortcut DevTools / Print Terdeteksi');
                return false;
            }
        });

        // Blokir Klik Kanan & Drag File
        document.addEventListener('contextmenu', e => e.preventDefault());
        window.addEventListener('dragstart', e => e.preventDefault());

        // ========================================================
        // 2. ENGINE RENDER PDF.JS & NAVIGASI HALAMAN
        // ========================================================
        @if($ext === 'pdf')
            const url = "{{ $streamUrl }}";
            let pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = (window.innerWidth < 768) ? 1.05 : 1.35,
                canvas = document.getElementById('pdfCanvas'),
                ctx = canvas.getContext('2d');

            function renderPage(num) {
                pageRendering = true;
                pdfDoc.getPage(num).then(function(page) {
                    const viewport = page.getViewport({ scale: scale });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    const renderTask = page.render(renderContext);

                    renderTask.promise.then(function() {
                        pageRendering = false;
                        const loadingEl = document.getElementById('pdfLoading');
                        if (loadingEl) loadingEl.style.display = 'none';

                        if (pageNumPending !== null) {
                            renderPage(pageNumPending);
                            pageNumPending = null;
                        }
                    });
                });

                document.getElementById('pageNum').textContent = num;
            }

            function queueRenderPage(num) {
                if (pageRendering) {
                    pageNumPending = num;
                } else {
                    renderPage(num);
                }
            }

            document.getElementById('prevBtn').addEventListener('click', function(e) {
                e.preventDefault();
                if (pageNum <= 1) return;
                pageNum--;
                queueRenderPage(pageNum);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            document.getElementById('nextBtn').addEventListener('click', function(e) {
                e.preventDefault();
                if (!pdfDoc || pageNum >= pdfDoc.numPages) return;
                pageNum++;
                queueRenderPage(pageNum);
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
                pdfDoc = pdfDoc_;
                document.getElementById('pageCount').textContent = pdfDoc.numPages;
                renderPage(pageNum);
            }).catch(function(err) {
                const loadingEl = document.getElementById('pdfLoading');
                if (loadingEl) loadingEl.innerHTML = '<span class="text-danger">Gagal memuat dokumen materi.</span>';
            });
        @endif
    </script>
</body>
</html>