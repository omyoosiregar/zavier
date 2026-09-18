<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Hasil Ujian - Sistem Kecermatan POLRI
    </title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>

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
        }

        .brand {
            font-weight: 800;
            color: #1769aa;
            letter-spacing: .4px;
            font-size: 19px;
        }

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

        /* =====================================================
           PROFILE
        ===================================================== */

        .profile-link {
            border-radius: 12px;
            padding: 5px 8px;
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
            align-items: center;
            justify-content: center;

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
        }

        .dropdown-item:hover {
            background: #eef7ff;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .result-header {

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
            margin-bottom: 25px;

            box-shadow:
                0 12px 30px
                rgba(13,110,253,.18);

            position: relative;
            overflow: hidden;
        }

        .result-header h2 {
            font-weight: 800;
        }

        .result-header p {
            margin-bottom: 0;
            opacity: .9;
        }

        .header-icon {

            font-size: 100px;

            opacity: .20;

            position: absolute;

            right: 35px;
            top: 15px;
        }


        /* =====================================================
           SCORE HERO
        ===================================================== */

        .score-card {

            background: white;

            border-radius: 22px;

            padding: 25px;

            box-shadow:
                0 6px 22px
                rgba(0,0,0,.05);

            text-align: center;

            height: 100%;
        }

        .score-circle {

            width: 150px;
            height: 150px;

            border-radius: 50%;

            margin: 0 auto 15px;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #0dcaf0
                );

            color: white;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            box-shadow:
                0 10px 30px
                rgba(13,110,253,.22);
        }

        .score-number {

            font-size: 38px;

            font-weight: 900;

            line-height: 1;
        }

        .score-text {

            font-size: 12px;

            margin-top: 6px;

            opacity: .9;
        }

        .category-badge {

            display: inline-block;

            padding: 8px 16px;

            border-radius: 30px;

            background: #eaf5ff;

            color: #0d6efd;

            font-weight: 700;

            font-size: 13px;
        }


        /* =====================================================
           STAT CARD
        ===================================================== */

        .stat-card {

            background: white;

            border-radius: 18px;

            padding: 20px;

            box-shadow:
                0 6px 22px
                rgba(0,0,0,.05);

            height: 100%;
        }

        .stat-icon {

            width: 48px;
            height: 48px;

            border-radius: 14px;

            background: #eaf5ff;

            color: #0d6efd;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 21px;

            margin-bottom: 12px;
        }

        .stat-number {

            font-size: 27px;

            font-weight: 800;

            color: #1d2939;
        }

        .stat-label {

            color: #667085;

            font-size: 13px;
        }


        /* =====================================================
           CONTENT CARD
        ===================================================== */

        .content-card {

            background: white;

            border-radius: 20px;

            box-shadow:
                0 6px 22px
                rgba(0,0,0,.05);

            padding: 25px;

            height: 100%;
        }

        .card-title {

            font-weight: 800;

            font-size: 18px;

            margin-bottom: 20px;
        }


        /* =====================================================
           CHART
        ===================================================== */

        .chart-container {

            position: relative;

            height: 320px;
        }


        /* =====================================================
           COLUMN
        ===================================================== */

        .column-card {

            border: 1px solid #eef2f6;

            border-radius: 16px;

            padding: 18px;

            margin-bottom: 15px;

            transition: .2s ease;
        }

        .column-card:hover {

            transform: translateY(-2px);

            box-shadow:
                0 8px 22px
                rgba(0,0,0,.06);
        }

        .column-number {

            width: 42px;
            height: 42px;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #0dcaf0
                );

            color: white;

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: 800;
        }

        .column-score {

            font-size: 23px;

            font-weight: 800;

            color: #0d6efd;
        }


        /* =====================================================
           PROGRESS
        ===================================================== */

        .progress {

            height: 8px;

            border-radius: 20px;

            background: #edf2f7;
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
           ANALYSIS
        ===================================================== */

        .analysis-box {

            border-radius: 18px;

            padding: 22px;

            background:
                linear-gradient(
                    135deg,
                    #eef7ff,
                    #effffc
                );

            border: 1px solid #dbeafe;
        }

        .analysis-icon {

            width: 50px;
            height: 50px;

            border-radius: 14px;

            background: white;

            color: #0d6efd;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 23px;
        }


        /* =====================================================
           BADGE
        ===================================================== */

        .badge-benarr {

            background: #dcfce7;

            color: #15803d;

            padding: 7px 12px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 700;
        }

        .badge-salah {

            background: #fee2e2;

            color: #b91c1c;

            padding: 7px 12px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 700;
        }

        .badge-kosong {

            background: #f1f5f9;

            color: #64748b;

            padding: 7px 12px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 700;
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .btn-modern {

            border-radius: 12px;

            padding: 11px 18px;

            font-weight: 700;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width:767px) {

            .result-header {

                padding: 25px;

                border-radius: 20px;
            }

            .header-icon {

                display: none;
            }

            .score-circle {

                width: 125px;
                height: 125px;
            }

            .score-number {

                font-size: 30px;
            }

            .chart-container {

                height: 260px;
            }
        }

    </style>

</head>


<body>


{{-- =========================================================
     NAVBAR
========================================================= --}}

@include('layouts.navbar-murid')

{{-- =========================================================
     CONTENT
========================================================= --}}

<div class="container pb-5">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="result-header">

        <div class="row align-items-center">

            <div class="col-md-9">

                <span class="badge bg-light text-primary mb-2">

                    <i class="bi bi-check-circle me-1"></i>

                    UJIAN SELESAI

                </span>


                <h2 class="mb-2">

                    Hasil Ujian

                </h2>


                <p>

                    {{ $hasil->paketSoal->nama_paket ?? 'Paket Ujian' }}

                </p>

            </div>


            <div class="col-md-3 text-md-end">

                <i
                    class="bi bi-bar-chart-fill header-icon"
                ></i>

            </div>

        </div>

    </div>



    {{-- =====================================================
         TOMBOL
    ====================================================== --}}

    <div class="d-flex flex-wrap gap-2 mb-4">

        <a
            href="{{ route('murid.paket-soal') }}"
            class="btn btn-primary btn-modern"
        >

            <i class="bi bi-play-fill me-1"></i>

            Ujian Lagi

        </a>


        <a
            href="{{ route('murid.hasil.index') }}"
            class="btn btn-outline-primary btn-modern"
        >

            <i class="bi bi-clock-history me-1"></i>

            Lihat Riwayat

        </a>

    </div>



    {{-- =====================================================
         SCORE + INFO
    ====================================================== --}}

    <div class="row g-4 mb-4">


        {{-- SCORE --}}

        <div class="col-lg-4">

            <div class="score-card">

                <div class="score-circle">

                    <div class="score-number">

                        {{ number_format((float) $hasil->nilai, 2) }}

                    </div>

                    <div class="score-text">

                        NILAI AKHIR

                    </div>

                </div>


                <div class="category-badge">

                    <i class="bi bi-award me-1"></i>

                    {{ $hasil->kategori ?? 'Belum Ada Kategori' }}

                </div>


                <p class="text-muted small mt-3 mb-0">

                    {{ $hasil->keterangan ?? 'Hasil ujian berhasil disimpan.' }}

                </p>

            </div>

        </div>



        {{-- STATISTIK --}}

        <div class="col-lg-8">

            <div class="row g-3 h-100">


                <div class="col-md-6">

                    <div class="stat-card">

                        <div class="stat-icon">

                            <i class="bi bi-list-check"></i>

                        </div>

                        <div class="stat-number">

                            {{ $hasil->total_soal ?? 0 }}

                        </div>

                        <div class="stat-label">

                            Total Soal

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="stat-card">

                        <div class="stat-icon">

                            <i class="bi bi-check-circle"></i>

                        </div>

                        <div class="stat-number text-success">

                            {{ $hasil->total_benar ?? 0 }}

                        </div>

                        <div class="stat-label">

                            Jawaban Benar

                        </div>

                    </div>

                </div>


                @php

                    $totalDijawab = collect($statistikKolom)
                        ->sum('dijawab');

                    $totalSalah = collect($statistikKolom)
                        ->sum('salah');

                    $totalTidakDijawab = collect($statistikKolom)
                        ->sum('tidak_dijawab');

                @endphp


                <div class="col-md-6">

                    <div class="stat-card">

                        <div class="stat-icon">

                            <i class="bi bi-pencil-square"></i>

                        </div>

                        <div class="stat-number">

                            {{ $totalDijawab }}

                        </div>

                        <div class="stat-label">

                            Total Dijawab

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="stat-card">

                        <div class="stat-icon">

                            <i class="bi bi-x-circle"></i>

                        </div>

                        <div class="stat-number text-danger">

                            {{ $totalSalah }}

                        </div>

                        <div class="stat-label">

                            Jawaban Salah

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         GRAFIK
    ====================================================== --}}

    <div class="row g-4 mb-4">


        {{-- GRAFIK NILAI --}}

        <div class="col-lg-8">

            <div class="content-card">

                <div class="card-title">

                    <i class="bi bi-bar-chart-line text-primary me-2"></i>

                    Grafik Nilai Per Kolom

                </div>


                <div class="chart-container">

                    <canvas id="nilaiKolomChart"></canvas>

                </div>

            </div>

        </div>



        {{-- RINGKASAN --}}

        <div class="col-lg-4">

            <div class="content-card">

                <div class="card-title">

                    <i class="bi bi-pie-chart text-primary me-2"></i>

                    Ringkasan Jawaban

                </div>


                <div class="chart-container">

                    <canvas id="jawabanChart"></canvas>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         ANALISIS
    ====================================================== --}}

    <div class="content-card mb-4">

        <div class="card-title">

            <i class="bi bi-lightbulb text-warning me-2"></i>

            Analisis Performa

        </div>


        <div class="analysis-box">

            <div class="d-flex align-items-start gap-3">

                <div class="analysis-icon flex-shrink-0">

                    <i class="bi bi-graph-up-arrow"></i>

                </div>


                <div>

                    <h5 class="fw-bold mb-2">

                        {{ $hasil->kategori ?? 'Hasil Ujian' }}

                    </h5>


                    <p class="mb-0 text-muted">

                        {{ $hasil->keterangan ?? 'Belum ada keterangan.' }}

                    </p>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         HASIL PER KOLOM
    ====================================================== --}}

    <div class="content-card mb-4">

        <div class="card-title">

            <i class="bi bi-columns-gap text-primary me-2"></i>

            Hasil Per Kolom

        </div>


        @foreach($statistikKolom as $nomor => $statistik)

            <div class="column-card">

                <div class="row align-items-center g-3">


                    {{-- NOMOR --}}

                    <div class="col-auto">

                        <div class="column-number">

                            {{ $nomor }}

                        </div>

                    </div>


                    {{-- INFO --}}

                    <div class="col">

                        <div class="fw-bold mb-1">

                            Kolom {{ $nomor }}

                        </div>


                        <div class="small text-muted mb-2">

                            {{ $statistik['dijawab'] }}
                            dari
                            {{ $statistik['total_soal'] }}
                            soal dijawab

                        </div>


                        <div class="progress">

                            <div
                                class="progress-bar"
                                style="
                                    width:
                                    {{ $statistik['nilai'] }}%;
                                "
                            ></div>

                        </div>

                    </div>


                    {{-- NILAI --}}

                    <div class="col-auto text-center">

                        <div class="column-score">

                            {{ number_format($statistik['nilai'], 0) }}

                        </div>

                        <small class="text-muted">

                            Nilai

                        </small>

                    </div>


                    {{-- DETAIL --}}

                    <div class="col-12 col-md-auto">

                        <div class="d-flex gap-2 flex-wrap">

                            <span class="badge-benarr">

                                <i class="bi bi-check-circle me-1"></i>

                                {{ $statistik['benar'] }} Benar

                            </span>


                            <span class="badge-salah">

                                <i class="bi bi-x-circle me-1"></i>

                                {{ $statistik['salah'] }} Salah

                            </span>


                            <span class="badge-kosong">

                                <i class="bi bi-dash-circle me-1"></i>

                                {{ $statistik['tidak_dijawab'] }} Kosong

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        @endforeach

    </div>



    {{-- =====================================================
         DETAIL WAKTU
    ====================================================== --}}

    <div class="content-card mb-4">

        <div class="card-title">

            <i class="bi bi-clock-history text-primary me-2"></i>

            Informasi Ujian

        </div>


        <div class="row g-3">


            <div class="col-md-4">

                <div class="p-3 bg-light rounded-3">

                    <small class="text-muted d-block">

                        Mulai Ujian

                    </small>

                    <strong>

                        @if($hasil->mulai_pada)

                            {{ $hasil->mulai_pada->format('d M Y, H:i:s') }}

                        @else

                            -

                        @endif

                    </strong>

                </div>

            </div>


            <div class="col-md-4">

                <div class="p-3 bg-light rounded-3">

                    <small class="text-muted d-block">

                        Selesai Ujian

                    </small>

                    <strong>

                        @if($hasil->selesai_pada)

                            {{ $hasil->selesai_pada->format('d M Y, H:i:s') }}

                        @else

                            -

                        @endif

                    </strong>

                </div>

            </div>


            <div class="col-md-4">

                <div class="p-3 bg-light rounded-3">

                    <small class="text-muted d-block">

                        Tidak Dijawab

                    </small>

                    <strong>

                        {{ $totalTidakDijawab }}

                        soal

                    </strong>

                </div>

            </div>

        </div>

    </div>



