@extends('layouts.admin-zavier')

@section('title', 'Dashboard Super Admin')


@section('content')


<style>

    /* =====================================================
       DASHBOARD HERO
    ===================================================== */

    .admin-hero {

        position: relative;

        overflow: hidden;

        min-height: 330px;

        padding:
            48px 55px;

        margin-bottom: 35px;

        border-radius: 28px;

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

    }


    .admin-hero::before {

        content: "";

        position: absolute;

        width: 500px;
        height: 500px;

        right: -160px;
        top: -250px;

        border-radius: 50%;

        background:
            rgba(255,255,255,.08);

    }


    .admin-hero::after {

        content: "";

        position: absolute;

        width: 320px;
        height: 320px;

        right: 90px;
        bottom: -230px;

        border-radius: 50%;

        background:
            rgba(255,255,255,.06);

    }


    .admin-hero-content {

        position: relative;

        z-index: 3;

        max-width: 800px;

    }


    .admin-hero-badge {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        padding:
            8px 15px;

        margin-bottom: 18px;

        border-radius: 30px;

        background:
            rgba(255,255,255,.13);

        border:
            1px solid
            rgba(255,255,255,.20);

        font-size: 11px;

        font-weight: 800;

        letter-spacing: 1.2px;

    }


    .admin-hero h1 {

        margin-bottom: 14px;

        font-size: 40px;

        line-height: 1.15;

        font-weight: 900;

    }


    .admin-hero h1 span {

        color: #bff4ff;

    }


    .admin-hero-description {

        max-width: 700px;

        margin-bottom: 25px;

        color:
            rgba(255,255,255,.86);

        font-size: 15px;

        line-height: 1.8;

    }


    .admin-hero-buttons {

        display: flex;

        flex-wrap: wrap;

        gap: 12px;

    }


    .admin-hero-button {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        padding:
            12px 20px;

        border-radius: 12px;

        text-decoration: none;

        font-size: 13px;

        font-weight: 800;

        transition: .2s ease;

    }


    .admin-hero-button.primary {

        color: #1769ff;

        background: white;

    }


    .admin-hero-button.primary:hover {

        color: #1455c5;

        transform:
            translateY(-2px);

        box-shadow:
            0 8px 20px
            rgba(0,0,0,.13);

    }


    .admin-hero-button.outline {

        color: white;

        border:
            1px solid
            rgba(255,255,255,.30);

        background:
            rgba(255,255,255,.08);

    }


    .admin-hero-button.outline:hover {

        color: white;

        background:
            rgba(255,255,255,.16);

    }


    .admin-hero-decoration {

        position: absolute;

        right: 70px;
        bottom: 20px;

        z-index: 1;

        font-size: 150px;

        color: white;

        opacity: .08;

    }


    /* =====================================================
       SECTION HEADER
    ===================================================== */

    .dashboard-section-header {

        margin-bottom: 20px;

    }


    .dashboard-section-label {

        color: #2563eb;

        font-size: 10px;

        font-weight: 900;

        letter-spacing: 2px;

        text-transform: uppercase;

        margin-bottom: 5px;

    }


    .dashboard-section-title {

        margin: 0 0 5px;

        color: #123b82;

        font-size: 27px;

        font-weight: 900;

    }


    .dashboard-section-description {

        margin: 0;

        color: #7890b0;

        font-size: 13px;

    }


    /* =====================================================
       STAT CARD
    ===================================================== */

    .admin-stat-card {

        position: relative;

        height: 100%;

        overflow: hidden;

        padding: 24px;

        border-radius: 21px;

        background: white;

        border:
            1px solid #e7edf6;

        box-shadow:
            0 10px 30px
            rgba(30,60,100,.05);

        transition: .2s ease;

    }


    .admin-stat-card:hover {

        transform:
            translateY(-4px);

        box-shadow:
            0 16px 35px
            rgba(30,60,100,.09);

    }


    .admin-stat-icon {

        width: 49px;
        height: 49px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 14px;

        color: white;

        font-size: 20px;

        background:
            linear-gradient(
                135deg,
                #2563eb,
                #06b6d4
            );

        margin-bottom: 18px;

    }


    .admin-stat-label {

        color: #7890b0;

        font-size: 12px;

        font-weight: 600;

    }


    .admin-stat-number {

        margin-top: 2px;

        color: #123b82;

        font-size: 31px;

        line-height: 1;

        font-weight: 900;

    }


    .admin-stat-link {

        display: inline-block;

        margin-top: 13px;

        color: #2563eb;

        text-decoration: none;

        font-size: 11px;

        font-weight: 800;

    }


    .admin-stat-link:hover {

        color: #123b82;

    }


    /* =====================================================
       QUICK ACCESS
    ===================================================== */

    .quick-card {

        display: block;

        height: 100%;

        padding: 24px;

        border-radius: 20px;

        border:
            1px solid #e7edf6;

        background: white;

        text-decoration: none;

        transition: .2s ease;

        box-shadow:
            0 8px 25px
            rgba(30,60,100,.045);

    }


    .quick-card:hover {

        transform:
            translateY(-4px);

        border-color:
            #cfe0ff;

        box-shadow:
            0 15px 35px
            rgba(37,99,235,.09);

    }


    .quick-icon {

        width: 50px;
        height: 50px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 15px;

        color: #2563eb;

        background: #edf5ff;

        font-size: 21px;

        margin-bottom: 17px;

    }


    .quick-title {

        color: #123b82;

        font-size: 16px;

        font-weight: 900;

        margin-bottom: 5px;

    }


    .quick-description {

        color: #8b9ab1;

        font-size: 12px;

        line-height: 1.7;

    }


    .quick-arrow {

        margin-top: 14px;

        color: #2563eb;

        font-size: 12px;

        font-weight: 800;

    }


    /* =====================================================
       ADMIN INFORMATION
    ===================================================== */

    .admin-info-card {

        height: 100%;

        padding: 28px;

        border-radius: 22px;

        background: white;

        border:
            1px solid #e7edf6;

        box-shadow:
            0 10px 30px
            rgba(30,60,100,.05);

    }


    .admin-info-title {

        color: #123b82;

        font-size: 20px;

        font-weight: 900;

        margin-bottom: 20px;

    }


    .admin-info-item {

        display: flex;

        align-items: flex-start;

        gap: 13px;

        padding:
            13px 0;

        border-bottom:
            1px solid #eef2f7;

    }


    .admin-info-item:last-child {

        border-bottom: 0;

    }


    .admin-info-icon {

        width: 39px;
        height: 39px;

        flex-shrink: 0;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 11px;

        color: #2563eb;

        background: #edf5ff;

    }


    .admin-info-item strong {

        display: block;

        color: #29456f;

        font-size: 13px;

    }


    .admin-info-item span {

        display: block;

        margin-top: 3px;

        color: #8b9ab1;

        font-size: 11px;

        line-height: 1.6;

    }


    /* =====================================================
       BOTTOM CTA
    ===================================================== */

    .admin-cta {

        position: relative;

        overflow: hidden;

        margin-top: 35px;

        padding:
            28px 32px;

        border-radius: 21px;

        color: white;

        background:
            linear-gradient(
                110deg,
                #2563eb,
                #06b6d4
            );

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

    }


    .admin-cta-title {

        font-size: 20px;

        font-weight: 900;

        margin-bottom: 5px;

    }


    .admin-cta-text {

        margin: 0;

        color:
            rgba(255,255,255,.82);

        font-size: 12px;

    }


    .admin-cta-button {

        display: inline-flex;

        align-items: center;

        gap: 8px;

        flex-shrink: 0;

        padding:
            12px 19px;

        border-radius: 11px;

        background: white;

        color: #1769ff;

        text-decoration: none;

        font-size: 12px;

        font-weight: 900;

        transition: .2s ease;

    }


    .admin-cta-button:hover {

        color: #1455c5;

        transform:
            translateY(-2px);

    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 991px) {

        .admin-hero {

            padding:
                38px 32px;

        }

        .admin-hero h1 {

            font-size: 32px;

        }

        .admin-hero-decoration {

            right: 20px;

            font-size: 110px;

        }

    }


    @media (max-width: 576px) {

        .admin-hero {

            min-height: auto;

            padding:
                30px 23px;

            border-radius: 21px;

        }

        .admin-hero h1 {

            font-size: 27px;

        }

        .admin-hero-description {

            font-size: 13px;

        }

        .admin-hero-decoration {

            display: none;

        }

        .dashboard-section-title {

            font-size: 23px;

        }

        .admin-cta {

            flex-direction: column;

            align-items: flex-start;

        }

    }

