<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Paket Soal - ZAVIER Learning Center</title>

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

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            background:
                linear-gradient(
                    135deg,
                    #f5f9ff 0%,
                    #eef5ff 50%,
                    #f8fbff 100%
                );

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            color: #17386f;

            min-height: 100vh;
        }


        /* =====================================================
           PAGE
        ===================================================== */

        .package-page {

            max-width: 1500px;

            margin: 0 auto;

            padding:
                30px
                28px
                50px;
        }


        /* =====================================================
           HERO
        ===================================================== */

        .hero {

            position: relative;

            overflow: hidden;

            border-radius: 28px;

            padding:
                38px
                42px;

            margin-bottom: 28px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd 0%,
                    #1769d2 45%,
                    #0dcaf0 100%
                );

            box-shadow:
                0 18px 45px
                rgba(13, 110, 253, .18);
        }


        .hero::before {

            content: "";

            position: absolute;

            width: 300px;
            height: 300px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.07);

            right: -100px;
            top: -150px;
        }


        .hero::after {

            content: "";

            position: absolute;

            width: 180px;
            height: 180px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.06);

            left: -80px;
            bottom: -100px;
        }


        .hero-content {

            position: relative;

            z-index: 2;
        }


        .hero-badge {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding:
                7px
                13px;

            border-radius: 30px;

            background:
                rgba(255,255,255,.16);

            border:
                1px solid
                rgba(255,255,255,.18);

            font-size: 11px;

            font-weight: 700;

            letter-spacing: .5px;

            margin-bottom: 15px;
        }


        .hero h1 {

            margin: 0;

            font-size: 32px;

            font-weight: 850;

            letter-spacing: -.7px;
        }


        .hero p {

            margin:
                10px
                0
                0;

            max-width: 700px;

            font-size: 14px;

            line-height: 1.7;

            opacity: .92;
        }


        .hero-icon {

            font-size: 105px;

            opacity: .20;

            position: relative;

            z-index: 2;
        }


        /* =====================================================
           CATEGORY WRAPPER
        ===================================================== */

        .category-panel {

            background:
                rgba(255,255,255,.86);

            border:
                1px solid
                #e2eaf5;

            border-radius: 24px;

            padding: 10px;

            box-shadow:
                0 12px 35px
                rgba(35,76,130,.06);

            margin-bottom: 28px;
        }


        .category-tabs {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 8px;
        }


        .category-btn {

            border: none;

            background: transparent;

            border-radius: 18px;

            padding:
                15px
                16px;

            color: #7183a0;

            cursor: pointer;

            transition: .25s ease;

            text-align: left;

            position: relative;
        }


        .category-btn:hover {

            background: #f1f6ff;

            color: #1769aa;

            transform:
                translateY(-2px);
        }


        .category-btn.active {

            background:
                linear-gradient(
                    135deg,
                    #eaf3ff,
                    #f4fbff
                );

            color: #0d6efd;

            box-shadow:
                0 7px 20px
                rgba(13,110,253,.08);
        }


        .category-btn.active::after {

            content: "";

            position: absolute;

            height: 3px;

            left: 20px;
            right: 20px;

            bottom: 5px;

            border-radius: 10px;

            background:
                linear-gradient(
                    90deg,
                    #0d6efd,
                    #0dcaf0
                );
        }


        .category-inner {

            display: flex;

            align-items: center;

            gap: 12px;
        }


        .category-icon {

            width: 48px;
            height: 48px;

            border-radius: 15px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 21px;

            flex-shrink: 0;

            background: #eef5ff;

            color: #1769aa;

            transition: .25s ease;
        }


        .category-btn.active
        .category-icon {

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #0dcaf0
                );

            color: white;

            box-shadow:
                0 6px 15px
                rgba(13,110,253,.18);
        }


        .category-name {

            font-size: 14px;

            font-weight: 800;

            display: block;
        }


        .category-count {

            font-size: 11px;

            color: #91a1ba;

            display: block;

            margin-top: 3px;
        }


        /* =====================================================
           SECTION HEADER
        ===================================================== */

        .section-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 20px;
        }


        .section-title {

            display: flex;

            align-items: center;

            gap: 12px;
        }


        .section-title-icon {

            width: 48px;
            height: 48px;

            border-radius: 15px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #e8f2ff,
                    #effaff
                );

            color: #0d6efd;

            font-size: 21px;
        }


        .section-title h2 {

            margin: 0;

            font-size: 21px;

            font-weight: 850;

            color: #17386f;
        }


        .section-title p {

            margin:
                4px
                0
                0;

            color: #8b9bb5;

            font-size: 12px;
        }


        .package-total {

            padding:
                9px
                14px;

            border-radius: 13px;

            background: #edf4ff;

            color: #1763e8;

            font-size: 12px;

            font-weight: 800;

            white-space: nowrap;
        }


        /* =====================================================
           SEARCH
        ===================================================== */

        .search-box {

            position: relative;

            width: 280px;
        }


        .search-box i {

            position: absolute;

            left: 15px;

            top: 50%;

            transform:
                translateY(-50%);

            color: #8da0bd;
        }


        .search-box input {

            width: 100%;

            border:
                1px solid
                #dfe8f4;

            border-radius: 14px;

            padding:
                11px
                15px
                11px
                42px;

            background: white;

            color: #17386f;

            outline: none;

            transition: .2s ease;
        }


        .search-box input:focus {

            border-color: #8bb9ff;

            box-shadow:
                0 0 0 4px
                rgba(13,110,253,.07);
        }


        /* =====================================================
           PACKAGE GRID
        ===================================================== */

        .package-grid {

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 22px;
        }


        /* =====================================================
           PACKAGE CARD
        ===================================================== */

        .package-card {

            position: relative;

            background: white;

            border:
                1px solid
                #e4ebf6;

            border-radius: 23px;

            overflow: hidden;

            display: flex;

            flex-direction: column;

            min-height: 370px;

            box-shadow:
                0 10px 32px
                rgba(35,76,130,.065);

            transition:
                transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease;
        }


        .package-card:hover {

            transform:
                translateY(-7px);

            border-color:
                #c9ddf8;

            box-shadow:
                0 20px 42px
                rgba(35,76,130,.12);
        }


        /* =====================================================
           CARD TOP
        ===================================================== */

        .package-top {

            position: relative;

            padding:
                25px
                25px
                21px;

            background:
                linear-gradient(
                    135deg,
                    #f5f9ff,
                    #ffffff
                );

            border-bottom:
                1px solid
                #edf2f8;
        }


        .package-top::before {

            content: "";

            position: absolute;

            width: 100px;
            height: 100px;

            border-radius: 50%;

            background:
                rgba(13,110,253,.045);

            right: -35px;
            top: -40px;
        }


        .package-icon {

            width: 58px;
            height: 58px;

            border-radius: 17px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #0dcaf0
                );

            color: white;

            font-size: 24px;

            margin-bottom: 18px;

            box-shadow:
                0 8px 18px
                rgba(13,110,253,.18);

            position: relative;
        }


        .package-title-row {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 10px;
        }


        .package-title {

            color: #17386f;

            font-size: 18px;

            font-weight: 850;

            line-height: 1.35;

            margin: 0;

            word-break: break-word;
        }


        .level {

            flex-shrink: 0;

            display: inline-flex;

            align-items: center;

            padding:
                6px
                10px;

            border-radius: 20px;

            background: #eaf3ff;

            color: #1763e8;

            font-size: 10px;

            font-weight: 800;

            white-space: nowrap;
        }


        .package-description {

            color: #8393ac;

            font-size: 12px;

            line-height: 1.65;

            margin:
                12px
                0
                0;

            min-height: 40px;
        }


        /* =====================================================
           CARD BODY
        ===================================================== */

        .package-body {

            padding:
                21px
                25px
                24px;

            display: flex;

            flex-direction: column;

            flex: 1;
        }


        .test-badge {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            width: fit-content;

            padding:
                7px
                10px;

            border-radius: 10px;

            background: #f0f7ff;

            color: #1769aa;

            font-size: 10px;

            font-weight: 800;

            margin-bottom: 16px;
        }


        .info-list {

            display: flex;

            flex-direction: column;

            gap: 11px;

            margin-bottom: 18px;
        }


        .info-item {

            display: flex;

            align-items: center;

            gap: 10px;

            color: #7183a0;

            font-size: 12px;
        }


        .info-item i {

            width: 29px;
            height: 29px;

            border-radius: 9px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f0f6ff;

            color: #2876ed;

            font-size: 13px;
        }


        .info-item strong {

            color: #405779;

            font-weight: 750;
        }


        .package-divider {

            height: 1px;

            background: #edf1f7;

            margin-bottom: 18px;
        }


        /* =====================================================
           START BUTTON
        ===================================================== */

        .btn-start {

            width: 100%;

            border: none;

            border-radius: 13px;

            padding:
                12px
                15px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #087ee8
                );

            font-size: 13px;

            font-weight: 800;

            box-shadow:
                0 7px 17px
                rgba(13,110,253,.14);

            transition: .2s ease;

            margin-top: auto;

            text-decoration: none;

            display: block;

            text-align: center;
        }


        .btn-start:hover {

            color: white;

            transform:
                translateY(-2px);

            box-shadow:
                0 10px 23px
                rgba(13,110,253,.22);
        }


        .btn-start i {

            font-size: 17px;

            vertical-align: -1px;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-box {

            background: white;

            border:
                1px solid
                #e3ebf6;

            border-radius: 24px;

            padding:
                65px
                25px;

            text-align: center;

            box-shadow:
                0 10px 30px
                rgba(35,76,130,.06);
        }


        .empty-icon {

            width: 80px;
            height: 80px;

            margin:
                0
                auto
                18px;

            border-radius: 24px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #eef5ff;

            color: #8aa2c2;

            font-size: 35px;
        }


        .empty-box h4 {

            color: #36547f;

            font-weight: 800;
        }


        .empty-box p {

            color: #91a1b9;

            font-size: 13px;
        }


        /* =====================================================
           SEARCH EMPTY
        ===================================================== */

        .search-empty {

            display: none;

            text-align: center;

            background: white;

            border-radius: 22px;

            padding:
                50px
                20px;

            border:
                1px solid
                #e4ebf6;
        }


        .search-empty i {

            font-size: 42px;

            color: #9aacc4;

            display: block;

            margin-bottom: 12px;
        }


        .search-empty strong {

            display: block;

            color: #486286;

            margin-bottom: 5px;
        }


        .search-empty span {

            color: #91a1b9;

            font-size: 12px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .page-footer {

            text-align: center;

            padding:
                35px
                0
                10px;

            color: #9aaac0;

            font-size: 12px;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 1100px) {

            .package-grid {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }


            .category-tabs {

                grid-template-columns:
                    repeat(2, 1fr);
            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 767px) {

            .package-page {

                padding:
                    20px
                    15px
                    35px;
            }


            .hero {

                padding:
                    27px
                    23px;

                border-radius: 22px;
            }


            .hero h1 {

                font-size: 25px;
            }


            .hero p {

                font-size: 12px;
            }


            .hero-icon {

                display: none;
            }


            .category-panel {

                border-radius: 20px;

                padding: 7px;
            }


            .category-tabs {

                grid-template-columns:
                    1fr 1fr;
            }


            .category-btn {

                padding:
                    12px
                    10px;
            }


            .category-inner {

                gap: 8px;
            }


            .category-icon {

                width: 40px;
                height: 40px;

                border-radius: 12px;

                font-size: 17px;
            }


            .category-name {

                font-size: 11px;
            }


            .category-count {

                font-size: 9px;
            }


            .section-header {

                align-items: stretch;

                flex-direction: column;

                margin-bottom: 18px;
            }


            .search-box {

                width: 100%;
            }


            .package-grid {

                grid-template-columns: 1fr;

                gap: 17px;
            }


            .package-card {

                min-height: auto;
            }

        }


        /* =====================================================
           SMALL MOBILE
        ===================================================== */

        @media (max-width: 450px) {

            .category-tabs {

                grid-template-columns:
                    1fr;
            }


            .category-btn.active::after {

                left: 15px;

                right: 15px;
            }


            .package-top {

                padding:
                    22px
                    20px
                    19px;
            }


            .package-body {

                padding:
                    19px
                    20px
                    21px;
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
     PHP KATEGORI
========================================================= -->

@php

    /*
    |--------------------------------------------------------------------------
    | KATEGORI KECERMATAN
    |--------------------------------------------------------------------------
    */

    $kategoriKecermatan = $pakets->filter(function ($paket) {

        $jenis = strtolower(
            trim($paket->jenis_tes ?? '')
        );

        return
            str_contains($jenis, 'cermat') ||
            str_contains($jenis, 'ketelitian');

    });


    /*
    |--------------------------------------------------------------------------
    | KATEGORI KEPRIBADIAN
    |--------------------------------------------------------------------------
    */

    $kategoriKepribadian = $pakets->filter(function ($paket) {

        $jenis = strtolower(
            trim($paket->jenis_tes ?? '')
        );

        return
            str_contains($jenis, 'kepribadian') ||
            str_contains($jenis, 'personality') ||
            str_contains($jenis, 'karakter') ||
            str_contains($jenis, 'sikap');

    });


    /*
    |--------------------------------------------------------------------------
    | KATEGORI KECERDASAN
    |--------------------------------------------------------------------------
    */

    $kategoriKecerdasan = $pakets->filter(function ($paket) {

        $jenis = strtolower(
            trim($paket->jenis_tes ?? '')
        );

        return
            str_contains($jenis, 'cerdas') ||
            str_contains($jenis, 'kecerdasan') ||
            str_contains($jenis, 'logika') ||
            str_contains($jenis, 'numerik') ||
            str_contains($jenis, 'verbal') ||
            str_contains($jenis, 'penalaran');

    });


    /*
    |--------------------------------------------------------------------------
    | GABUNGKAN PAKET
    |--------------------------------------------------------------------------
    */

    $paketTerklasifikasi =
        $kategoriKecermatan
            ->merge($kategoriKepribadian)
            ->merge($kategoriKecerdasan)
            ->unique('id');


    /*
    |--------------------------------------------------------------------------
    | KATEGORI LAINNYA
    |--------------------------------------------------------------------------
    */

    $kategoriLainnya =
        $pakets->filter(function ($paket) use ($paketTerklasifikasi) {

            return !$paketTerklasifikasi
                ->contains('id', $paket->id);

        });


    /*
    |--------------------------------------------------------------------------
    | PAKET TERURUT
    |--------------------------------------------------------------------------
    */

    $paketsTerurut =
        $kategoriKecermatan
            ->merge($kategoriKepribadian)
            ->merge($kategoriKecerdasan)
            ->merge($kategoriLainnya)
            ->unique('id')
            ->values();

@endphp


<!-- =========================================================
     MAIN
========================================================= -->

<main class="package-page">


    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="hero">

        <div class="hero-content">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <div class="hero-badge">

                        <i class="bi bi-mortarboard-fill"></i>

                        ZAVIER LEARNING CENTER

                    </div>


                    <h1>

                        Paket Soal Ujian

                    </h1>


                    <p>

                        Pilih kategori latihan yang ingin kamu kerjakan.
                        Tingkatkan kemampuan melalui latihan
                        kecermatan, kecerdasan, kepribadian,
                        dan materi lainnya.

                    </p>

                </div>


                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                    <i class="bi bi-journal-richtext hero-icon"></i>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         KATEGORI
    ====================================================== -->

    <section class="category-panel">

        <div class="category-tabs">


            <!-- KECERMATAN -->

            <button
                type="button"
                class="category-btn active"
                data-category="kecermatan"
            >

                <div class="category-inner">

                    <div class="category-icon">

                        <i class="bi bi-bullseye"></i>

                    </div>


                    <div>

                        <span class="category-name">

                            Kecermatan

                        </span>


                        <span class="category-count">

                            {{ $kategoriKecermatan->count() }}
                            paket

                        </span>

                    </div>

                </div>

            </button>


            <!-- KEPRIBADIAN -->

            <button
                type="button"
                class="category-btn"
                data-category="kepribadian"
            >

                <div class="category-inner">

                    <div class="category-icon">

                        <i class="bi bi-person-badge-fill"></i>

                    </div>


                    <div>

                        <span class="category-name">

                            Kepribadian

                        </span>


                        <span class="category-count">

                            {{ $kategoriKepribadian->count() }}
                            paket

                        </span>

                    </div>

                </div>

            </button>


            <!-- KECERDASAN -->

            <button
                type="button"
                class="category-btn"
                data-category="kecerdasan"
            >

                <div class="category-inner">

                    <div class="category-icon">

                        <i class="bi bi-lightbulb-fill"></i>

                    </div>


                    <div>

                        <span class="category-name">

                            Kecerdasan

                        </span>


                        <span class="category-count">

                            {{ $kategoriKecerdasan->count() }}
                            paket

                        </span>

                    </div>

                </div>

            </button>


            <!-- LAINNYA -->

            <button
                type="button"
                class="category-btn"
                data-category="lainnya"
            >

                <div class="category-inner">

                    <div class="category-icon">

                        <i class="bi bi-grid-fill"></i>

                    </div>


                    <div>

                        <span class="category-name">

                            Lainnya

                        </span>


                        <span class="category-count">

                            {{ $kategoriLainnya->count() }}
                            paket

                        </span>

                    </div>

                </div>

            </button>


        </div>

    </section>


    <!-- =====================================================
         SECTION HEADER
    ====================================================== -->

    <div class="section-header">

        <div class="section-title">

            <div class="section-title-icon">

                <i
                    class="bi bi-bullseye"
                    id="categoryTitleIcon"
                ></i>

            </div>


            <div>

                <h2 id="categoryTitle">

                    Kecermatan

                </h2>


                <p id="categoryDescription">

                    Latihan untuk meningkatkan kecepatan
                    dan ketelitian dalam mengerjakan soal.

                </p>

            </div>

        </div>


        <div class="d-flex align-items-center gap-3">

            <div class="package-total">

                <i class="bi bi-collection-fill me-1"></i>

                <span id="visibleCount">

                    {{ $kategoriKecermatan->count() }}

                </span>

                Paket

            </div>


            <div class="search-box">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="searchPackage"
                    placeholder="Cari paket soal..."
                    autocomplete="off"
                >

            </div>

        </div>

    </div>


    <!-- =====================================================
         PACKAGE GRID
    ====================================================== -->

    @if($paketsTerurut->count() > 0)

        <div
            class="package-grid"
            id="packageGrid"
        >


            @foreach($paketsTerurut as $paket)

                @php

                    $jenis =
                        strtolower(
                            trim(
                                $paket->jenis_tes ?? ''
                            )
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | TENTUKAN KATEGORI CARD
                    |--------------------------------------------------------------------------
                    */

                    if (
                        str_contains($jenis, 'cermat') ||
                        str_contains($jenis, 'ketelitian')
                    ) {

                        $kategori = 'kecermatan';

                        $kategoriLabel =
                            'Kecermatan';

                        $kategoriIcon =
                            'bi-bullseye';


                    } elseif (
                        str_contains($jenis, 'kepribadian') ||
                        str_contains($jenis, 'personality') ||
                        str_contains($jenis, 'karakter') ||
                        str_contains($jenis, 'sikap')
                    ) {

                        $kategori = 'kepribadian';

                        $kategoriLabel =
                            'Kepribadian';

                        $kategoriIcon =
                            'bi-person-badge-fill';


                    } elseif (
                        str_contains($jenis, 'cerdas') ||
                        str_contains($jenis, 'kecerdasan') ||
                        str_contains($jenis, 'logika') ||
                        str_contains($jenis, 'numerik') ||
                        str_contains($jenis, 'verbal') ||
                        str_contains($jenis, 'penalaran')
                    ) {

                        $kategori = 'kecerdasan';

                        $kategoriLabel =
                            'Kecerdasan';

                        $kategoriIcon =
                            'bi-lightbulb-fill';


                    } else {

                        $kategori = 'lainnya';

                        $kategoriLabel =
                            'Lainnya';

                        $kategoriIcon =
                            'bi-grid-fill';

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | ICON CARD
                    |--------------------------------------------------------------------------
                    */

                    $cardIcon =
                        $kategori === 'kecermatan'
                            ? 'bi-bullseye'
                            : (
                                $kategori === 'kepribadian'
                                    ? 'bi-person-badge-fill'
                                    : (
                                        $kategori === 'kecerdasan'
                                            ? 'bi-lightbulb-fill'
                                            : 'bi-journal-text'
                                    )
                            );


                    /*
                    |--------------------------------------------------------------------------
                    | ROUTE MULAI UJIAN (PERBAIKAN KECERDASAN)
                    |--------------------------------------------------------------------------
                    |
                    | KECERMATAN:
                    | murid.ujian
                    |
                    | KEPRIBADIAN:
                    | murid.kepribadian.mulai
                    |
                    | KECERDASAN:
                    | murid.kecerdasan.mulai
                    |
                    */

                    if ($kategori === 'kepribadian') {

                        $routeMulaiUjian = route(
                            'murid.kepribadian.mulai',
                            [
                                'paket' => $paket->getKey()
                            ]
                        );

                    } elseif ($kategori === 'kecerdasan') {

                        $routeMulaiUjian = route(
                            'murid.kecerdasan.mulai',
                            [
                                'paket' => $paket->getKey()
                            ]
                        );

                    } else {

                        $routeMulaiUjian = route(
                            'murid.ujian',
                            [
                                'paketSoal' => $paket->getKey()
                            ]
                        );

                    }

                @endphp


                <article
                    class="package-card"
                    data-category="{{ $kategori }}"
                    data-search="{{ strtolower(
                        ($paket->nama_paket ?? '') .
                        ' ' .
                        ($paket->jenis_tes ?? '') .
                        ' ' .
                        ($paket->tingkat ?? '') .
                        ' ' .
                        ($paket->tipe_soal ?? '')
                    ) }}"
                >


                    <!-- =================================================
                         CARD TOP
                    ================================================== -->

                    <div class="package-top">


                        <div class="package-icon">

                            <i class="bi {{ $cardIcon }}"></i>

                        </div>


                        <div class="package-title-row">

                            <h3 class="package-title">

                                {{ $paket->nama_paket }}

                            </h3>


                            @if($paket->tingkat)

                                <span class="level">

                                    {{ $paket->tingkat }}

                                </span>

                            @endif

                        </div>


                        <p class="package-description">

                            {{ $paket->keterangan
                                ?: 'Paket latihan Zavier Learning Center untuk meningkatkan kemampuan Anda.' }}

                        </p>


                    </div>


                    <!-- =================================================
                         CARD BODY
                    ================================================== -->

                    <div class="package-body">


                        <!-- KATEGORI -->

                        <div class="test-badge">

                            <i class="bi {{ $kategoriIcon }}"></i>

                            Tes {{ $kategoriLabel }}

                        </div>


                        <!-- INFO -->

                        <div class="info-list">


                            <!-- JENIS TES -->

                            <div class="info-item">

                                <i class="bi bi-patch-check-fill"></i>

                                <span>

                                    Jenis:

                                    <strong>

                                        {{ $paket->jenis_tes ?: $kategoriLabel }}

                                    </strong>

                                </span>

                            </div>


                            <!-- TIPE SOAL -->

                            @if($paket->tipe_soal)

                                <div class="info-item">

                                    <i class="bi bi-grid-3x3-gap-fill"></i>

                                    <span>

                                        Tipe:

                                        <strong>

                                            {{ $paket->tipe_soal }}

                                        </strong>

                                    </span>

                                </div>

                            @endif


                            <!-- JUMLAH SOAL -->

                            <div class="info-item">

                                <i class="bi bi-list-ol"></i>

                                <span>

                                    @if($kategori === 'kecermatan')

                                        <strong>

                                            {{ $paket->jumlah_soal ?? 0 }}

                                        </strong>

                                        soal per kolom

                                    @else

                                        Jumlah soal:

                                        <strong>

                                            {{ $paket->jumlah_soal ?? 0 }}

                                        </strong>

                                    @endif

                                </span>

                            </div>


                        </div>


                        <div class="package-divider"></div>


                        <!-- =================================================
                             MULAI UJIAN
                        ================================================== -->

                        <a
                            href="{{ $routeMulaiUjian }}"
                            class="btn btn-start"
                        >

                            <i class="bi bi-play-fill me-1"></i>

                            Mulai Ujian

                            <i
                                class="bi bi-arrow-right ms-1"
                            ></i>

                        </a>


                    </div>


                </article>


            @endforeach


        </div>


        <!-- =====================================================
             SEARCH EMPTY
        ====================================================== -->

        <div
            class="search-empty mt-4"
            id="searchEmpty"
        >

            <i class="bi bi-search"></i>


            <strong>

                Paket soal tidak ditemukan

            </strong>


            <span>

                Coba gunakan kata pencarian yang berbeda.

            </span>

        </div>


    @else


        <!-- =====================================================
             EMPTY DATABASE
        ====================================================== -->

        <div class="empty-box">


            <div class="empty-icon">

                <i class="bi bi-inbox"></i>

            </div>


            <h4>

                Belum Ada Paket Soal

            </h4>


            <p>

                Saat ini belum ada paket ujian yang tersedia.
                Silakan cek kembali nanti.

            </p>


            <a
                href="{{ route('murid.dashboard') }}"
                class="btn btn-primary rounded-pill px-4"
            >

                <i class="bi bi-arrow-left me-1"></i>

                Kembali ke Dashboard

            </a>


        </div>

    @endif


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <div class="page-footer">

        ZAVIER Learning Center

        &copy;

        {{ date('Y') }}

        ·

        Platform Latihan Ujian

    </div>


</main>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const categoryButtons =
            document.querySelectorAll(
                '.category-btn'
            );


        const cards =
            document.querySelectorAll(
                '.package-card'
            );


        const searchInput =
            document.getElementById(
                'searchPackage'
            );


        const visibleCount =
            document.getElementById(
                'visibleCount'
            );


        const searchEmpty =
            document.getElementById(
                'searchEmpty'
            );


        const categoryTitle =
            document.getElementById(
                'categoryTitle'
            );


        const categoryDescription =
            document.getElementById(
                'categoryDescription'
            );


        const categoryTitleIcon =
            document.getElementById(
                'categoryTitleIcon'
            );


        /*
        |--------------------------------------------------------------------------
        | INFORMASI KATEGORI
        |--------------------------------------------------------------------------
        */

        const categoryInfo = {

            kecermatan: {

                title:
                    'Kecermatan',

                description:
                    'Latihan untuk meningkatkan kecepatan dan ketelitian dalam mengerjakan soal.',

                icon:
                    'bi-bullseye'

            },


            kepribadian: {

                title:
                    'Kepribadian',

                description:
                    'Latihan untuk mengenali karakter, sikap, dan kecenderungan kepribadian.',

                icon:
                    'bi-person-badge-fill'

            },


            kecerdasan: {

                title:
                    'Kecerdasan',

                description:
                    'Latihan kemampuan berpikir, logika, numerik, verbal, dan penalaran.',

                icon:
                    'bi-lightbulb-fill'

            },


            lainnya: {

                title:
                    'Paket Lainnya',

                description:
                    'Materi dan latihan lainnya yang tersedia di Zavier Learning Center.',

                icon:
                    'bi-grid-fill'

            }

        };


        /*
        |--------------------------------------------------------------------------
        | KATEGORI AWAL
        |--------------------------------------------------------------------------
        */

        let activeCategory =
            'kecermatan';


        /*
        |--------------------------------------------------------------------------
        | FILTER PAKET
        |--------------------------------------------------------------------------
        */

        function filterPackages() {

            const keyword =
                (
                    searchInput
                        ? searchInput.value
                        : ''
                )
                .toLowerCase()
                .trim();


            let count = 0;


            cards.forEach(
                function (card) {

                    const category =
                        card.dataset.category
                        || 'lainnya';


                    const searchText =
                        card.dataset.search
                        || '';


                    const categoryMatch =
                        category ===
                        activeCategory;


                    const searchMatch =
                        searchText.includes(
                            keyword
                        );


                    if (
                        categoryMatch &&
                        searchMatch
                    ) {

                        card.style.display =
                            'flex';

                        count++;

                    } else {

                        card.style.display =
                            'none';

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | JUMLAH PAKET
            |--------------------------------------------------------------------------
            */

            if (visibleCount) {

                visibleCount.textContent =
                    count;

            }


            /*
            |--------------------------------------------------------------------------
            | EMPTY SEARCH
            |--------------------------------------------------------------------------
            */

            if (searchEmpty) {

                if (count === 0) {

                    searchEmpty.style.display =
                        'block';

                } else {

                    searchEmpty.style.display =
                        'none';

                }

            }

        }


        /*
        |--------------------------------------------------------------------------
        | KLIK KATEGORI
        |--------------------------------------------------------------------------
        */

        categoryButtons.forEach(
            function (button) {

                button.addEventListener(
                    'click',
                    function () {


                        categoryButtons.forEach(
                            function (btn) {

                                btn.classList.remove(
                                    'active'
                                );

                            }
                        );


                        this.classList.add(
                            'active'
                        );


                        activeCategory =
                            this.dataset.category;


                        if (
                            categoryInfo[
                                activeCategory
                            ]
                        ) {

                            categoryTitle.textContent =
                                categoryInfo[
                                    activeCategory
                                ].title;


                            categoryDescription.textContent =
                                categoryInfo[
                                    activeCategory
                                ].description;


                            if (categoryTitleIcon) {

                                categoryTitleIcon.className =
                                    'bi ' +
                                    categoryInfo[
                                        activeCategory
                                    ].icon;

                            }

                        }


                        filterPackages();

                    }
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if (searchInput) {

            searchInput.addEventListener(
                'input',
                function () {

                    filterPackages();

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FILTER AWAL
        |--------------------------------------------------------------------------
        */

        filterPackages();

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