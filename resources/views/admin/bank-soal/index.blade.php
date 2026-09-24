@extends('layouts.admin-zavier')

@section('title', 'Bank Soal')

@section('content')

<style>
    .bank-soal-page {
        min-height: calc(100vh - 80px);
        background: linear-gradient(135deg, #f8fbff 0%, #eef6ff 50%, #f8fbff 100%);
        padding: 35px 30px 50px;
    }

    .bank-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .bank-header-left {
        max-width: 750px;
    }

    .bank-label {
        display: inline-block;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.8px;
        color: #2563eb;
        margin-bottom: 7px;
    }

    .bank-title {
        margin: 0;
        font-size: 32px;
        font-weight: 800;
        color: #172554;
        line-height: 1.2;
    }

    .bank-subtitle {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 15px;
    }

    .btn-tambah-soal {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 8px 20px rgba(37, 99, 235, .20);
        transition: all .2s ease;
        white-space: nowrap;
    }

    .btn-tambah-soal:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(37, 99, 235, .28);
    }

    .bank-section {
        margin-bottom: 35px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .section-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .section-icon.kecermatan {
        background: #e0f2fe;
        color: #0284c7;
    }

    .section-icon.psikologi {
        background: #f3e8ff;
        color: #9333ea;
    }

    .section-icon.akademik {
        background: #dcfce7;
        color: #16a34a;
    }

    .section-title-wrap h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
        color: #1e293b;
    }

    .section-title-wrap p {
        margin: 2px 0 0;
        color: #94a3b8;
        font-size: 13px;
    }

    .bank-card {
        position: relative;
        display: flex;
        align-items: center;
        gap: 20px;
        background: rgba(255, 255, 255, .92);
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 22px 24px;
        margin-bottom: 14px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(15, 23, 42, .05);
        transition: all .22s ease;
    }

    .bank-card:hover {
        transform: translateY(-2px);
        border-color: #bfdbfe;
        box-shadow: 0 14px 30px rgba(37, 99, 235, .09);
    }

    .bank-card::after {
        content: "";
        position: absolute;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        right: -45px;
        top: -45px;
        background: rgba(59, 130, 246, .055);
        pointer-events: none;
    }

    .bank-card-icon {
        width: 58px;
        height: 58px;
        min-width: 58px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
        position: relative;
        z-index: 1;
    }

    .icon-purple {
        background: linear-gradient(135deg, #f3e8ff, #ede9fe);
        color: #7e22ce;
    }

    .icon-green {
        background: linear-gradient(135deg, #dcfce7, #d1fae5);
        color: #15803d;
    }

    .icon-blue {
        background: linear-gradient(135deg, #dbeafe, #e0f2fe);
        color: #1d4ed8;
    }

    .icon-orange {
        background: linear-gradient(135deg, #ffedd5, #fef3c7);
        color: #ea580c;
    }

    .icon-red {
        background: linear-gradient(135deg, #fee2e2, #ffe4e6);
        color: #dc2626;
    }

    .icon-indigo {
        background: linear-gradient(135deg, #e0e7ff, #dbeafe);
        color: #4338ca;
    }

    .icon-teal {
        background: linear-gradient(135deg, #ccfbf1, #cffafe);
        color: #0f766e;
    }

    .icon-cyan {
        background: linear-gradient(135deg, #cffafe, #e0f2fe);
        color: #0891b2;
    }

    .bank-info {
        flex: 1;
        min-width: 0;
        position: relative;
        z-index: 1;
    }

    .bank-name {
        margin: 0 0 5px;
        font-size: 17px;
        font-weight: 800;
        color: #1e293b;
    }

    .bank-description {
        margin: 0;
        font-size: 13px;
        color: #64748b;
        line-height: 1.5;
    }

    .bank-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 9px;
    }

    .bank-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 700;
        color: #16a34a;
        background: #f0fdf4;
        border: 1px solid #dcfce7;
        padding: 4px 9px;
        border-radius: 999px;
    }

    .bank-status-dot {
        width: 6px;
        height: 6px;
        background: #22c55e;
        border-radius: 50%;
    }

    .bank-action {
        position: relative;
        z-index: 2;
    }

    .btn-kelola {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 15px;
        border: 1px solid #dbeafe;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: all .2s ease;
        white-space: nowrap;
    }

    .btn-kelola:hover {
        background: #2563eb;
        color: white;
        border-color: #2563eb;
    }

    .btn-disabled {
        cursor: default;
    }

    .btn-disabled:hover {
        background: #eff6ff;
        color: #2563eb;
        border-color: #dbeafe;
        transform: none;
    }

    @media (max-width: 768px) {

        .bank-soal-page {
            padding: 25px 16px 40px;
        }

        .bank-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .bank-title {
            font-size: 27px;
        }

        .btn-tambah-soal {
            width: 100%;
            justify-content: center;
        }

        .bank-card {
            align-items: flex-start;
            padding: 18px;
        }

        .bank-action {
            align-self: center;
        }

        .btn-kelola {
            padding: 9px 12px;
        }
    }

    @media (max-width: 540px) {

        .bank-card {
            flex-wrap: wrap;
        }

        .bank-info {
            width: calc(100% - 78px);
        }

        .bank-action {
            width: 100%;
            margin-left: 78px;
        }

        .btn-kelola {
            width: calc(100% - 78px);
            justify-content: center;
        }
    }
</style>


<div class="bank-soal-page">


    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="bank-header">

        <div class="bank-header-left">

            <span class="bank-label">
                BANK SOAL
            </span>

            <h1 class="bank-title">
                Bank Soal
            </h1>

            <p class="bank-subtitle">
                Kelola kumpulan soal berdasarkan sistem ujian yang tersedia.
            </p>

        </div>


        {{-- BELUM ADA FUNGSI --}}
        <a href="#" class="btn-tambah-soal">

            <i class="bi bi-plus-lg"></i>

            Tambah Soal

        </a>

    </div>



    {{-- ========================================================= --}}
    {{-- 1. TES KECERMATAN --}}
    {{-- ========================================================= --}}

    <div class="bank-section">

        <div class="section-heading">

            <div class="section-icon kecermatan">
                <i class="bi bi-bullseye"></i>
            </div>

            <div class="section-title-wrap">

                <h2>
                    Tes Kecermatan
                </h2>

                <p>
                    Sistem tes kecermatan
                </p>

            </div>

        </div>


        <div class="bank-card">

            <div class="bank-card-icon icon-blue">

                <i class="bi bi-bullseye"></i>

            </div>


            <div class="bank-info">

                <h3 class="bank-name">
                    Kecermatan
                </h3>

                <p class="bank-description">
                    Sistem soal kecermatan yang digunakan untuk mengukur
                    ketelitian dan kecepatan peserta.
                </p>

                <div class="bank-meta">

                    <span class="bank-status">

                        <span class="bank-status-dot"></span>

                        Sistem aktif

                    </span>

                </div>

            </div>


            <div class="bank-action">

                {{-- KECERMATAN TIDAK DIUBAH --}}
                <a href="{{ route('admin.soal.index') }}"
                   class="btn-kelola">

                    Kelola

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- 2. TES PSIKOLOGI & PENALARAN --}}
    {{-- ========================================================= --}}

    <div class="bank-section">

        <div class="section-heading">

            <div class="section-icon psikologi">

                <i class="bi bi-lightbulb"></i>

            </div>

            <div class="section-title-wrap">

                <h2>
                    Tes Psikologi
                </h2>

                <p>
                    Kelompok tes psikologi
                </p>

            </div>

        </div>



        {{-- ----------------------------------------------------- --}}
        {{-- KEPRIBADIAN --}}
        {{-- ----------------------------------------------------- --}}

        <div class="bank-card">

            <div class="bank-card-icon icon-purple">

                <i class="bi bi-person-heart"></i>

            </div>


            <div class="bank-info">

                <h3 class="bank-name">
                    Kepribadian
                </h3>

                <p class="bank-description">
                    Kelola kumpulan soal kepribadian dan karakter peserta.
                </p>

                <div class="bank-meta">

                    <span class="bank-status">

                        <span class="bank-status-dot"></span>

                        Sistem aktif

                    </span>

                </div>

            </div>


            <div class="bank-action">

                {{-- ROUTE KEPRIBADIAN MEMANG SUDAH ADA --}}
                <a href="{{ route('admin.kepribadian-bank.index') }}"
                   class="btn-kelola">

                    Kelola

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>



        {{-- ----------------------------------------------------- --}}
        {{-- KECERDASAN --}}
        {{-- ----------------------------------------------------- --}}

        <div class="bank-card">

            <div class="bank-card-icon icon-green">

                <i class="bi bi-lightbulb"></i>

            </div>


            <div class="bank-info">

                <h3 class="bank-name">
                    Kecerdasan
                </h3>

                <p class="bank-description">
                    Kelola kumpulan soal logika, verbal, numerik dan penalaran.
                </p>

                <div class="bank-meta">

                    <span class="bank-status">

                        <span class="bank-status-dot"></span>

                        Sistem aktif

                    </span>

                </div>

            </div>


            <div class="bank-action">

                {{-- BELUM ADA ROUTE --}}
                <a href="{{ route('admin.soal-kecerdasan.index') }}"
                   class="btn-kelola btn-disabled">

                    Kelola

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>

    </div>



    {{-- ========================================================= --}}
    {{-- 3. TES AKADEMIK --}}
    {{-- ========================================================= --}}

    <div class="bank-section">

        <div class="section-heading">

            <div class="section-icon akademik">

                <i class="bi bi-mortarboard"></i>

            </div>

            <div class="section-title-wrap">

                <h2>
                    Tes Akademik
                </h2>

                <p>
                    Kelompok tes wawasan dan kemampuan akademik
                </p>

            </div>

        </div>

        {{-- ----------------------------------------------------- --}}
        {{-- PENALARAN NUMERIK --}}
        {{-- ----------------------------------------------------- --}}

        <div class="bank-card">

            <div class="bank-card-icon icon-blue">

                <i class="bi bi-calculator"></i>

            </div>


            <div class="bank-info">

                <h3 class="bank-name">
                    Penalaran Numerik
                </h3>

                <p class="bank-description">
                    Kelola kumpulan soal angka, pola, perhitungan dan analisis numerik.
                </p>

                <div class="bank-meta">

                    <span class="bank-status">

                        <span class="bank-status-dot"></span>

                        Sistem aktif

                    </span>

                </div>

            </div>


            <div class="bank-action">

                {{-- BELUM ADA ROUTE --}}
                <a href="#"
                   class="btn-kelola btn-disabled">

                    Kelola

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>



        {{-- ----------------------------------------------------- --}}
        {{-- TWK --}}
        {{-- ----------------------------------------------------- --}}

        <div class="bank-card">

            <div class="bank-card-icon icon-red">

                <i class="bi bi-flag"></i>

            </div>


            <div class="bank-info">

                <h3 class="bank-name">
                    TWK
                </h3>

                <p class="bank-description">
                    Tes Wawasan Kebangsaan.
                </p>

                <div class="bank-meta">

                    <span class="bank-status">

                        <span class="bank-status-dot"></span>

                        Sistem aktif

                    </span>

                </div>

            </div>


            <div class="bank-action">

                {{-- BELUM ADA ROUTE --}}
                <a href="#"
                   class="btn-kelola btn-disabled">

                    Kelola

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>



        {{-- ----------------------------------------------------- --}}
        {{-- PU --}}
        {{-- ----------------------------------------------------- --}}

        <div class="bank-card">

            <div class="bank-card-icon icon-orange">

                <i class="bi bi-journal-text"></i>

            </div>


            <div class="bank-info">

                <h3 class="bank-name">
                    PU
                </h3>

                <p class="bank-description">
                    Tes pengetahuan dan pemahaman umum.
                </p>

                <div class="bank-meta">

                    <span class="bank-status">

                        <span class="bank-status-dot"></span>

                        Sistem aktif

                    </span>

                </div>

            </div>


            <div class="bank-action">

                {{-- BELUM ADA ROUTE --}}
                <a href="#"
                   class="btn-kelola btn-disabled">

                    Kelola

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>



        {{-- ----------------------------------------------------- --}}
        {{-- BAHASA INGGRIS --}}
        {{-- ----------------------------------------------------- --}}

        <div class="bank-card">

            <div class="bank-card-icon icon-indigo">

                <i class="bi bi-translate"></i>

            </div>


            <div class="bank-info">

                <h3 class="bank-name">
                    B. Inggris
                </h3>

                <p class="bank-description">
                    Kumpulan soal kemampuan Bahasa Inggris.
                </p>

                <div class="bank-meta">

                    <span class="bank-status">

                        <span class="bank-status-dot"></span>

                        Sistem aktif

                    </span>

                </div>

            </div>


            <div class="bank-action">

                {{-- BELUM ADA ROUTE --}}
                <a href="#"
                   class="btn-kelola btn-disabled">

                    Kelola

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>



        {{-- ----------------------------------------------------- --}}
        {{-- BAHASA INDONESIA --}}
        {{-- ----------------------------------------------------- --}}

        <div class="bank-card">

            <div class="bank-card-icon icon-teal">

                <i class="bi bi-book"></i>

            </div>


            <div class="bank-info">

                <h3 class="bank-name">
                    B. Indonesia
                </h3>

                <p class="bank-description">
                    Kumpulan soal kemampuan Bahasa Indonesia.
                </p>

                <div class="bank-meta">

                    <span class="bank-status">

                        <span class="bank-status-dot"></span>

                        Sistem aktif

                    </span>

                </div>

            </div>


            <div class="bank-action">

                {{-- BELUM ADA ROUTE --}}
                <a href="#"
                   class="btn-kelola btn-disabled">

                    Kelola

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>



        {{-- ----------------------------------------------------- --}}
        {{-- TIU --}}
        {{-- ----------------------------------------------------- --}}

        <div class="bank-card">

            <div class="bank-card-icon icon-cyan">

                <i class="bi bi-puzzle"></i>

            </div>


            <div class="bank-info">

                <h3 class="bank-name">
                    TIU
                </h3>

                <p class="bank-description">
                    Tes Intelegensi Umum untuk mengukur kemampuan berpikir peserta.
                </p>

                <div class="bank-meta">

                    <span class="bank-status">

                        <span class="bank-status-dot"></span>

                        Sistem aktif

                    </span>

                </div>

            </div>


            <div class="bank-action">

                {{-- BELUM ADA ROUTE --}}
                <a href="#"
                   class="btn-kelola btn-disabled">

                    Kelola

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>

    </div>

</div>

@endsection