</style>


{{-- =========================================================
     HERO
========================================================= --}}

<section class="admin-hero">


    <div class="admin-hero-content">


        <div class="admin-hero-badge">

            <i class="bi bi-stars"></i>

            ZAVIER LEARNING CENTER

        </div>


        <h1>

            Selamat Datang,
            <span>Super Admin</span>

        </h1>


        <p class="admin-hero-description">

            Kelola seluruh kebutuhan ZAVIER Learning Center
            mulai dari bank soal, paket ujian, mentor,
            hingga data murid dalam satu panel administrasi
            yang sederhana dan terstruktur.

        </p>


        <div class="admin-hero-buttons">


            <a
                href="{{ url('/admin/paket-ujian') }}"
                class="admin-hero-button primary"
            >

                <i class="bi bi-rocket-takeoff-fill"></i>

                Kelola Paket Ujian

            </a>


            <a
                href="{{ route('admin.bank-soal.index') }}"
                class="admin-hero-button outline"
            >

                <i class="bi bi-journal-text"></i>

                Kelola Bank Soal

            </a>


        </div>

    </div>


    <i
        class="bi bi-speedometer2 admin-hero-decoration">
    </i>


</section>


{{-- =========================================================
     STATISTIK
========================================================= --}}

<section>


    <div class="dashboard-section-header">

        <div class="dashboard-section-label">
            Ringkasan Sistem
        </div>

        <h2 class="dashboard-section-title">
            Statistik ZAVIER
        </h2>

        <p class="dashboard-section-description">
            Ringkasan data utama yang dapat dipantau oleh Super Admin.
        </p>

    </div>


    <div class="row g-4 mb-5">


        {{-- MENTOR --}}

        <div class="col-6 col-xl-3">

            <div class="admin-stat-card">

                <div class="admin-stat-icon">

                    <i class="bi bi-person-workspace"></i>

                </div>

                <div class="admin-stat-label">
                    Total Mentor
                </div>

                <div class="admin-stat-number">
                    {{ $jumlahMentor }}
                </div>

                <a
                    href="{{ route('admin.mentor.index') }}"
                    class="admin-stat-link"
                >
                    Kelola mentor
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>


        {{-- MURID --}}

        <div class="col-6 col-xl-3">

            <div class="admin-stat-card">

                <div class="admin-stat-icon">

                    <i class="bi bi-people-fill"></i>

                </div>

                <div class="admin-stat-label">
                    Total Murid
                </div>

                <div class="admin-stat-number">
                    {{ $jumlahMurid }}
                </div>

                <a
                    href="{{ route('admin.murid') }}"
                    class="admin-stat-link"
                >
                    Kelola murid
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>


        {{-- BANK KEPRIBADIAN --}}

        <div class="col-6 col-xl-3">

            <div class="admin-stat-card">

                <div class="admin-stat-icon">

                    <i class="bi bi-person-vcard"></i>

                </div>

                <div class="admin-stat-label">
                    Bank Kepribadian
                </div>

                <div class="admin-stat-number">
                    {{ $jumlahBankKepribadian }}
                </div>

                <a
                    href="{{ route('admin.kepribadian-bank.index') }}"
                    class="admin-stat-link"
                >
                    Lihat data
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>


        {{-- PAKET KEPRIBADIAN --}}

        <div class="col-6 col-xl-3">

            <div class="admin-stat-card">

                <div class="admin-stat-icon">

                    <i class="bi bi-ui-checks-grid"></i>

                </div>

                <div class="admin-stat-label">
                    Paket Kepribadian
                </div>

                <div class="admin-stat-number">
                    {{ $jumlahPaketKepribadian }}
                </div>

                <a
                    href="{{ url('/admin/paket-ujian') }}"
                    class="admin-stat-link"
                >
                    Kelola paket
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     AKSES CEPAT
========================================================= --}}

