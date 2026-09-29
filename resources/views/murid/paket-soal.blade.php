@extends('layouts.murid')

@section('title', 'Paket Soal Ujian - ZAVIER Learning Center')

@section('content')
<style>
    .banner-hero {
        background: linear-gradient(135deg, #0d6efd 0%, #0099ff 55%, #00d2ff 100%);
        border-radius: 24px;
        padding: 40px;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .banner-hero::after {
        content: "";
        position: absolute;
        right: 20px;
        top: 20px;
        width: 140px;
        height: 140px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' opacity='0.15' viewBox='0 0 16 16'%3E%3Cpath d='M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.492-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.319-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z'/%3E%3C/svg%3E") no-repeat center center;
        background-size: contain;
    }

    /* Container 4 Tab Kategori */
    .tab-kategori-card {
        background: #ffffff;
        border: 2px solid #eef2f8;
        border-radius: 18px;
        padding: 18px;
        cursor: pointer;
        transition: all .25s ease;
        position: relative;
    }

    .tab-kategori-card:hover {
        border-color: #bfdbfe;
        transform: translateY(-2px);
    }

    .tab-kategori-card.active-tab {
        border-color: #2563eb;
        background: #ffffff;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.08);
    }

    .tab-kategori-card.active-tab::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 12px;
        right: 12px;
        height: 4px;
        background: #0084ff;
        border-radius: 10px 10px 0 0;
    }

    /* Card Paket Soal */
    .exam-card {
        background: #ffffff;
        border: 1px solid #eef2f8;
        border-radius: 22px;
        box-shadow: 0 4px 18px rgba(19, 42, 74, 0.04);
        padding: 26px;
        transition: transform .2s ease, box-shadow .2s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .exam-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 26px rgba(19, 42, 74, 0.08);
    }

    .icon-box-header {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin-bottom: 20px;
    }

    .icon-tab {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .badge-diff {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
    }
</style>

<div class="container-fluid py-2">

    <!-- Hero Banner -->
    <div class="banner-hero">
        <span class="badge bg-white text-primary fw-bold px-3 py-2 rounded-pill mb-3" style="font-size: 11px;">
            <i class="bi bi-mortarboard-fill me-1"></i> ZAVIER LEARNING CENTER
        </span>
        <h2 class="fw-bold mb-2">Paket Soal Ujian</h2>
        <p class="mb-0 text-white-50" style="max-width: 650px;">
            Pilih kategori latihan yang ingin kamu kerjakan. Tingkatkan kemampuan melalui latihan kecermatan, kecerdasan, kepribadian, dan materi lainnya.
        </p>
    </div>

    <!-- Pilihan 4 Kategori Tab (Posisi Tryout di Tab ke-4 / Samping Kecerdasan) -->
    <div class="row g-3 mb-4">

        <!-- 1. KECERMATAN -->
        <div class="col-lg-3 col-6">
            <div class="tab-kategori-card {{ request('tab', 'kecermatan') == 'kecermatan' ? 'active-tab' : '' }}" onclick="switchTab('kecermatan')" id="tab-btn-kecermatan">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-tab bg-primary-subtle text-primary">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Kecermatan</div>
                        <small class="text-muted">{{ isset($paketsKecermatan) ? $paketsKecermatan->count() : 0 }} paket</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. KEPRIBADIAN -->
        <div class="col-lg-3 col-6">
            <div class="tab-kategori-card {{ request('tab') == 'kepribadian' ? 'active-tab' : '' }}" onclick="switchTab('kepribadian')" id="tab-btn-kepribadian">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-tab bg-light text-secondary">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Kepribadian</div>
                        <small class="text-muted">{{ isset($paketsKepribadian) ? $paketsKepribadian->count() : 0 }} paket</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. KECERDASAN -->
        <div class="col-lg-3 col-6">
            <div class="tab-kategori-card {{ request('tab') == 'kecerdasan' ? 'active-tab' : '' }}" onclick="switchTab('kecerdasan')" id="tab-btn-kecerdasan">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-tab bg-light text-secondary">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Kecerdasan</div>
                        <small class="text-muted">{{ isset($paketsKecerdasan) ? $paketsKecerdasan->count() : 0 }} paket</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. TRYOUT PSIKOLOGI (DI SAMPING KECERDASAN) -->
        <div class="col-lg-3 col-6">
            <div class="tab-kategori-card {{ request('tab') == 'tryout' ? 'active-tab' : '' }}" onclick="switchTab('tryout')" id="tab-btn-tryout">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-tab bg-warning-subtle text-warning">
                        <i class="bi bi-award-fill"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Tryout Psikologi</div>
                        <small class="text-muted">{{ isset($paketTryout) ? $paketTryout->count() : 0 }} paket</small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Alert Notifikasi -->
    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">
            <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif


    <!-- =========================================================
         KONTEN TAB 1: KECERMATAN
    ========================================================== -->
    <div id="content-kecermatan" class="tab-content-panel" style="display: {{ request('tab', 'kecermatan') == 'kecermatan' ? 'block' : 'none' }};">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="p-2 rounded-circle bg-primary-subtle text-primary fs-5">
                    <i class="bi bi-bullseye"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Kecermatan</h5>
                    <small class="text-muted">Latihan untuk meningkatkan kecepatan dan ketelitian dalam mengerjakan soal.</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-primary-subtle text-primary border rounded-pill px-3 py-2 fw-semibold">
                    <i class="bi bi-folder-fill me-1"></i> {{ isset($paketsKecermatan) ? $paketsKecermatan->count() : 0 }} Paket
                </span>
                <div class="position-relative" style="width: 250px;">
                    <input type="text" class="form-control rounded-pill ps-4 py-2 small" placeholder="Cari paket soal..." onkeyup="filterPaket(this.value, 'content-kecermatan')">
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse($paketsKecermatan as $p)
                <div class="col-lg-4 col-md-6 paket-item-card">
                    <div class="exam-card">
                        <div>
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="icon-box-header bg-primary text-white shadow-sm">
                                    <i class="bi bi-bullseye"></i>
                                </div>
                                <span class="badge badge-diff bg-primary-subtle text-primary">Sulit</span>
                            </div>
                            <h5 class="fw-bold text-dark mb-2 paket-title">{{ $p->nama_paket }}</h5>
                            <p class="text-muted small mb-4">Paket latihan kecermatan untuk menguji ketelitian simbol, angka, dan respon visual.</p>
                        </div>
                        <a href="{{ route('murid.ujian', $p->id) }}" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">
                            Mulai Latihan
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5 bg-white rounded-4 border">
                        <i class="bi bi-folder-x text-muted" style="font-size: 40px;"></i>
                        <p class="text-muted small mt-2 mb-0">Belum ada paket kecermatan yang tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>


    <!-- =========================================================
         KONTEN TAB 2: KEPRIBADIAN
    ========================================================== -->
    <div id="content-kepribadian" class="tab-content-panel" style="display: {{ request('tab') == 'kepribadian' ? 'block' : 'none' }};">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="p-2 rounded-circle bg-success-subtle text-success fs-5">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Kepribadian</h5>
                    <small class="text-muted">Evaluasi aspek psikologis, stabilitas emosi, kepemimpinan, dan integritas diri.</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-success-subtle text-success border rounded-pill px-3 py-2 fw-semibold">
                    <i class="bi bi-folder-fill me-1"></i> {{ isset($paketsKepribadian) ? $paketsKepribadian->count() : 0 }} Paket
                </span>
                <div class="position-relative" style="width: 250px;">
                    <input type="text" class="form-control rounded-pill ps-4 py-2 small" placeholder="Cari paket soal..." onkeyup="filterPaket(this.value, 'content-kepribadian')">
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse($paketsKepribadian as $pp)
                @php
                    $namaBank = $pp->nama_bank ?? $pp->nama_paket ?? $pp->judul ?? ('Paket Kepribadian #' . $pp->id);
                @endphp
                <div class="col-lg-4 col-md-6 paket-item-card">
                    <div class="exam-card">
                        <div>
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="icon-box-header bg-success text-white shadow-sm">
                                    <i class="bi bi-person-heart"></i>
                                </div>
                                <span class="badge badge-diff bg-success-subtle text-success">Sikap</span>
                            </div>
                            <h5 class="fw-bold text-dark mb-2 paket-title">{{ $namaBank }}</h5>
                            <p class="text-muted small mb-4">Kuesioner sikap dan integritas. Jawab jujur sesuai prinsip pribadi Anda.</p>
                        </div>
                        <a href="{{ route('murid.kepribadian.mulai', $pp->id) }}" class="btn btn-success w-100 rounded-pill py-2 fw-bold text-white">
                            Mulai Latihan
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5 bg-white rounded-4 border">
                        <i class="bi bi-folder-x text-muted" style="font-size: 40px;"></i>
                        <p class="text-muted small mt-2 mb-0">Belum ada paket kepribadian yang tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>


    <!-- =========================================================
         KONTEN TAB 3: KECERDASAN
    ========================================================== -->
    <div id="content-kecerdasan" class="tab-content-panel" style="display: {{ request('tab') == 'kecerdasan' ? 'block' : 'none' }};">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="p-2 rounded-circle bg-primary-subtle text-primary fs-5">
                    <i class="bi bi-lightbulb-fill"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Kecerdasan</h5>
                    <small class="text-muted">Latihan kemampuan berpikir, logika, numerik, verbal, dan penalaran.</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-primary-subtle text-primary border rounded-pill px-3 py-2 fw-semibold">
                    <i class="bi bi-folder-fill me-1"></i> {{ isset($paketsKecerdasan) ? $paketsKecerdasan->count() : 0 }} Paket
                </span>
                <div class="position-relative" style="width: 250px;">
                    <input type="text" class="form-control rounded-pill ps-4 py-2 small" placeholder="Cari paket soal..." onkeyup="filterPaket(this.value, 'content-kecerdasan')">
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse($paketsKecerdasan as $pk)
                <div class="col-lg-4 col-md-6 paket-item-card">
                    <div class="exam-card">
                        <div>
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="icon-box-header bg-primary text-white shadow-sm">
                                    <i class="bi bi-lightbulb"></i>
                                </div>
                                <span class="badge badge-diff bg-primary-subtle text-primary">Sulit</span>
                            </div>
                            <h5 class="fw-bold text-dark mb-2 paket-title">{{ $pk->nama_paket }}</h5>
                            <p class="text-muted small mb-4">Paket latihan ZAVIER Learning Center untuk meningkatkan daya nalar dan intelegensi.</p>
                        </div>
                        <a href="{{ route('murid.kecerdasan.mulai', $pk->id) }}" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">
                            Mulai Latihan
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5 bg-white rounded-4 border">
                        <i class="bi bi-folder-x text-muted" style="font-size: 40px;"></i>
                        <p class="text-muted small mt-2 mb-0">Belum ada paket kecerdasan yang tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>


    <!-- =========================================================
         KONTEN TAB 4: TRYOUT PSIKOLOGI (TERPADU POLRI)
    ========================================================== -->
    <div id="content-tryout" class="tab-content-panel" style="display: {{ request('tab') == 'tryout' ? 'block' : 'none' }};">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="p-2 rounded-circle bg-warning-subtle text-warning fs-5">
                    <i class="bi bi-award-fill"></i>
                </div>
                <div>
                    <h5 class="fw-bold text-dark mb-0">Tryout Psikologi POLRI (Full CAT)</h5>
                    <small class="text-muted">Simulasi terpadu berurutan: Kecerdasan &rarr; Jeda 5 Menit &rarr; Kepribadian &rarr; Jeda 5 Menit &rarr; Kecermatan.</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-warning-subtle text-dark border rounded-pill px-3 py-2 fw-semibold">
                    <i class="bi bi-folder-fill me-1 text-warning"></i> {{ isset($paketTryout) ? $paketTryout->count() : 0 }} Paket
                </span>
                <div class="position-relative" style="width: 250px;">
                    <input type="text" class="form-control rounded-pill ps-4 py-2 small" placeholder="Cari tryout..." onkeyup="filterPaket(this.value, 'content-tryout')">
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse($paketTryout as $t)
                <div class="col-lg-4 col-md-6 paket-item-card">
                    <div class="exam-card border-warning-subtle">
                        <div>
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="icon-box-header bg-warning text-dark shadow-sm">
                                    <i class="bi bi-award-fill"></i>
                                </div>
                                <span class="badge badge-diff bg-warning-subtle text-dark">Resmi POLRI</span>
                            </div>

                            <h5 class="fw-bold text-dark mb-2 paket-title">{{ $t->judul_tryout }}</h5>
                            <p class="text-muted small mb-3">
                                {{ $t->deskripsi ?: 'Simulasi gabungan 3 subtes psikologi lengkap dengan akumulasi skor akhir dan status kelulusan MS / TMS.' }}
                            </p>

                            <!-- Rangkaian 3 Subtes -->
                            <div class="p-3 bg-light rounded-3 mb-4 border">
                                <div class="small fw-bold text-dark mb-2">Rangkaian Alur Ujian:</div>
                                <div class="small text-muted mb-1"><i class="bi bi-1-circle-fill text-primary me-1"></i> Kecerdasan: <strong>{{ optional($t->paketKecerdasan)->nama_paket ?? 'Subtes 1' }}</strong></div>
                                <div class="small text-muted mb-1"><i class="bi bi-2-circle-fill text-success me-1"></i> Kepribadian: <strong>Subtes 2</strong></div>
                                <div class="small text-muted"><i class="bi bi-3-circle-fill text-info me-1"></i> Kecermatan: <strong>{{ optional($t->paketKecermatan)->nama_paket ?? 'Subtes 3' }}</strong></div>
                            </div>
                        </div>

                        <!-- Tombol Mulai Tryout CAT -->
                        <a href="{{ route('murid.tryout.mulai', $t->id) }}" class="btn btn-warning w-100 rounded-pill py-2 fw-bold text-dark shadow-sm">
                            <i class="bi bi-play-circle-fill me-1"></i> Mulai Tryout CAT
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5 bg-white rounded-4 border">
                        <i class="bi bi-award text-muted" style="font-size: 40px;"></i>
                        <h6 class="fw-bold text-dark mt-3">Belum Ada Paket Tryout Aktif</h6>
                        <p class="text-muted small mb-0">Paket tryout psikologi akan segera dirilis oleh Super Admin ZAVIER.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</div>

<!-- JAVASCRIPT GANTI TAB & PENCARIAN -->
<script>
    function switchTab(tabKey) {
        // Sembunyikan semua panel
        document.querySelectorAll('.tab-content-panel').forEach(panel => {
            panel.style.display = 'none';
        });

        // Hapus class active-tab dari tombol tab
        document.querySelectorAll('.tab-kategori-card').forEach(card => {
            card.classList.remove('active-tab');
        });

        // Tampilkan panel target
        const targetContent = document.getElementById('content-' + tabKey);
        const targetBtn = document.getElementById('tab-btn-' + tabKey);

        if (targetContent) targetContent.style.display = 'block';
        if (targetBtn) targetBtn.classList.add('active-tab');

        // Update URL tanpa reload
        const url = new URL(window.location);
        url.searchParams.set('tab', tabKey);
        window.history.replaceState({}, '', url);
    }

    function filterPaket(keyword, containerId) {
        keyword = keyword.toLowerCase();
        const container = document.getElementById(containerId);
        const cards = container.querySelectorAll('.paket-item-card');

        cards.forEach(card => {
            const title = card.querySelector('.paket-title').innerText.toLowerCase();
            if (title.includes(keyword)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endsection