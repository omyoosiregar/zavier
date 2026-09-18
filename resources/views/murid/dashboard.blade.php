<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>ZAVIER Learning Center</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">


    <style>

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(37,99,235,.08),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 20%,
                    rgba(14,165,233,.07),
                    transparent 30%
                ),
                #f5f8fd;

            color: #172554;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .navbar-zavier {

            position: sticky;

            top: 0;

            z-index: 1000;

            height: 82px;

            background: rgba(
                255,
                255,
                255,
                .96
            );

            backdrop-filter: blur(15px);

            border-bottom:
                1px solid #e5eaf3;

            box-shadow:
                0 5px 25px
                rgba(30,60,100,.05);
        }


        .navbar-inner {

            max-width: 1500px;

            height: 100%;

            margin: auto;

            padding:
                0 30px;

            display: flex;

            align-items: center;

            justify-content: space-between;
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .brand-zavier {

            display: flex;

            align-items: center;

            gap: 12px;

            text-decoration: none;

            color: #123b82;
        }


        .brand-logo {

            width: 55px;

            height: 55px;

            object-fit: contain;

            border-radius: 13px;
        }


        .brand-text {

            line-height: 1.05;
        }


        .brand-name {

            font-size: 22px;

            font-weight: 900;

            letter-spacing: .5px;

            color: #123b82;
        }


        .brand-subtitle {

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 2px;

            color: #64748b;

            margin-top: 4px;
        }


        /* =====================================================
           NAVIGATION
        ===================================================== */

        .nav-menu {

            display: flex;

            align-items: center;

            gap: 5px;
        }


        .nav-item-zavier {

            display: flex;

            align-items: center;

            gap: 8px;

            padding:
                11px 17px;

            border-radius: 13px;

            text-decoration: none;

            color: #64748b;

            font-size: 14px;

            font-weight: 700;

            transition: .2s ease;
        }


        .nav-item-zavier:hover {

            color: #1769ff;

            background: #edf5ff;
        }


        .nav-item-zavier.active {

            color: #1769ff;

            background:
                linear-gradient(
                    135deg,
                    #edf5ff,
                    #e7f1ff
                );

            box-shadow:
                0 5px 15px
                rgba(37,99,235,.07);
        }


        /* =====================================================
           PROFILE
        ===================================================== */

        .profile-area {

            display: flex;

            align-items: center;

            gap: 10px;
        }


        .profile-circle {

            width: 44px;

            height: 44px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            color: white;

            font-weight: 900;

            font-size: 16px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #06b6d4
                );

            box-shadow:
                0 7px 18px
                rgba(37,99,235,.2);
        }


        .profile-name {

            font-size: 13px;

            font-weight: 800;

            color: #172554;
        }


        .profile-role {

            font-size: 11px;

            color: #94a3b8;
        }


        .logout-btn {

            width: 42px;

            height: 42px;

            border-radius: 12px;

            border:
                1px solid #fecaca;

            background: white;

            color: #ef4444;

            margin-left: 10px;

            transition: .2s ease;
        }


        .logout-btn:hover {

            background: #fff1f2;

            transform: translateY(-2px);
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .main-container {

            max-width: 1500px;

            margin: auto;

            padding:
                30px 30px 60px;
        }


        /* =====================================================
           HERO
        ===================================================== */

        .hero {

            position: relative;

            overflow: hidden;

            min-height: 330px;

            border-radius: 28px;

            padding:
                48px 55px;

            color: white;

            background:
                linear-gradient(
                    115deg,
                    #123b82 0%,
                    #1769e8 45%,
                    #0ea5c9 100%
                );

            box-shadow:
                0 20px 50px
                rgba(23,105,232,.20);

            margin-bottom: 35px;
        }


        .hero::before {

            content: "";

            position: absolute;

            width: 500px;

            height: 500px;

            border-radius: 50%;

            right: -160px;

            top: -250px;

            background:
                rgba(255,255,255,.08);
        }


        .hero::after {

            content: "";

            position: absolute;

            width: 300px;

            height: 300px;

            border-radius: 50%;

            right: 100px;

            bottom: -220px;

            background:
                rgba(255,255,255,.06);
        }


        .hero-content {

            position: relative;

            z-index: 2;

            max-width: 760px;
        }


        .hero-badge {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding:
                8px 15px;

            border-radius: 30px;

            background:
                rgba(255,255,255,.13);

            border:
                1px solid
                rgba(255,255,255,.22);

            font-size: 11px;

            font-weight: 800;

            letter-spacing: 1.3px;

            margin-bottom: 18px;
        }


        .hero h1 {

            font-size: 38px;

            line-height: 1.15;

            font-weight: 900;

            margin-bottom: 15px;
        }


        .hero h1 span {

            color: #bff4ff;
        }


        .hero-description {

            font-size: 16px;

            line-height: 1.8;

            color:
                rgba(255,255,255,.88);

            max-width: 680px;

            margin-bottom: 25px;
        }


        .hero-buttons {

            display: flex;

            flex-wrap: wrap;

            gap: 12px;
        }


        .hero-btn {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding:
                12px 20px;

            border-radius: 12px;

            text-decoration: none;

            font-weight: 800;

            font-size: 13px;

            transition: .2s ease;
        }


        .hero-btn-primary {

            color: #1769ff;

            background: white;
        }


        .hero-btn-primary:hover {

            color: #1455c5;

            transform: translateY(-2px);

            box-shadow:
                0 8px 20px
                rgba(0,0,0,.12);
        }


        .hero-btn-outline {

            color: white;

            border:
                1px solid
                rgba(255,255,255,.35);

            background:
                rgba(255,255,255,.08);
        }


        .hero-btn-outline:hover {

            color: white;

            background:
                rgba(255,255,255,.17);
        }


        .hero-decoration {

            position: absolute;

            right: 80px;

            bottom: 25px;

            font-size: 150px;

            color: white;

            opacity: .08;

            z-index: 1;
        }


        /* =====================================================
           SECTION HEADER
        ===================================================== */

        .section-header {

            margin-bottom: 22px;
        }


        .section-label {

            color: #2563eb;

            font-size: 11px;

            font-weight: 900;

            letter-spacing: 2px;

            text-transform: uppercase;

            margin-bottom: 5px;
        }


        .section-title {

            font-size: 27px;

            font-weight: 900;

            color: #102f6b;

            margin: 0 0 5px;
        }


        .section-description {

            color: #7890b0;

            font-size: 14px;

            margin: 0;
        }


        /* =====================================================
           FOTO SLIDER LATIHAN
        ===================================================== */

        .training-slider-wrapper {

            position: relative;

            width: 100%;

            overflow: hidden;

            border-radius: 25px;

            background: white;

            border:
                1px solid #e7edf6;

            box-shadow:
                0 12px 35px
                rgba(30,60,100,.08);
        }


        .training-slider {

            display: flex;

            width: 100%;

            overflow-x: auto;

            overflow-y: hidden;

            scroll-snap-type: x mandatory;

            scroll-behavior: smooth;

            -webkit-overflow-scrolling: touch;

            scrollbar-width: none;
        }


        .training-slider::-webkit-scrollbar {

            display: none;
        }


        .training-slide {

            position: relative;

            flex:
                0 0 100%;

            width: 100%;

            height: 520px;

            scroll-snap-align: center;

            scroll-snap-stop: always;

            overflow: hidden;

            background: #eef4fb;
        }


        .training-slide img {

            width: 100%;

            height: 100%;

            display: block;

            object-fit: cover;

            object-position: center;

            user-select: none;

            -webkit-user-drag: none;
        }


        /* =====================================================
           SLIDER OVERLAY
        ===================================================== */

        .training-slide::after {

            content: "";

            position: absolute;

            inset: 0;

            pointer-events: none;

            background:
                linear-gradient(
                    to bottom,
                    rgba(0,0,0,0) 60%,
                    rgba(0,0,0,.12) 100%
                );
        }


        /* =====================================================
           SLIDER INDICATOR
        ===================================================== */

        .training-slider-dots {

            position: absolute;

            left: 50%;

            bottom: 18px;

            transform: translateX(-50%);

            z-index: 10;

            display: flex;

            align-items: center;

            gap: 8px;

            padding:
                8px 13px;

            border-radius: 30px;

            background:
                rgba(255,255,255,.88);

            backdrop-filter: blur(10px);

            box-shadow:
                0 6px 20px
                rgba(0,0,0,.10);
        }


        .training-slider-dot {

            width: 8px;

            height: 8px;

            border-radius: 50%;

            background: #cbd5e1;
        }


        .training-slider-dot.active {

            width: 25px;

            border-radius: 20px;

            background:
                linear-gradient(
                    90deg,
                    #2563eb,
                    #06b6d4
                );
        }


        /* =====================================================
           SLIDER ARROWS
        ===================================================== */

        .training-slider-arrow {

            position: absolute;

            top: 50%;

            transform: translateY(-50%);

            z-index: 10;

            width: 45px;

            height: 45px;

            border: 0;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #2563eb;

            background:
                rgba(255,255,255,.90);

            backdrop-filter: blur(10px);

            box-shadow:
                0 8px 25px
                rgba(0,0,0,.12);

            font-size: 19px;

            transition: .2s ease;
        }


        .training-slider-arrow:hover {

            background: white;

            transform:
                translateY(-50%)
                scale(1.07);

            box-shadow:
                0 10px 30px
                rgba(0,0,0,.17);
        }


        .training-slider-prev {

            left: 20px;
        }


        .training-slider-next {

            right: 20px;
        }


        /* =====================================================
           ZAVIER VALUES
        ===================================================== */

        .value-section {

            margin-top: 45px;

            margin-bottom: 40px;
        }


        .value-box {

            height: 100%;

            padding: 28px;

            border-radius: 21px;

            background: white;

            border:
                1px solid #e7edf6;

            box-shadow:
                0 10px 30px
                rgba(30,60,100,.05);
        }


        .value-header {

            display: flex;

            align-items: center;

            gap: 13px;

            margin-bottom: 20px;
        }


        .value-icon {

            width: 48px;

            height: 48px;

            border-radius: 14px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: white;

            font-size: 20px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #06b6d4
                );
        }


        .value-title {

            font-size: 20px;

            font-weight: 900;

            color: #123b82;
        }


        .value-subtitle {

            font-size: 11px;

            color: #94a3b8;
        }


        .zavier-letters {

            display: grid;

            gap: 11px;
        }


        .letter-row {

            display: flex;

            align-items: center;

            gap: 12px;

            padding:
                9px 11px;

            border-radius: 10px;

            background: #f8faff;
        }


        .letter {

            width: 31px;

            height: 31px;

            flex-shrink: 0;

            border-radius: 9px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: white;

            font-size: 13px;

            font-weight: 900;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #0ea5e9
                );
        }


        .letter-title {

            font-size: 13px;

            font-weight: 800;

            color: #29456f;
        }


        .letter-description {

            font-size: 11px;

            color: #8b9ab1;
        }


        /* =====================================================
           VISI MISI
        ===================================================== */

        .vision-card {

            height: 100%;

            padding: 28px;

            border-radius: 21px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #123b82,
                    #1769e8
                );

            box-shadow:
                0 15px 35px
                rgba(18,59,130,.15);
        }


        .vision-icon {

            width: 50px;

            height: 50px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 14px;

            background:
                rgba(255,255,255,.13);

            font-size: 22px;

            margin-bottom: 18px;
        }


        .vision-title {

            font-size: 20px;

            font-weight: 900;

            margin-bottom: 10px;
        }


        .vision-text {

            color:
                rgba(255,255,255,.84);

            font-size: 13px;

            line-height: 1.8;

            margin-bottom: 0;
        }


        .mission-card {

            height: 100%;

            padding: 28px;

            border-radius: 21px;

            background: white;

            border:
                1px solid #e7edf6;

            box-shadow:
                0 10px 30px
                rgba(30,60,100,.05);
        }


        .mission-title {

            font-size: 20px;

            font-weight: 900;

            color: #123b82;

            margin-bottom: 18px;
        }


        .mission-item {

            display: flex;

            gap: 12px;

            margin-bottom: 15px;

            color: #64748b;

            font-size: 13px;

            line-height: 1.6;
        }


        .mission-number {

            width: 28px;

            height: 28px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 8px;

            background: #edf5ff;

            color: #2563eb;

            font-weight: 900;

            font-size: 11px;
        }


        /* =====================================================
           ABOUT ZAVIER
        ===================================================== */

        .about-section {

            margin-top: 45px;
        }


        .about-card {

            position: relative;

            overflow: hidden;

            padding: 35px;

            border-radius: 23px;

            background: white;

            border:
                1px solid #e7edf6;

            box-shadow:
                0 10px 35px
                rgba(30,60,100,.06);
        }


        .about-card::after {

            content: "";

            position: absolute;

            width: 250px;

            height: 250px;

            border-radius: 50%;

            right: -100px;

            top: -120px;

            background:
                rgba(37,99,235,.05);
        }


        .about-content {

            position: relative;

            z-index: 2;

            max-width: 900px;
        }


        .about-title {

            color: #123b82;

            font-size: 25px;

            font-weight: 900;

            margin-bottom: 12px;
        }


        .about-text {

            color: #7183a0;

            font-size: 14px;

            line-height: 1.9;

            margin-bottom: 0;
        }


        .about-highlight {

            margin-top: 22px;

            display: inline-flex;

            align-items: center;

            gap: 10px;

            padding:
                11px 16px;

            border-radius: 12px;

            background: #f0f7ff;

            color: #2563eb;

            font-size: 12px;

            font-weight: 800;
        }


        /* =====================================================
           CTA
        ===================================================== */

        .cta {

            position: relative;

            overflow: hidden;

            margin-top: 40px;

            padding:
                30px 35px;

            border-radius: 21px;

            background:
                linear-gradient(
                    110deg,
                    #2563eb,
                    #06b6d4
                );

            color: white;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;
        }


        .cta-content {

            position: relative;

            z-index: 2;
        }


        .cta-title {

            font-size: 21px;

            font-weight: 900;

            margin-bottom: 5px;
        }


        .cta-text {

            margin: 0;

            color:
                rgba(255,255,255,.85);

            font-size: 13px;
        }


        .cta-button {

            position: relative;

            z-index: 2;

            flex-shrink: 0;

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding:
                12px 20px;

            border-radius: 11px;

            background: white;

            color: #1769ff;

            text-decoration: none;

            font-weight: 900;

            font-size: 13px;

            transition: .2s ease;
        }


        .cta-button:hover {

            color: #1455c5;

            transform:
                translateY(-2px);
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        footer {

            text-align: center;

            padding:
                35px 10px 0;

            color: #94a3b8;

            font-size: 11px;

            line-height: 1.8;
        }


        .footer-brand {

            color: #2563eb;

            font-weight: 900;

            letter-spacing: 1px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {

            .nav-menu {

                gap: 0;
            }

            .nav-item-zavier {

                padding:
                    10px 11px;
            }

            .hero-decoration {

                right: 20px;

                font-size: 110px;
            }

            .training-slide {

                height: 450px;
            }
        }


        @media (max-width: 991px) {

            .navbar-inner {

                padding:
                    0 18px;
            }

            .nav-menu {

                display: none;
            }

            .main-container {

                padding:
                    22px 18px 50px;
            }

            .hero {

                padding:
                    35px 30px;
            }

            .hero h1 {

                font-size: 30px;
            }

            .hero-decoration {

                opacity: .05;
            }

            .training-slide {

                height: 420px;
            }
        }


        @media (max-width: 576px) {

            .navbar-zavier {

                height: 70px;
            }

            .brand-logo {

                width: 45px;

                height: 45px;
            }

            .brand-name {

                font-size: 18px;
            }

            .brand-subtitle {

                font-size: 8px;
            }

            .profile-area {

                gap: 5px;
            }

            .profile-name,
            .profile-role {

                display: none;
            }

            .logout-btn {

                margin-left: 3px;
            }

            .hero {

                min-height: auto;

                padding:
                    30px 23px;

                border-radius: 20px;
            }

            .hero h1 {

                font-size: 26px;
            }

            .hero-description {

                font-size: 13px;
            }

            .hero-decoration {

                display: none;
            }

            .section-title {

                font-size: 23px;
            }


            /* FOTO DI HP */

            .training-slider-wrapper {

                border-radius: 20px;
            }


            .training-slide {

                height: 330px;

                flex:
                    0 0 100%;
            }


            .training-slide img {

                object-fit: cover;
            }


            .training-slider-arrow {

                width: 38px;

                height: 38px;

                font-size: 16px;
            }


            .training-slider-prev {

                left: 12px;
            }


            .training-slider-next {

                right: 12px;
            }


            .training-slider-dots {

                bottom: 12px;

                padding:
                    7px 10px;
            }


            .cta {

                flex-direction: column;

                align-items: flex-start;
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
     MAIN
========================================================= -->

<main class="main-container">


    <!-- =====================================================
         HERO
    ====================================================== -->

    <section class="hero">

        <div class="hero-content">


            <div class="hero-badge">

                <i class="bi bi-stars"></i>

                ZAVIER LEARNING CENTER

            </div>


            <h1>

                Awal Baru yang
                <span>Cemerlang</span>
                Menuju Kesuksesan

            </h1>


            <p class="hero-description">

                Selamat datang di ZAVIER Learning Center,
                tempat belajar untuk tumbuh, berkembang,
                dan mempersiapkan masa depan dengan lebih
                percaya diri.

            </p>


            <div class="hero-buttons">

                <a
                    href="#latihan"
                    class="hero-btn hero-btn-primary"
                >

                    <i class="bi bi-rocket-takeoff-fill"></i>

                    Mulai Latihan

                </a>


                <a
                    href="#tentang"
                    class="hero-btn hero-btn-outline"
                >

                    <i class="bi bi-info-circle"></i>

                    Tentang ZAVIER

                </a>

            </div>

        </div>


        <i
            class="bi bi-mortarboard-fill hero-decoration">
        </i>

    </section>


    <!-- =====================================================
         PILIHAN LATIHAN
         SEKARANG HANYA FOTO
    ====================================================== -->

    <section id="latihan">

        <!-- =================================================
             FOTO SLIDER
        ================================================== -->

        <div class="training-slider-wrapper">


            <!-- TOMBOL KIRI -->

            <button
                type="button"
                class="training-slider-arrow training-slider-prev"
                onclick="geserFoto(-1)"
                aria-label="Foto sebelumnya"
            >

                <i class="bi bi-chevron-left"></i>

            </button>


            <!-- FOTO -->

            <div
                class="training-slider"
                id="trainingSlider"
            >


                <!-- IMAGE 1 -->

                <div class="training-slide">

                    <img
                        src="{{ asset('images/image 1.png') }}"
                        alt="Program Pembelajaran ZAVIER 1"
                        draggable="false"
                    >

                </div>


                <!-- IMAGE 2 -->

                <div class="training-slide">

                    <img
                        src="{{ asset('images/image 2.png') }}"
                        alt="Program Pembelajaran ZAVIER 2"
                        draggable="false"
                    >

                </div>


                <!-- IMAGE 3 -->

                <div class="training-slide">

                    <img
                        src="{{ asset('images/image 3.png') }}"
                        alt="Program Pembelajaran ZAVIER 3"
                        draggable="false"
                    >

                </div>


                <!-- IMAGE 4 -->

                <div class="training-slide">

                    <img
                        src="{{ asset('images/image 4.png') }}"
                        alt="Program Pembelajaran ZAVIER 4"
                        draggable="false"
                    >

                </div>


                <!-- IMAGE 5 -->

                <div class="training-slide">

                    <img
                        src="{{ asset('images/image 5.png') }}"
                        alt="Program Pembelajaran ZAVIER 5"
                        draggable="false"
                    >

                </div>


            </div>


            <!-- TOMBOL KANAN -->

            <button
                type="button"
                class="training-slider-arrow training-slider-next"
                onclick="geserFoto(1)"
                aria-label="Foto berikutnya"
            >

                <i class="bi bi-chevron-right"></i>

            </button>


            <!-- INDIKATOR -->

            <div class="training-slider-dots">

                <span
                    class="training-slider-dot active"
                    data-index="0"
                ></span>

                <span
                    class="training-slider-dot"
                    data-index="1"
                ></span>

                <span
                    class="training-slider-dot"
                    data-index="2"
                ></span>

                <span
                    class="training-slider-dot"
                    data-index="3"
                ></span>

                <span
                    class="training-slider-dot"
                    data-index="4"
                ></span>

            </div>


        </div>

    </section>


    <!-- =====================================================
         ZAVIER VALUES
    ====================================================== -->

    <section
        id="tentang"
        class="value-section"
    >

        <div class="section-header">

            <div class="section-label">
                Tentang Kami
            </div>

            <h2 class="section-title">
                Mengenal ZAVIER
            </h2>

            <p class="section-description">

                Nilai yang menjadi dasar perjalanan
                pembelajaran di ZAVIER Learning Center.

            </p>

        </div>


        <div class="row g-4">


            <!-- ZAVIER MEANING -->

            <div class="col-lg-6">

                <div class="value-box">


                    <div class="value-header">

                        <div class="value-icon">

                            <i class="bi bi-stars"></i>

                        </div>


                        <div>

                            <div class="value-title">
                                Z.A.V.I.E.R
                            </div>

                            <div class="value-subtitle">
                                Nilai Dasar Pembelajaran
                            </div>

                        </div>

                    </div>


                    <div class="zavier-letters">


                        <div class="letter-row">

                            <div class="letter">
                                Z
                            </div>

                            <div>

                                <div class="letter-title">
                                    Zeal
                                </div>

                                <div class="letter-description">
                                    Semangat untuk terus belajar dan berkembang.
                                </div>

                            </div>

                        </div>


                        <div class="letter-row">

                            <div class="letter">
                                A
                            </div>

                            <div>

                                <div class="letter-title">
                                    Aspiration
                                </div>

                                <div class="letter-description">
                                    Cita-cita yang menjadi arah perjalanan.
                                </div>

                            </div>

                        </div>


                        <div class="letter-row">

                            <div class="letter">
                                V
                            </div>

                            <div>

                                <div class="letter-title">
                                    Victory
                                </div>

                                <div class="letter-description">
                                    Kemenangan yang lahir dari proses dan perjuangan.
                                </div>

                            </div>

                        </div>


                        <div class="letter-row">

                            <div class="letter">
                                I
                            </div>

                            <div>

                                <div class="letter-title">
                                    Integrity
                                </div>

                                <div class="letter-description">
                                    Integritas sebagai fondasi dalam setiap langkah.
                                </div>

                            </div>

                        </div>


                        <div class="letter-row">

                            <div class="letter">
                                E
                            </div>

                            <div>

                                <div class="letter-title">
                                    Excellence
                                </div>

                                <div class="letter-description">
                                    Keunggulan melalui usaha terbaik setiap hari.
                                </div>

                            </div>

                        </div>


                        <div class="letter-row">

                            <div class="letter">
                                R
                            </div>

                            <div>

                                <div class="letter-title">
                                    Resilience
                                </div>

                                <div class="letter-description">
                                    Ketangguhan untuk bangkit dan terus melangkah.
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>


            <!-- DESCRIPTION -->

            <div class="col-lg-6">

                <div class="about-card h-100">


                    <div class="about-content">

                        <div class="about-title">

                            ZAVIER
                            <span style="color:#2563eb;">
                                Learning Center
                            </span>

                        </div>


                        <p class="about-text">

                            ZAVIER Learning Center hadir sebagai
                            ruang belajar yang mendorong setiap
                            peserta untuk mengenali potensi,
                            membangun kepercayaan diri dan
                            mempersiapkan diri menghadapi
                            berbagai tantangan akademik maupun
                            pengembangan pribadi.

                        </p>


                        <p class="about-text mt-3">

                            Kami percaya bahwa keberhasilan
                            bukan hanya tentang mendapatkan
                            hasil terbaik, tetapi juga tentang
                            membangun proses belajar yang
                            disiplin, konsisten dan bermakna.

                        </p>


                        <div class="about-highlight">

                            <i class="bi bi-check-circle-fill"></i>

                            Belajar • Bertumbuh • Berkembang • Berprestasi

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         VISI MISI
    ====================================================== -->

    <section
        id="visi-misi"
        style="margin-top:45px;"
    >

        <div class="section-header">

            <div class="section-label">
                Arah & Komitmen
            </div>

            <h2 class="section-title">
                Visi & Misi ZAVIER
            </h2>

            <p class="section-description">

                Menjadi bagian dari perjalanan peserta
                menuju masa depan yang lebih baik.

            </p>

        </div>


        <div class="row g-4">


            <!-- VISI -->

            <div class="col-lg-5">

                <div class="vision-card">


                    <div class="vision-icon">

                        <i class="bi bi-eye"></i>

                    </div>


                    <div class="vision-title">

                        Visi

                    </div>


                    <p class="vision-text">

                        Menjadi pusat pembelajaran yang
                        membentuk pribadi berpengetahuan,
                        berkarakter, percaya diri dan tangguh
                        dalam menghadapi masa depan melalui
                        proses belajar yang adaptif,
                        terarah dan berkelanjutan.

                    </p>

                </div>

            </div>


            <!-- MISI -->

            <div class="col-lg-7">

                <div class="mission-card">


                    <div class="mission-title">

                        Misi Kami

                    </div>


                    <div class="mission-item">

                        <div class="mission-number">
                            01
                        </div>

                        <div>

                            Menghadirkan pembelajaran yang
                            terstruktur, mudah dipahami dan
                            relevan dengan kebutuhan peserta.

                        </div>

                    </div>


                    <div class="mission-item">

                        <div class="mission-number">
                            02
                        </div>

                        <div>

                            Membangun budaya belajar yang
                            disiplin, konsisten, aktif dan
                            berorientasi pada perkembangan.

                        </div>

                    </div>


                    <div class="mission-item">

                        <div class="mission-number">
                            03
                        </div>

                        <div>

                            Mengembangkan kemampuan berpikir,
                            karakter dan kepercayaan diri
                            setiap peserta secara seimbang.

                        </div>

                    </div>


                    <div class="mission-item">

                        <div class="mission-number">
                            04
                        </div>

                        <div>

                            Memanfaatkan teknologi sebagai
                            sarana pembelajaran yang modern,
                            interaktif dan mudah diakses.

                        </div>

                    </div>


                    <div class="mission-item mb-0">

                        <div class="mission-number">
                            05
                        </div>

                        <div>

                            Mendorong setiap peserta untuk
                            memiliki keberanian bermimpi,
                            ketangguhan menghadapi proses dan
                            kesiapan meraih peluang masa depan.

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CTA
    ====================================================== -->

    <section class="cta">


        <div class="cta-content">

            <div class="cta-title">

                Siap Memulai Perjalanan Belajar?

            </div>


            <p class="cta-text">

                Pilih latihan yang ingin Anda pelajari
                dan mulai tingkatkan kemampuan Anda hari ini.

            </p>

        </div>


        <a
            href="{{ route('murid.paket-soal') }}"
            class="cta-button"
        >

            <i class="bi bi-play-fill"></i>

            Mulai Latihan

            <i class="bi bi-arrow-right"></i>

        </a>

    </section>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <footer>

        <div class="footer-brand">
            ZAVIER LEARNING CENTER
        </div>

        Awal Baru yang Cemerlang Menuju Kesuksesan.

        <br>

        &copy; {{ date('Y') }}
        ZAVIER Learning Center.
        Semua hak dilindungi.

    </footer>


</main>


<!-- =========================================================
     BOOTSTRAP JS
========================================================= -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<!-- =========================================================
     FOTO SLIDER SCRIPT
========================================================= -->

<script>

    const trainingSlider =
        document.getElementById('trainingSlider');

    const trainingDots =
        document.querySelectorAll(
            '.training-slider-dot'
        );


    let fotoSekarang = 0;

    const jumlahFoto = 5;


    function geserFoto(arah) {

        fotoSekarang += arah;


        if (fotoSekarang < 0) {

            fotoSekarang =
                jumlahFoto - 1;

        }


        if (fotoSekarang >= jumlahFoto) {

            fotoSekarang = 0;

        }


        trainingSlider.scrollTo({

            left:
                fotoSekarang *
                trainingSlider.clientWidth,

            behavior: 'smooth'

        });


        updateDot();

    }


    function updateDot() {

        trainingDots.forEach(
            function(dot, index) {

                dot.classList.toggle(
                    'active',
                    index === fotoSekarang
                );

            }
        );

    }


    trainingSlider.addEventListener(
        'scroll',
        function() {

            const posisi =
                trainingSlider.scrollLeft;

            const lebar =
                trainingSlider.clientWidth;


            if (lebar <= 0) {
                return;
            }


            fotoSekarang =
                Math.round(
                    posisi / lebar
                );


            updateDot();

        }
    );


    trainingDots.forEach(
        function(dot) {

            dot.addEventListener(
                'click',
                function() {

                    const index =
                        Number(
                            dot.dataset.index
                        );


                    fotoSekarang =
                        index;


                    trainingSlider.scrollTo({

                        left:
                            index *
                            trainingSlider.clientWidth,

                        behavior: 'smooth'

                    });


                    updateDot();

                }
            );

        }
    );


    /* =====================================================
       DRAG MOUSE UNTUK DESKTOP
    ===================================================== */

    let sedangDrag = false;

    let posisiAwal = 0;

    let scrollAwal = 0;


    trainingSlider.addEventListener(
        'mousedown',
        function(e) {

            sedangDrag = true;

            posisiAwal = e.pageX;

            scrollAwal =
                trainingSlider.scrollLeft;

            trainingSlider.style.cursor =
                'grabbing';

        }
    );


    trainingSlider.addEventListener(
        'mouseleave',
        function() {

            sedangDrag = false;

            trainingSlider.style.cursor =
                'grab';

        }
    );


    trainingSlider.addEventListener(
        'mouseup',
        function() {

            sedangDrag = false;

            trainingSlider.style.cursor =
                'grab';

        }
    );


    trainingSlider.addEventListener(
        'mousemove',
        function(e) {

            if (!sedangDrag) {
                return;
            }


            e.preventDefault();


            const jarak =
                e.pageX - posisiAwal;


            trainingSlider.scrollLeft =
                scrollAwal - jarak;

        }
    );


    trainingSlider.style.cursor =
        'grab';


</script>


</body>

</html>