<section>


    <div class="dashboard-section-header">

        <div class="dashboard-section-label">
            Administrasi
        </div>

        <h2 class="dashboard-section-title">
            Akses Cepat
        </h2>

        <p class="dashboard-section-description">
            Menu utama yang paling sering digunakan oleh Super Admin.
        </p>

    </div>


    <div class="row g-4 mb-5">


        {{-- BANK SOAL --}}

        <div class="col-md-6 col-xl-3">

            <a
                href="{{ route('admin.bank-soal.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">

                    <i class="bi bi-journal-text"></i>

                </div>

                <div class="quick-title">
                    Bank Soal
                </div>

                <div class="quick-description">

                    Kelola bank soal yang digunakan
                    dalam sistem latihan dan ujian.

                </div>

                <div class="quick-arrow">

                    Buka Bank Soal

                    <i class="bi bi-arrow-right ms-1"></i>

                </div>

            </a>

        </div>


        {{-- PAKET UJIAN --}}

        <div class="col-md-6 col-xl-3">

            <a
                href="{{ url('/admin/paket-ujian') }}"
                class="quick-card"
            >

                <div class="quick-icon">

                    <i class="bi bi-collection-fill"></i>

                </div>

                <div class="quick-title">
                    Paket Ujian
                </div>

                <div class="quick-description">

                    Kelola paket ujian termasuk
                    Kepribadian dan Kecermatan.

                </div>

                <div class="quick-arrow">

                    Buka Paket Ujian

                    <i class="bi bi-arrow-right ms-1"></i>

                </div>

            </a>

        </div>


        {{-- MENTOR --}}

        <div class="col-md-6 col-xl-3">

            <a
                href="{{ route('admin.mentor.index') }}"
                class="quick-card"
            >

                <div class="quick-icon">

                    <i class="bi bi-person-workspace"></i>

                </div>

                <div class="quick-title">
                    Mentor
                </div>

                <div class="quick-description">

                    Kelola akun mentor yang membantu
                    proses pembelajaran peserta.

                </div>

                <div class="quick-arrow">

                    Kelola Mentor

                    <i class="bi bi-arrow-right ms-1"></i>

                </div>

            </a>

        </div>


        {{-- MURID --}}

        <div class="col-md-6 col-xl-3">

            <a
                href="{{ route('admin.murid') }}"
                class="quick-card"
            >

                <div class="quick-icon">

                    <i class="bi bi-people-fill"></i>

                </div>

                <div class="quick-title">
                    Data Murid
                </div>

                <div class="quick-description">

                    Kelola akun peserta yang mengikuti
                    latihan dan ujian ZAVIER.

                </div>

                <div class="quick-arrow">

                    Kelola Murid

                    <i class="bi bi-arrow-right ms-1"></i>

                </div>

            </a>

        </div>

        <a href="{{ route('admin.riwayat-kecerdasan.index') }}" 
   class="nav-link d-flex align-items-center gap-3 px-3 py-2 text-white text-decoration-none rounded-3 mb-1 {{ request()->routeIs('admin.riwayat-kecerdasan.*') ? 'bg-primary' : 'opacity-75' }}">
    <i class="bi bi-clock-history fs-5"></i>
    <span>Riwayat Ujian</span>
