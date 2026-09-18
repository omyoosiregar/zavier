<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Riwayat Ujian - Sistem Kecermatan POLRI</title>

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

    <style>

        /* =========================================================
           GLOBAL
        ========================================================= */

        body {

            background: #f5f8fc;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            color: #1d2939;

        }


        /* =========================================================
           NAVBAR
        ========================================================= */

        .navbar {

            background: rgba(255,255,255,.97);

            box-shadow:
                0 3px 18px rgba(0,0,0,.06);

            padding: 10px 0;

        }


        .brand {

            font-weight: 800;

            color: #1769aa;

            letter-spacing: .4px;

            font-size: 19px;

        }


        .brand:hover {

            color: #0d6efd;

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


        .nav-link.disabled {

            color: #adb5bd;

            cursor: not-allowed;

            background: transparent;

        }


        /* =========================================================
           PROFILE
        ========================================================= */

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

            font-weight: 500;

        }


        .dropdown-item:hover {

            background: #eef7ff;

        }


        /* =========================================================
           HEADER
        ========================================================= */

        .page-header {

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


        .page-header::before {

            content: "";

            position: absolute;

            width: 220px;

            height: 220px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.08);

            right: -70px;

            top: -90px;

        }


        .page-header::after {

            content: "";

            position: absolute;

            width: 140px;

            height: 140px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.06);

            left: -50px;

            bottom: -70px;

        }


        .page-header-content {

            position: relative;

            z-index: 2;

        }


        .page-header h2 {

            font-weight: 800;

        }


        .page-header p {

            margin-bottom: 0;

            opacity: .9;

        }


        .header-icon {

            font-size: 90px;

            opacity: .25;

        }


        /* =========================================================
           STAT CARD
        ========================================================= */

        .stat-card {

            background: white;

            border: none;

            border-radius: 18px;

            padding: 20px;

            box-shadow:
                0 6px 22px
                rgba(0,0,0,.05);

            height: 100%;

            transition: .2s ease;

        }


        .stat-card:hover {

            transform: translateY(-3px);

            box-shadow:
                0 10px 28px
                rgba(0,0,0,.08);

        }


        .stat-icon {

            width: 48px;

            height: 48px;

            border-radius: 14px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #eaf5ff;

            color: #0d6efd;

            font-size: 21px;

            margin-bottom: 12px;

        }


        .stat-number {

            font-size: 26px;

            font-weight: 800;

            color: #1d2939;

        }


        .stat-label {

            color: #667085;

            font-size: 13px;

        }


        /* =========================================================
           FILTER
        ========================================================= */

        .filter-card {

            background: white;

            border: none;

            border-radius: 18px;

            padding: 20px;

            box-shadow:
                0 6px 22px
                rgba(0,0,0,.05);

        }


        .form-control,
        .form-select {

            border-radius: 11px;

            border:
                1px solid #d0d5dd;

            padding: 10px 13px;

        }


        .form-control:focus,
        .form-select:focus {

            border-color: #0d6efd;

            box-shadow:
                0 0 0 .2rem
                rgba(13,110,253,.10);

        }


        /* =========================================================
           HISTORY
        ========================================================= */

        .history-card {

            background: white;

            border: none;

            border-radius: 18px;

            box-shadow:
                0 6px 22px
                rgba(0,0,0,.05);

            overflow: hidden;

        }


        .history-row {

            padding: 20px;

            border-bottom:
                1px solid #eef2f6;

            transition: .2s ease;

        }


        .history-row:last-child {

            border-bottom: none;

        }


        .history-row:hover {

            background: #f9fcff;

        }


        .history-icon {

            width: 48px;

            height: 48px;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #eaf5ff,
                    #e6fffb
                );

            color: #0d6efd;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 20px;

        }


        .history-title {

            font-weight: 800;

            color: #1d2939;

        }


        .history-date {

            color: #98a2b3;

            font-size: 13px;

        }


        /* =========================================================
           SCORE
        ========================================================= */

        .score {

            font-size: 26px;

            font-weight: 800;

            color: #0d6efd;

        }


        .score-label {

            font-size: 12px;

            color: #98a2b3;

        }


        /* =========================================================
           BADGE
        ========================================================= */

        .badge-category {

            border-radius: 20px;

            padding: 7px 12px;

            font-size: 11px;

            font-weight: 700;

        }


        .badge-sangat {

            background: #dcfce7;

            color: #15803d;

        }


        .badge-baik {

            background: #dbeafe;

            color: #1d4ed8;

        }


        .badge-cukup {

            background: #fef3c7;

            color: #b45309;

        }


        .badge-latihan {

            background: #ffedd5;

            color: #c2410c;

        }


        .badge-banyak {

            background: #fee2e2;

            color: #b91c1c;

        }


        /* =========================================================
           BUTTON
        ========================================================= */

        .btn-detail {

            border-radius: 10px;

            font-weight: 700;

            padding: 9px 14px;

        }


        /* =========================================================
           EMPTY
        ========================================================= */

        .empty-box {

            padding: 65px 20px;

            text-align: center;

        }


        .empty-icon {

            font-size: 65px;

            color: #adb5bd;

        }


        /* =========================================================
           PAGINATION
        ========================================================= */

        .pagination {

            margin-bottom: 0;

        }


        .page-link {

            border: none;

            margin: 0 3px;

            border-radius: 9px !important;

            color: #0d6efd;

        }


        .page-item.active .page-link {

            background: #0d6efd;

            color: white;

        }


        /* =========================================================
           FOOTER
        ========================================================= */

        footer {

            color: #98a2b3;

            font-size: 13px;

        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 767px) {

            .page-header {

                padding: 25px;

                border-radius: 20px;

            }


            .header-icon {

                display: none;

            }


            .history-row {

                padding: 16px;

            }


            .score {

                font-size: 22px;

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
         HEADER
    ===================================================== -->

    <div class="page-header">

        <div class="page-header-content">

            <div class="row align-items-center">


                <div class="col-md-8">

                    <span class="badge bg-light text-primary mb-2">

                        <i
                            class="bi bi-clock-history me-1"
                        ></i>

                        RIWAYAT UJIAN

                    </span>


                    <h2 class="mb-2">

                        Riwayat Ujian Saya

                    </h2>


                    <p>

                        Lihat seluruh ujian yang sudah Anda
                        kerjakan sebelumnya.

                    </p>

                </div>


                <div class="col-md-4 text-md-end">

                    <i
                        class="bi bi-clock-history header-icon"
                    ></i>

                </div>

            </div>

        </div>

    </div>



    <!-- =====================================================
         STATISTIK
    ===================================================== -->

    <div class="row g-4 mb-4">


        <!-- TOTAL -->

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="bi bi-journal-check"></i>

                </div>


                <div class="stat-number">

                    {{ $totalUjian }}

                </div>


                <div class="stat-label">

                    Total Ujian

                </div>

            </div>

        </div>



        <!-- RATA RATA -->

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="bi bi-graph-up"></i>

                </div>


                <div class="stat-number">

                    {{
                        $rataRata !== null
                        ? number_format($rataRata, 2)
                        : '0.00'
                    }}

                </div>


                <div class="stat-label">

                    Nilai Rata-rata

                </div>

            </div>

        </div>



        <!-- TERTINGGI -->

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="bi bi-trophy"></i>

                </div>


                <div class="stat-number">

                    {{
                        $nilaiTertinggi !== null
                        ? number_format($nilaiTertinggi, 2)
                        : '0.00'
                    }}

                </div>


                <div class="stat-label">

                    Nilai Tertinggi

                </div>

            </div>

        </div>



        <!-- TERAKHIR -->

        <div class="col-md-6 col-xl-3">

            <div class="stat-card">

                <div class="stat-icon">

                    <i class="bi bi-calendar-check"></i>

                </div>


                @if($ujianTerakhir)

                    <div class="stat-number">

                        {{
                            $ujianTerakhir->selesai_pada
                            ? $ujianTerakhir->selesai_pada->format('d/m/Y')
                            : '-'
                        }}

                    </div>

                @else

                    <div class="stat-number">

                        -

                    </div>

                @endif


                <div class="stat-label">

                    Ujian Terakhir

                </div>

            </div>

        </div>

    </div>



    <!-- =====================================================
         FILTER
    ===================================================== -->

    <div class="filter-card mb-4">

        <form
            method="GET"
            action="{{ route('murid.riwayat') }}"
        >

            <div class="row g-3 align-items-end">


                <!-- SEARCH -->

                <div class="col-md-6">

                    <label class="form-label fw-semibold">

                        Cari Paket

                    </label>


                    <div class="input-group">

                        <span
                            class="input-group-text bg-white"
                        >

                            <i class="bi bi-search"></i>

                        </span>


                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari nama paket..."
                            value="{{ request('search') }}"
                        >

                    </div>

                </div>



                <!-- KATEGORI -->

                <div class="col-md-4">

                    <label class="form-label fw-semibold">

                        Kategori

                    </label>


                    <select
                        name="kategori"
                        class="form-select"
                    >

                        <option value="">

                            Semua Kategori

                        </option>


                        @foreach($kategoriList as $kategori)

                            <option
                                value="{{ $kategori }}"
                                {{ request('kategori') == $kategori ? 'selected' : '' }}
                            >

                                {{ $kategori }}

                            </option>

                        @endforeach

                    </select>

                </div>



                <!-- FILTER BUTTON -->

                <div class="col-md-2">

                    <button
                        type="submit"
                        class="btn btn-primary w-100 rounded-3"
                    >

                        <i class="bi bi-filter me-1"></i>

                        Filter

                    </button>

                </div>

            </div>

        </form>

    </div>



    <!-- =====================================================
         RIWAYAT
    ===================================================== -->

    <div class="history-card">


        @if($hasilUjians->count() > 0)


            @foreach($hasilUjians as $hasil)


                @php

                    $kategoriClass = match($hasil->kategori) {

                        'Sangat Baik' =>
                            'badge-sangat',

                        'Baik' =>
                            'badge-baik',

                        'Cukup' =>
                            'badge-cukup',

                        'Perlu Latihan' =>
                            'badge-latihan',

                        default =>
                            'badge-banyak',

                    };

                @endphp


                <div class="history-row">

                    <div
                        class="row align-items-center g-3"
                    >


                        <!-- ICON -->

                        <div class="col-auto">

                            <div class="history-icon">

                                <i
                                    class="bi bi-file-earmark-check"
                                ></i>

                            </div>

                        </div>



                        <!-- INFO -->

                        <div class="col">

                            <div class="history-title">

                                {{
                                    $hasil->paketSoal->nama_paket
                                    ?? 'Paket Ujian'
                                }}

                            </div>


                            <div class="history-date mt-1">

                                <i
                                    class="bi bi-calendar3 me-1"
                                ></i>


                                @if($hasil->selesai_pada)

                                    {{
                                        $hasil->selesai_pada
                                            ->format('d M Y, H:i')
                                    }}

                                @else

                                    -

                                @endif

                            </div>


                            <div class="mt-2">

                                <span
                                    class="text-muted small me-3"
                                >

                                    <i
                                        class="bi bi-check-circle me-1"
                                    ></i>

                                    {{ $hasil->total_benar ?? 0 }}

                                    benar

                                </span>


                                <span class="text-muted small">

                                    <i
                                        class="bi bi-list-check me-1"
                                    ></i>

                                    {{ $hasil->total_soal ?? 0 }}

                                    soal

                                </span>

                            </div>

                        </div>



                        <!-- NILAI -->

                        <div
                            class="col-6 col-md-auto text-md-center"
                        >

                            <div class="score">

                                {{
                                    number_format(
                                        (float) $hasil->nilai,
                                        2
                                    )
                                }}

                            </div>


                            <div class="score-label">

                                NILAI

                            </div>

                        </div>



                        <!-- KATEGORI -->

                        <div class="col-6 col-md-auto">

                            <span
                                class="
                                    badge-category
                                    {{ $kategoriClass }}
                                "
                            >

                                {{
                                    $hasil->kategori
                                    ?? 'Belum Ada Kategori'
                                }}

                            </span>

                        </div>



                        <!-- DETAIL -->

                        <div class="col-12 col-md-auto">

                            <a
                                href="{{ route('murid.hasil', $hasil->id) }}"
                                class="btn btn-outline-primary btn-detail"
                            >

                                <i
                                    class="bi bi-bar-chart-line me-1"
                                ></i>

                                Lihat Hasil

                            </a>

                        </div>


                    </div>

                </div>


            @endforeach


        @else


            <!-- EMPTY -->

            <div class="empty-box">

                <div class="empty-icon mb-3">

                    <i class="bi bi-clock-history"></i>

                </div>


                <h4 class="fw-bold">

                    Belum Ada Riwayat Ujian

                </h4>


                <p class="text-muted mb-4">

                    Anda belum menyelesaikan ujian apa pun.
                    Silakan pilih paket soal dan mulai latihan.

                </p>


                <a
                    href="{{ route('murid.paket-soal') }}"
                    class="btn btn-primary rounded-pill px-4"
                >

                    <i class="bi bi-play-fill me-1"></i>

                    Mulai Ujian

                </a>

            </div>


        @endif


    </div>



    <!-- =====================================================
         PAGINATION
    ===================================================== -->

    @if($hasilUjians->hasPages())

        <div class="d-flex justify-content-center mt-4">

            {{ $hasilUjians->links() }}

        </div>

    @endif


</div>



<!-- =========================================================
     FOOTER
========================================================= -->

<footer class="text-center py-4">

    Sistem Soal Kecermatan POLRI

    &copy;

    {{ date('Y') }}

</footer>



<!-- BOOTSTRAP JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


</body>

</html>