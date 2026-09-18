@extends('layouts.admin-zavier')

@section('title', 'Bank Soal Kepribadian')

@section('content')

<style>

    /* =========================================================
       PAGE
    ========================================================= */

    .kepribadian-page {
        min-height: calc(100vh - 76px);
        background:
            linear-gradient(
                135deg,
                #f5f9ff 0%,
                #eef5ff 50%,
                #f8fbff 100%
            );

        padding: 32px 0 60px;
    }


    .kepribadian-container {
        width: 100%;
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 25px;

        margin-bottom: 30px;
    }


    .page-header-left {
        flex: 1;
    }


    .page-title {
        margin: 0;

        color: #17346f;

        font-size: 38px;
        font-weight: 800;

        line-height: 1.15;

        letter-spacing: -0.8px;
    }


    .page-subtitle {
        margin: 8px 0 0;

        color: #718096;

        font-size: 17px;
        font-weight: 400;
    }


    /* =========================================================
       BUTTON BANK BARU
    ========================================================= */

    .btn-bank-baru {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 9px;

        padding: 13px 20px;

        background:
            linear-gradient(
                135deg,
                #1677ff,
                #0d6efd
            );

        color: #ffffff;

        border: none;
        border-radius: 8px;

        font-size: 16px;
        font-weight: 600;

        text-decoration: none;

        box-shadow:
            0 8px 20px rgba(13, 110, 253, .18);

        transition:
            transform .2s ease,
            box-shadow .2s ease;
    }


    .btn-bank-baru:hover {
        color: #ffffff;

        transform: translateY(-2px);

        box-shadow:
            0 12px 25px rgba(13, 110, 253, .25);
    }


    .btn-bank-baru i {
        font-size: 18px;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .alert-box {
        border-radius: 12px;

        margin-bottom: 22px;

        border: 1px solid transparent;

        font-size: 14px;
    }


    /* =========================================================
       BANK GRID
    ========================================================= */

    .bank-grid {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 28px;
    }


    /* =========================================================
       BANK CARD
    ========================================================= */

    .bank-card {
        position: relative;

        background: #ffffff;

        border-radius: 22px;

        padding: 30px 30px 28px;

        min-height: 280px;

        border: 1px solid #edf1f7;

        box-shadow:
            0 7px 20px rgba(15, 23, 42, .055);

        transition:
            transform .22s ease,
            box-shadow .22s ease,
            border-color .22s ease;

        overflow: hidden;
    }


    .bank-card:hover {
        transform: translateY(-4px);

        border-color: #dbe8ff;

        box-shadow:
            0 15px 35px rgba(15, 23, 42, .09);
    }


    /* =========================================================
       DECORATIVE CIRCLE
    ========================================================= */

    .bank-card::after {
        content: "";

        position: absolute;

        width: 115px;
        height: 115px;

        right: -45px;
        bottom: -48px;

        border-radius: 50%;

        background:
            radial-gradient(
                circle,
                rgba(13, 110, 253, .045),
                rgba(13, 110, 253, 0)
            );

        pointer-events: none;
    }


    /* =========================================================
       TOP CARD
    ========================================================= */

    .bank-card-top {
        display: flex;

        align-items: center;
        justify-content: space-between;

        gap: 10px;

        margin-bottom: 24px;
    }


    .bank-category {
        display: inline-flex;

        align-items: center;

        padding: 6px 11px;

        border-radius: 8px;

        background: #f7f8fa;

        color: #111827;

        font-size: 13px;
        font-weight: 700;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .bank-status {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        padding: 6px 11px;

        border-radius: 7px;

        font-size: 13px;
        font-weight: 700;

        line-height: 1;
    }


    .bank-status.active {
        background: #15965b;

        color: #ffffff;
    }


    .bank-status.inactive {
        background: #e5e7eb;

        color: #4b5563;
    }


    /* =========================================================
       CARD TITLE
    ========================================================= */

    .bank-name {
        margin: 0 0 9px;

        color: #172033;

        font-size: 29px;
        font-weight: 500;

        line-height: 1.2;
    }


    .bank-description {
        margin: 0;

        min-height: 25px;

        color: #718096;

        font-size: 16px;
        font-weight: 400;
    }


    /* =========================================================
       CARD BOTTOM
    ========================================================= */

    .bank-card-bottom {
        display: flex;

        align-items: flex-end;
        justify-content: space-between;

        gap: 15px;

        margin-top: 32px;
    }


    .question-count-label {
        margin-bottom: 4px;

        color: #718096;

        font-size: 15px;
    }


    .question-count {
        color: #111827;

        font-size: 31px;
        font-weight: 800;

        line-height: 1;
    }


    /* =========================================================
       ACTION
    ========================================================= */

    .bank-actions {
        display: flex;

        align-items: center;

        gap: 8px;

        position: relative;
        z-index: 5;
    }


    .btn-kelola {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 7px;

        min-width: 85px;

        padding: 10px 15px;

        border: 1.5px solid #0d6efd;

        border-radius: 8px;

        background: #ffffff;

        color: #0d6efd;

        font-size: 15px;
        font-weight: 500;

        text-decoration: none;

        transition:
            background .2s ease,
            color .2s ease,
            transform .2s ease;
    }


    .btn-kelola:hover {
        background: #0d6efd;

        color: #ffffff;

        transform: translateY(-1px);
    }


    /* =========================================================
       DELETE BUTTON
    ========================================================= */

    .btn-hapus {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        width: 42px;
        height: 42px;

        border: 1px solid #fecaca;

        border-radius: 8px;

        background: #fff5f5;

        color: #dc2626;

        cursor: pointer;

        transition:
            background .2s ease,
            color .2s ease,
            border-color .2s ease,
            transform .2s ease;
    }


    .btn-hapus:hover {
        background: #dc2626;

        color: #ffffff;

        border-color: #dc2626;

        transform: translateY(-1px);
    }


    .btn-hapus i {
        font-size: 17px;
    }


    /* =========================================================
       EMPTY
    ========================================================= */

    .empty-bank {
        background: #ffffff;

        border: 1px dashed #cbd5e1;

        border-radius: 18px;

        padding: 60px 25px;

        text-align: center;
    }


    .empty-bank-icon {
        width: 65px;
        height: 65px;

        margin: 0 auto 18px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 18px;

        background: #eff6ff;

        color: #0d6efd;

        font-size: 28px;
    }


    .empty-bank h3 {
        margin: 0 0 7px;

        color: #1e293b;

        font-size: 20px;
        font-weight: 700;
    }


    .empty-bank p {
        margin: 0;

        color: #64748b;

        font-size: 14px;
    }


    /* =========================================================
       DELETE CONFIRMATION
    ========================================================= */

    .delete-form {
        margin: 0;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1200px) {

        .bank-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

    }


    @media (max-width: 768px) {

        .kepribadian-page {
            padding: 25px 0 45px;
        }


        .page-header {
            flex-direction: column;

            align-items: stretch;
        }


        .page-title {
            font-size: 31px;
        }


        .page-subtitle {
            font-size: 15px;
        }


        .btn-bank-baru {
            width: 100%;
        }


        .bank-grid {
            grid-template-columns: 1fr;

            gap: 18px;
        }


        .bank-card {
            padding: 24px;

            min-height: auto;
        }


        .bank-name {
            font-size: 26px;
        }


        .bank-card-bottom {
            margin-top: 28px;
        }

    }


    @media (max-width: 480px) {

        .bank-card-bottom {
            align-items: flex-start;

            flex-direction: column;
        }


        .bank-actions {
            width: 100%;
        }


        .btn-kelola {
            flex: 1;
        }


        .btn-hapus {
            flex: 0 0 42px;
        }

    }

</style>


<div class="kepribadian-page">

    <div class="kepribadian-container">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="page-header">

            <div class="page-header-left">

                <h1 class="page-title">
                    Bank Soal Kepribadian
                </h1>

                <p class="page-subtitle">
                    Kelola kumpulan soal kepribadian dan impor dari Word.
                </p>

            </div>


            <div>

                <a
                    href="{{ route('admin.kepribadian-bank.create') }}"
                    class="btn-bank-baru"
                >

                    <i class="bi bi-plus-lg"></i>

                    Bank Baru

                </a>

            </div>

        </div>


        {{-- =====================================================
             SUCCESS MESSAGE
        ====================================================== --}}

        @if(session('success'))

            <div class="alert alert-success alert-box">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

            </div>

        @endif


        {{-- =====================================================
             ERROR MESSAGE
        ====================================================== --}}

        @if(session('error'))

            <div class="alert alert-danger alert-box">

                <i class="bi bi-exclamation-circle-fill me-2"></i>

                {{ session('error') }}

            </div>

        @endif


        {{-- =====================================================
             VALIDATION ERROR
        ====================================================== --}}

        @if($errors->any())

            <div class="alert alert-danger alert-box">

                <strong>
                    Terdapat kesalahan:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =====================================================
             BANK GRID
        ====================================================== --}}

        @if($banks->count() > 0)

            <div class="bank-grid">

                @foreach($banks as $bank)

                    <div class="bank-card">


                        {{-- =================================================
                             TOP
                        ================================================== --}}

                        <div class="bank-card-top">


                            <span class="bank-category">

                                Kepribadian

                            </span>


                            @if($bank->status)

                                <span class="bank-status active">

                                    Aktif

                                </span>

                            @else

                                <span class="bank-status inactive">

                                    Nonaktif

                                </span>

                            @endif


                        </div>


                        {{-- =================================================
                             NAME
                        ================================================== --}}

                        <h2 class="bank-name">

                            {{ $bank->nama_bank }}

                        </h2>


                        {{-- =================================================
                             DESCRIPTION
                        ================================================== --}}

                        <p class="bank-description">

                            {{ $bank->deskripsi ?: 'Kepribadian' }}

                        </p>


                        {{-- =================================================
                             BOTTOM
                        ================================================== --}}

                        <div class="bank-card-bottom">


                            <div>

                                <div class="question-count-label">

                                    Jumlah soal

                                </div>

                                <div class="question-count">

                                    {{ number_format($bank->soal_count, 0, ',', '.') }}

                                </div>

                            </div>


                            {{-- =================================================
                                 ACTIONS
                            ================================================== --}}

                            <div class="bank-actions">


                                {{-- EDIT / KELOLA --}}

                                <a
                                    href="{{ route('admin.kepribadian-bank.edit', $bank) }}"
                                    class="btn-kelola"
                                >

                                    Kelola

                                </a>


                                {{-- DELETE --}}

                                <form
                                    action="{{ route('admin.kepribadian-bank.destroy', $bank) }}"
                                    method="POST"
                                    class="delete-form"
                                    onsubmit="return confirm('Yakin ingin menghapus {{ $bank->nama_bank }} beserta seluruh soal di dalamnya?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-hapus"
                                        title="Hapus bank"
                                    >

                                        <i class="bi bi-trash3"></i>

                                    </button>

                                </form>


                            </div>


                        </div>


                    </div>

                @endforeach

            </div>

        @else


            {{-- =================================================
                 EMPTY BANK
            ================================================== --}}

            <div class="empty-bank">

                <div class="empty-bank-icon">

                    <i class="bi bi-journal-text"></i>

                </div>


                <h3>
                    Belum ada Bank Soal
                </h3>


                <p>
                    Silakan buat Bank Soal Kepribadian terlebih dahulu.
                </p>


                <div class="mt-4">

                    <a
                        href="{{ route('admin.kepribadian-bank.create') }}"
                        class="btn-bank-baru"
                    >

                        <i class="bi bi-plus-lg"></i>

                        Buat Bank Baru

                    </a>

                </div>

            </div>


        @endif


    </div>

</div>

@endsection