</a>

    </div>

</section>


{{-- =========================================================
     INFORMASI SISTEM
========================================================= --}}

<div class="row g-4">


    {{-- PANEL ADMIN --}}

    <div class="col-lg-7">

        <div class="admin-info-card">

            <div class="admin-info-title">

                <i class="bi bi-shield-check text-primary me-2"></i>

                Pusat Administrasi

            </div>


            <div class="admin-info-item">

                <div class="admin-info-icon">

                    <i class="bi bi-collection"></i>

                </div>

                <div>

                    <strong>
                        Paket Ujian Terpusat
                    </strong>

                    <span>
                        Pengelolaan paket ujian dilakukan
                        melalui satu area agar sistem lebih
                        mudah digunakan oleh admin.
                    </span>

                </div>

            </div>


            <div class="admin-info-item">

                <div class="admin-info-icon">

                    <i class="bi bi-journal-check"></i>

                </div>

                <div>

                    <strong>
                        Bank Soal
                    </strong>

                    <span>
                        Bank soal tetap tersedia sebagai
                        sumber pertanyaan untuk kebutuhan
                        latihan dan ujian.
                    </span>

                </div>

            </div>


            <div class="admin-info-item">

                <div class="admin-info-icon">

                    <i class="bi bi-people"></i>

                </div>

                <div>

                    <strong>
                        Peserta & Mentor
                    </strong>

                    <span>
                        Data mentor dan murid dapat
                        dikelola langsung dari panel
                        Super Admin.
                    </span>

                </div>

            </div>

        </div>

    </div>


    {{-- STATUS --}}

    <div class="col-lg-5">

        <div
            class="admin-info-card"
            style="
                background:
                    linear-gradient(
                        135deg,
                        #123b82,
                        #1769e8
                    );
                color:white;
            "
        >

            <div
                class="admin-info-title"
                style="color:white;"
            >

                <i class="bi bi-stars me-2"></i>

                ZAVIER Learning Center

            </div>


            <p
                style="
                    color:rgba(255,255,255,.82);
                    font-size:13px;
                    line-height:1.8;
                "
            >

                Awal Baru yang Cemerlang
                Menuju Kesuksesan.

            </p>


            <div
                class="mt-4 p-3 rounded-4"
                style="
                    background:
                        rgba(255,255,255,.10);
                    border:
                        1px solid
                        rgba(255,255,255,.12);
                "
            >

                <div
                    style="
                        font-size:10px;
                        font-weight:800;
                        letter-spacing:1.5px;
                        opacity:.65;
                    "
                >
                    AKSES ADMIN
                </div>

                <div
                    class="mt-1"
                    style="
                        font-size:18px;
                        font-weight:900;
                    "
                >

                    Super Admin

                </div>

            </div>

        </div>

    </div>

</div>

@endsection