</div>



{{-- =========================================================
     FOOTER
========================================================= --}}

<footer class="text-center py-4 text-muted small">

    Sistem Soal Kecermatan POLRI

    &copy;

    {{ date('Y') }}

</footer>



{{-- =========================================================
     CHART SCRIPT
========================================================= --}}

<script>

    const nilaiKolom = @json($hasil->nilai_kolom ?? []);

    const statistikKolom = @json($statistikKolom);


    /*
    |--------------------------------------------------------------------------
    | LABEL KOLOM
    |--------------------------------------------------------------------------
    */

    const labels = Object.keys(nilaiKolom)
        .map(k => 'Kolom ' + k);


    /*
    |--------------------------------------------------------------------------
    | NILAI
    |--------------------------------------------------------------------------
    */

    const nilai = Object.values(nilaiKolom);


    /*
    |--------------------------------------------------------------------------
    | GRAFIK NILAI PER KOLOM
    |--------------------------------------------------------------------------
    */

    new Chart(
        document.getElementById('nilaiKolomChart'),
        {
            type: 'bar',

            data: {

                labels: labels,

                datasets: [{

                    label: 'Nilai',

                    data: nilai,

                    borderRadius: 8,

                    backgroundColor: '#0d6efd'

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                scales: {

                    y: {

                        beginAtZero: true,

                        max: 100

                    }

                },

                plugins: {

                    legend: {

                        display: false

                    }

                }

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | TOTAL JAWABAN
    |--------------------------------------------------------------------------
    */

    let benar = 0;

    let salah = 0;

    let kosong = 0;


    Object.values(statistikKolom).forEach(item => {

        benar += Number(item.benar || 0);

        salah += Number(item.salah || 0);

        kosong += Number(item.tidak_dijawab || 0);

    });


    /*
    |--------------------------------------------------------------------------
    | GRAFIK JAWABAN
    |--------------------------------------------------------------------------
    */

    new Chart(
        document.getElementById('jawabanChart'),
        {

            type: 'doughnut',

            data: {

                labels: [
                    'Benar',
                    'Salah',
                    'Tidak Dijawab'
                ],

                datasets: [{

                    data: [
                        benar,
                        salah,
                        kosong
                    ],

                    backgroundColor: [
                        '#198754',
                        '#dc3545',
                        '#adb5bd'
                    ],

                    borderWidth: 0

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                cutout: '65%',

                plugins: {

                    legend: {

                        position: 'bottom'

                    }

                }

            }

        }
    );

</script>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>