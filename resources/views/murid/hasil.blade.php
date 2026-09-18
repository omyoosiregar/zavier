<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Hasil Ujian - ZAVIER Learning Center
    </title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>

        /* =====================================================
           GLOBAL
        ===================================================== */

        body {
            background: #f5f8fc;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #1d2939;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .navbar {
            background: rgba(255,255,255,.97);
            box-shadow: 0 3px 18px rgba(0,0,0,.06);
            padding: 10px 0;
            z-index: 1000;
        }


        /* =====================================================
           BRAND ZAVIER
        ===================================================== */

        .brand {
            font-weight: 800;
            color: #1769aa;
            letter-spacing: .4px;
            text-decoration: none;

            display: flex;
            align-items: center;

            gap: 10px;
        }

        .brand:hover {
            color: #0d6efd;
        }

        .brand-logo {
            width: 48px;
            height: 48px;

            object-fit: contain;

            display: block;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .brand-name {
            font-size: 20px;
            font-weight: 900;
            letter-spacing: 1px;
            color: #1558a6;
        }

        .brand-subtitle {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #7b8ca5;
            margin-top: 5px;
        }


        /* =====================================================
           NAVIGATION
        ===================================================== */

        .nav-link {
            font-weight: 600;
            color: #555;
            margin: 0 3px;
            border-radius: 10px;
            padding: 10px 15px !important;
            transition: .2s ease;
        }

        .nav-link:hover {
            color: #1769aa;
            background: #eaf5ff;
        }

        .nav-link.active {
            color: #1769aa;
            background: #eaf5ff;
        }

        .nav-link.disabled {
            color: #adb5bd;
            cursor: not-allowed;
            background: transparent;
        }


        /* =====================================================
           PROFILE
        ===================================================== */

        .profile-link {
            border-radius: 12px;
            padding: 5px 8px;
            transition: .2s ease;
        }

        .profile-link:hover {
            background: #f1f5f9;
        }

        .profile-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #0dcaf0
                );

            color: white;

            display: flex;
            justify-content: center;
            align-items: center;

            font-weight: 800;

            box-shadow:
                0 4px 12px
                rgba(13,110,253,.20);
        }

        .dropdown-menu {
            border: none;
            border-radius: 14px;
            padding: 8px;

            box-shadow:
                0 12px 35px
                rgba(0,0,0,.10);
        }

        .dropdown-item {
            border-radius: 9px;
            padding: 10px 12px;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: #eef7ff;
        }


        /* =====================================================
           HERO RESULT
        ===================================================== */

        .result-hero {

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #0dcaf0
                );

            color: white;

            border-radius: 24px;

            padding: 35px;

            margin-top: 30px;
            margin-bottom: 30px;

            box-shadow:
                0 12px 30px
                rgba(13,110,253,.18);

            position: relative;
            overflow: hidden;
        }

        .result-hero::before {

            content: "";

            position: absolute;

            width: 260px;
            height: 260px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.08);

            right: -80px;
            top: -120px;
        }

        .result-hero::after {

            content: "";

            position: absolute;

            width: 150px;
            height: 150px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.06);

            left: -60px;
            bottom: -80px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;

            background: rgba(255,255,255,.18);

            border: 1px solid rgba(255,255,255,.20);

            padding: 7px 13px;

            border-radius: 30px;

            font-size: 12px;
            font-weight: 700;

            margin-bottom: 12px;
        }

        .result-hero h1 {
            font-size: 32px;
            font-weight: 800;
        }

        .result-hero p {
            opacity: .90;
        }


        /* =====================================================
           SCORE CIRCLE
        ===================================================== */

        .score-circle {

            width: 155px;
            height: 155px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.15);

            border:
                8px solid
                rgba(255,255,255,.35);

            display: flex;
            flex-direction: column;

            justify-content: center;
            align-items: center;

            margin: auto;

            box-shadow:
                0 10px 30px
                rgba(0,0,0,.12);
        }

        .score-number {
            font-size: 42px;
            font-weight: 900;
            line-height: 1;
        }

        .score-label {
            font-size: 12px;
            opacity: .9;
            margin-top: 6px;
        }

        .score-category {
            display: inline-block;

            margin-top: 10px;

            padding: 6px 13px;

            border-radius: 20px;

            background: rgba(255,255,255,.18);

            font-size: 12px;

            font-weight: 700;
        }


        /* =====================================================
           INFO HERO
        ===================================================== */

        .hero-info {

            display: flex;

            align-items: center;

            gap: 9px;

            margin-bottom: 9px;

            font-size: 14px;

            opacity: .92;
        }

        .hero-info i {
            width: 20px;
        }


        /* =====================================================
           CARD
        ===================================================== */

        .result-card {

            background: white;

            border: none;

            border-radius: 20px;

            box-shadow:
                0 7px 25px
                rgba(0,0,0,.06);

            margin-bottom: 25px;

            overflow: hidden;
        }

        .result-card-header {

            padding: 20px 24px;

            border-bottom:
                1px solid #edf1f5;

            display: flex;

            align-items: center;

            justify-content: space-between;
        }

        .result-card-header h5 {

            margin: 0;

            font-weight: 800;

            color: #1d2939;
        }

        .result-card-body {
            padding: 24px;
        }


        /* =====================================================
           STAT CARD
        ===================================================== */

        .stat-box {

            background:
                linear-gradient(
                    135deg,
                    #f8fbff,
                    #ffffff
                );

            border:
                1px solid #edf3f9;

            border-radius: 16px;

            padding: 20px;

            height: 100%;

            transition: .2s ease;
        }

        .stat-box:hover {

            transform: translateY(-3px);

            box-shadow:
                0 10px 25px
                rgba(0,0,0,.06);
        }

        .stat-icon {

            width: 45px;
            height: 45px;

            border-radius: 13px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #eaf5ff;

            color: #0d6efd;

            font-size: 20px;

            margin-bottom: 12px;
        }

        .stat-value {

            font-size: 26px;

            font-weight: 900;

            color: #1d2939;
        }

        .stat-label {

            color: #667085;

            font-size: 13px;

            margin-top: 3px;
        }


        /* =====================================================
           PERFORMANCE
        ===================================================== */

        .performance-item {

            border:
                1px solid #edf1f5;

            border-radius: 15px;

            padding: 17px;

            margin-bottom: 12px;

            transition: .2s ease;
        }

        .performance-item:hover {

            border-color: #cfe5ff;

            background: #fbfdff;
        }

        .column-title {

            font-weight: 800;

            color: #1d2939;
        }

        .progress {

            height: 8px;

            border-radius: 20px;

            background: #edf1f5;
        }

        .progress-bar {

            border-radius: 20px;

            background:
                linear-gradient(
                    90deg,
                    #0d6efd,
                    #0dcaf0
                );
        }


        /* =====================================================
           BADGES
        ===================================================== */

        .badge-soft-success {

            background: #eaf8ef;

            color: #198754;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 700;
        }

        .badge-soft-danger {

            background: #fff0f0;

            color: #dc3545;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 700;
        }

        .badge-soft-secondary {

            background: #f1f3f5;

            color: #6c757d;

            padding: 6px 10px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 700;
        }


        /* =====================================================
           CHART
        ===================================================== */

        .chart-container {

            position: relative;

            height: 350px;

            width: 100%;
        }


        /* =====================================================
           SUMMARY
        ===================================================== */

        .summary-box {

            background:
                linear-gradient(
                    135deg,
                    #f5faff,
                    #ffffff
                );

            border:

                1px solid #e3f0ff;

            border-radius: 17px;

            padding: 22px;
        }

        .summary-title {

            font-weight: 800;

            color: #1558a6;

            margin-bottom: 8px;
        }

        .summary-text {

            color: #667085;

            line-height: 1.7;

            margin-bottom: 0;
        }


        /* =====================================================
           COMPARISON
        ===================================================== */

        .comparison-item {

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 14px 0;

            border-bottom:
                1px solid #edf1f5;
        }

        .comparison-item:last-child {
            border-bottom: none;
        }

        .comparison-label {

            color: #667085;

            font-size: 14px;
        }

        .comparison-value {

            font-weight: 800;

            color: #1d2939;
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .btn-main {

            border: none;

            border-radius: 12px;

            padding: 12px 20px;

            font-weight: 700;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #0b8df0
                );

            box-shadow:
                0 5px 14px
                rgba(13,110,253,.15);

            transition: .2s ease;
        }

        .btn-main:hover {

            transform: translateY(-2px);

            box-shadow:
                0 8px 18px
                rgba(13,110,253,.22);
        }


        /* =====================================================
           BACK BUTTON
        ===================================================== */

        .btn-back {

            border-radius: 12px;

            padding: 10px 17px;

            font-weight: 600;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        footer {

            color: #98a2b3;

            font-size: 13px;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 991px) {

            .navbar-nav {
                margin-top: 10px;
            }

            .nav-link {
                margin-bottom: 4px;
            }

            .profile-link {
                margin-top: 10px;
            }

        }


        @media (max-width: 767px) {

            .result-hero {

                padding: 25px;

                border-radius: 20px;
            }

            .result-hero h1 {

                font-size: 25px;
            }

            .score-circle {

                width: 135px;
                height: 135px;

                margin-top: 25px;
            }

            .score-number {

                font-size: 35px;
            }

            .result-card-body {

                padding: 18px;
            }

            .chart-container {

                height: 300px;
            }

            .brand-logo {

                width: 42px;
                height: 42px;
            }

            .brand-name {

                font-size: 18px;
            }

            .brand-subtitle {

                font-size: 8px;
            }

        }

    </style>

</head>


<body>


<!-- =========================================================
     NAVBAR
========================================================= -->

@include('layouts.navbar-murid')

<!-- =========================================================
     CONTENT
========================================================= -->

<div class="container pb-5">


    <!-- =====================================================
         HERO HASIL
    ====================================================== -->

    <div class="result-hero">

        <div class="hero-content">

            <div class="row align-items-center">


                <!-- INFORMASI HASIL -->

                <div class="col-lg-8">

                    <span class="hero-badge">

                        <i class="bi bi-patch-check-fill me-2"></i>

                        HASIL UJIAN

                    </span>


                    <h1 class="mb-2">

                        Ujian Selesai!

                    </h1>


                    <p class="mb-4">

                        Selamat, Anda telah menyelesaikan
                        ujian dengan baik.

                    </p>


                    <!-- NAMA PAKET -->

                    <div class="hero-info">

                        <i class="bi bi-journal-text"></i>

                        <span>

                            {{ $hasil->paketSoal->nama_paket ?? 'Paket Ujian' }}

                        </span>

                    </div>


                    <!-- TANGGAL -->

                    <div class="hero-info">

                        <i class="bi bi-calendar3"></i>

                        <span>

                            {{ $hasil->selesai_pada
                                ? $hasil->selesai_pada->format('d F Y')
                                : '-' }}

                        </span>

                    </div>


                    <!-- WAKTU -->

                    <div class="hero-info">

                        <i class="bi bi-clock"></i>

                        <span>

                            Selesai pukul

                            {{ $hasil->selesai_pada
                                ? $hasil->selesai_pada->format('H:i')
                                : '-' }}

                        </span>

                    </div>


                    <!-- JENIS TES -->

                    <div class="hero-info">

                        <i class="bi bi-mortarboard-fill"></i>

                        <span>

                            Tes

                            {{ $hasil->paketSoal->jenis_tes ?? 'Kecermatan' }}

                        </span>

                    </div>

                </div>


                <!-- SCORE -->

                <div class="col-lg-4 text-center">

                    <div class="score-circle">

                        <div class="score-number">

                            {{ number_format($hasil->nilai ?? 0, 0) }}

                        </div>

                        <div class="score-label">

                            NILAI AKHIR

                        </div>

                    </div>


                    <div class="score-category">

                        {{ $hasil->kategori ?? 'Belum Dikategorikan' }}

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         STATISTIK UTAMA
    ====================================================== -->

    <div class="row g-4 mb-4">


        <!-- TOTAL SOAL -->

        <div class="col-6 col-lg-3">

            <div class="stat-box">

                <div class="stat-icon">

                    <i class="bi bi-list-ol"></i>

                </div>

                <div class="stat-value">

                    {{ $totalSoal }}

                </div>

                <div class="stat-label">

                    Total Soal

                </div>

            </div>

        </div>


        <!-- DIJAWAB -->

        <div class="col-6 col-lg-3">

            <div class="stat-box">

                <div class="stat-icon">

                    <i class="bi bi-pencil-square"></i>

                </div>

                <div class="stat-value">

                    {{ $totalDijawab }}

                </div>

                <div class="stat-label">

                    Soal Dijawab

                </div>

            </div>

        </div>


        <!-- BENAR -->

        <div class="col-6 col-lg-3">

            <div class="stat-box">

                <div class="stat-icon">

                    <i class="bi bi-check-circle-fill"></i>

                </div>

                <div class="stat-value text-success">

                    {{ $totalBenar }}

                </div>

                <div class="stat-label">

                    Jawaban Benar

                </div>

            </div>

        </div>


        <!-- SALAH -->

        <div class="col-6 col-lg-3">

            <div class="stat-box">

                <div class="stat-icon">

                    <i class="bi bi-x-circle-fill"></i>

                </div>

                <div class="stat-value text-danger">

                    {{ $totalSalah }}

                </div>

                <div class="stat-label">

                    Jawaban Salah

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         GRAFIK
    ====================================================== -->

    <div class="result-card">

        <div class="result-card-header">

            <div>

                <h5>

                    <i class="bi bi-bar-chart-fill text-primary me-2"></i>

                    Statistik Jawaban

                </h5>

                <small class="text-muted">

                    Perbandingan jawaban setiap kolom ujian

                </small>

            </div>

        </div>


        <div class="result-card-body">

            <div class="chart-container">

                <canvas id="hasilChart"></canvas>

            </div>

        </div>

    </div>


    <!-- =====================================================
         PERFORMA PER KOLOM
    ====================================================== -->

    <div class="result-card">

        <div class="result-card-header">

            <div>

                <h5>

                    <i class="bi bi-grid-3x3-gap-fill text-primary me-2"></i>

                    Performa Per Kolom

                </h5>

                <small class="text-muted">

                    Detail hasil pengerjaan setiap kolom

                </small>

            </div>

        </div>


        <div class="result-card-body">


            @forelse($statistikKolom as $nomor => $statistik)

                <div class="performance-item">


                    <!-- HEADER -->

                    <div
                        class="d-flex justify-content-between align-items-center mb-3"
                    >

                        <div>

                            <div class="column-title">

                                Kolom {{ $nomor }}

                            </div>

                            <small class="text-muted">

                                {{ $statistik['dijawab'] }}

                                dari

                                {{ $statistik['total_soal'] }}

                                soal dijawab

                            </small>

                        </div>


                        <div class="text-end">

                            <div
                                class="fw-bold text-primary fs-5"
                            >

                                {{ number_format($statistik['nilai'], 0) }}

                            </div>

                            <small class="text-muted">

                                Nilai

                            </small>

                        </div>

                    </div>


                    <!-- PROGRESS -->

                    <div class="progress mb-3">

                        <div
                            class="progress-bar"
                            role="progressbar"
                            style="width: {{ min(100, max(0, $statistik['nilai'])) }}%;"
                        ></div>

                    </div>


                    <!-- DETAIL -->

                    <div class="row g-2">


                        <!-- BENAR -->

                        <div class="col-4">

                            <div class="text-center">

                                <span class="badge-soft-success">

                                    <i class="bi bi-check-lg me-1"></i>

                                    {{ $statistik['benar'] }}

                                </span>

                                <div
                                    class="small text-muted mt-1"
                                >

                                    Benar

                                </div>

                            </div>

                        </div>


                        <!-- SALAH -->

                        <div class="col-4">

                            <div class="text-center">

                                <span class="badge-soft-danger">

                                    <i class="bi bi-x-lg me-1"></i>

                                    {{ $statistik['salah'] }}

                                </span>

                                <div
                                    class="small text-muted mt-1"
                                >

                                    Salah

                                </div>

                            </div>

                        </div>


                        <!-- TIDAK DIJAWAB -->

                        <div class="col-4">

                            <div class="text-center">

                                <span class="badge-soft-secondary">

                                    <i class="bi bi-dash-lg me-1"></i>

                                    {{ $statistik['tidak_dijawab'] }}

                                </span>

                                <div
                                    class="small text-muted mt-1"
                                >

                                    Tidak Dijawab

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-5">

                    <i
                        class="bi bi-inbox text-muted"
                        style="font-size: 50px;"
                    ></i>

                    <p class="text-muted mt-3 mb-0">

                        Data statistik kolom belum tersedia.

                    </p>

                </div>

            @endforelse

        </div>

    </div>


    <!-- =====================================================
         ANALISIS PERFORMA
    ====================================================== -->

    <div class="result-card">

        <div class="result-card-header">

            <div>

                <h5>

                    <i class="bi bi-lightbulb-fill text-warning me-2"></i>

                    Analisis Performa

                </h5>

                <small class="text-muted">

                    Evaluasi hasil ujian Anda

                </small>

            </div>

        </div>


        <div class="result-card-body">

            <div class="summary-box">

                <div class="summary-title">

                    <i class="bi bi-stars me-1"></i>

                    {{ $hasil->kategori ?? 'Hasil Ujian' }}

                </div>

                <p class="summary-text">

                    {{ $hasil->keterangan
                        ?? 'Terus tingkatkan kemampuan dan lakukan latihan secara rutin.' }}

                </p>

            </div>

        </div>

    </div>


    <!-- =====================================================
         RINGKASAN HASIL
    ====================================================== -->

    <div class="row g-4 mb-4">


        <!-- RINGKASAN -->

        <div class="col-lg-6">

            <div class="result-card h-100 mb-0">

                <div class="result-card-header">

                    <h5>

                        <i class="bi bi-clipboard-data-fill text-primary me-2"></i>

                        Ringkasan

                    </h5>

                </div>


                <div class="result-card-body">


                    <div class="comparison-item">

                        <span class="comparison-label">

                            Total Soal

                        </span>

                        <span class="comparison-value">

                            {{ $totalSoal }}

                        </span>

                    </div>


                    <div class="comparison-item">

                        <span class="comparison-label">

                            Soal Dijawab

                        </span>

                        <span class="comparison-value">

                            {{ $totalDijawab }}

                        </span>

                    </div>


                    <div class="comparison-item">

                        <span class="comparison-label">

                            Tidak Dijawab

                        </span>

                        <span class="comparison-value">

                            {{ $totalTidakDijawab }}

                        </span>

                    </div>


                    <div class="comparison-item">

                        <span class="comparison-label">

                            Jawaban Benar

                        </span>

                        <span class="comparison-value text-success">

                            {{ $totalBenar }}

                        </span>

                    </div>


                    <div class="comparison-item">

                        <span class="comparison-label">

                            Jawaban Salah

                        </span>

                        <span class="comparison-value text-danger">

                            {{ $totalSalah }}

                        </span>

                    </div>


                    <div class="comparison-item">

                        <span class="comparison-label">

                            Nilai Akhir

                        </span>

                        <span class="comparison-value text-primary">

                            {{ number_format($hasil->nilai ?? 0, 2) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        <!-- INFORMASI UJIAN -->

        <div class="col-lg-6">

            <div class="result-card h-100 mb-0">

                <div class="result-card-header">

                    <h5>

                        <i class="bi bi-info-circle-fill text-primary me-2"></i>

                        Informasi Ujian

                    </h5>

                </div>


                <div class="result-card-body">


                    <div class="comparison-item">

                        <span class="comparison-label">

                            Paket Soal

                        </span>

                        <span
                            class="comparison-value text-end"
                            style="max-width: 60%;"
                        >

                            {{ $hasil->paketSoal->nama_paket ?? '-' }}

                        </span>

                    </div>


                    <div class="comparison-item">

                        <span class="comparison-label">

                            Jenis Tes

                        </span>

                        <span class="comparison-value">

                            {{ $hasil->paketSoal->jenis_tes ?? '-' }}

                        </span>

                    </div>


                    <div class="comparison-item">

                        <span class="comparison-label">

                            Tingkat

                        </span>

                        <span class="comparison-value">

                            {{ $hasil->paketSoal->tingkat ?? '-' }}

                        </span>

                    </div>


                    <div class="comparison-item">

                        <span class="comparison-label">

                            Mulai

                        </span>

                        <span class="comparison-value">

                            {{ $hasil->mulai_pada
                                ? $hasil->mulai_pada->format('H:i')
                                : '-' }}

                        </span>

                    </div>


                    <div class="comparison-item">

                        <span class="comparison-label">

                            Selesai

                        </span>

                        <span class="comparison-value">

                            {{ $hasil->selesai_pada
                                ? $hasil->selesai_pada->format('H:i')
                                : '-' }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         TOMBOL AKSI
    ====================================================== -->

    <div class="result-card">

        <div class="result-card-body">

            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3"
            >


                <!-- KEMBALI -->

                <a
                    href="{{ route('murid.riwayat') }}"
                    class="btn btn-outline-primary btn-back"
                >

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali ke Riwayat

                </a>


                <!-- AKSI -->

                <div
                    class="d-flex flex-column flex-sm-row gap-2 w-100 w-md-auto"
                >


                    <!-- PAKET SOAL -->

                    <a
                        href="{{ route('murid.paket-soal') }}"
                        class="btn btn-outline-secondary btn-back"
                    >

                        <i class="bi bi-journal-text me-1"></i>

                        Paket Soal

                    </a>


                    <!-- COBA LAGI -->

                    <a
                        href="{{ route('murid.ujian', $hasil->paket_soal_id) }}"
                        class="btn btn-primary btn-main"
                    >

                        <i class="bi bi-arrow-repeat me-1"></i>

                        Coba Lagi

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     FOOTER
========================================================= -->

<footer class="text-center py-4">

    ZAVIER Learning Center

    &copy;

    {{ date('Y') }}

</footer>


<!-- =========================================================
     CHART
========================================================= -->

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {


            const canvas =
                document.getElementById('hasilChart');


            if (!canvas) {
                return;
            }


            /*
             * DATA LANGSUNG DARI CONTROLLER
             *
             * grafikLabel
             * grafikBenar
             * grafikSalah
             */

            const labels =
                @json($grafikLabel ?? []);


            const benar =
                @json($grafikBenar ?? []);


            const salah =
                @json($grafikSalah ?? []);


            /*
             * SELURUH JAWABAN
             *
             * Benar + Salah
             */

            const dijawab =
                benar.map(
                    function (value, index) {

                        return (
                            Number(value || 0) +
                            Number(salah[index] || 0)
                        );

                    }
                );


            new Chart(
                canvas,
                {

                    type: 'bar',

                    data: {

                        labels: labels,

                        datasets: [

                            {
                                label: 'Seluruh Jawaban',

                                data: dijawab,

                                backgroundColor:
                                    '#2563eb',

                                borderRadius: 7,

                                borderSkipped: false
                            },

                            {
                                label: 'Jawaban Benar',

                                data: benar,

                                backgroundColor:
                                    '#16a34a',

                                borderRadius: 7,

                                borderSkipped: false
                            },

                            {
                                label: 'Jawaban Salah',

                                data: salah,

                                backgroundColor:
                                    '#ef4444',

                                borderRadius: 7,

                                borderSkipped: false
                            }

                        ]

                    },


                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        interaction: {

                            mode: 'index',

                            intersect: false

                        },


                        plugins: {

                            legend: {

                                position: 'top',

                                labels: {

                                    usePointStyle: true,

                                    padding: 20,

                                    font: {

                                        family:
                                            '"Segoe UI", Arial, sans-serif',

                                        weight: '600'

                                    }

                                }

                            },


                            tooltip: {

                                backgroundColor:
                                    'rgba(15,23,42,.95)',

                                padding: 12,

                                cornerRadius: 10,

                                displayColors: true

                            }

                        },


                        scales: {

                            x: {

                                grid: {

                                    display: false

                                },

                                ticks: {

                                    font: {

                                        weight: '600'

                                    }

                                }

                            },


                            y: {

                                beginAtZero: true,

                                grid: {

                                    color:
                                        'rgba(148,163,184,.15)'

                                },

                                ticks: {

                                    precision: 0

                                },

                                title: {

                                    display: true,

                                    text: 'Jumlah Jawaban'

                                }

                            }

                        }

                    }

                }

            );

        }

    );

</script>


<!-- =========================================================
     BOOTSTRAP JS
========================================================= -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>