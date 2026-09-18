<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Murid | ZAVIER Learning Center</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f4f8fc;
            color: #172033;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .profile-page {
            min-height: calc(100vh - 72px);
            padding-bottom: 60px;
            background:
                radial-gradient(circle at 8% 5%, rgba(13,110,253,.08), transparent 28%),
                radial-gradient(circle at 92% 18%, rgba(13,202,240,.08), transparent 26%),
                #f4f8fc;
        }

        .profile-hero {
            position: relative;
            overflow: hidden;
            padding: 42px 0 72px;
            background: linear-gradient(135deg, #064bb5 0%, #0d6efd 55%, #0dcaf0 100%);
            color: #fff;
            box-shadow: 0 12px 35px rgba(13,110,253,.18);
        }

        .profile-hero::before,
        .profile-hero::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .profile-hero::before {
            width: 330px;
            height: 330px;
            right: -90px;
            top: -190px;
            background: rgba(255,255,255,.10);
        }

        .profile-hero::after {
            width: 230px;
            height: 230px;
            left: -100px;
            bottom: -150px;
            background: rgba(255,255,255,.08);
        }

        .profile-hero-inner {
            position: relative;
            z-index: 2;
            max-width: 1120px;
            margin: auto;
            padding: 0 20px;
        }

        .profile-hero-row {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .profile-avatar {
            width: 94px;
            height: 94px;
            min-width: 94px;
            border-radius: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.17);
            border: 2px solid rgba(255,255,255,.55);
            box-shadow: 0 15px 35px rgba(0,0,0,.16);
            font-size: 36px;
            font-weight: 800;
            backdrop-filter: blur(12px);
        }

        .profile-title-line {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .profile-title-line h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .murid-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,.16);
            border: 1px solid rgba(255,255,255,.35);
            font-size: 12px;
            font-weight: 700;
            backdrop-filter: blur(10px);
        }

        .profile-email {
            margin: 8px 0 5px;
            opacity: .94;
            font-size: 14px;
        }

        .profile-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            opacity: .82;
        }

        .online-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #9cffc6;
            box-shadow: 0 0 12px rgba(156,255,198,.9);
        }

        .profile-main {
            max-width: 1120px;
            margin: -42px auto 0;
            padding: 0 20px;
            position: relative;
            z-index: 5;
        }

        .profile-intro {
            background: rgba(255,255,255,.95);
            border: 1px solid rgba(255,255,255,.9);
            border-radius: 20px;
            padding: 20px 22px;
            box-shadow: 0 14px 35px rgba(31,45,61,.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .intro-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .intro-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eaf3ff;
            color: #0d6efd;
            font-size: 20px;
        }

        .intro-title {
            margin: 0;
            font-size: 17px;
            font-weight: 800;
        }

        .intro-text {
            margin: 3px 0 0;
            color: #7b8797;
            font-size: 13px;
        }

        .dashboard-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
            color: #0d6efd;
            font-size: 13px;
            font-weight: 700;
            padding: 10px 14px;
            border-radius: 10px;
            background: #f2f7ff;
            border: 1px solid #dceaff;
        }

        .dashboard-link:hover {
            background: #eaf3ff;
            color: #075bc9;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 22px;
        }

        .profile-card {
            background: #fff;
            border: 1px solid #e5ebf2;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 9px 28px rgba(31,45,61,.055);
        }

        .profile-card-head {
            padding: 22px 25px;
            display: flex;
            align-items: center;
            gap: 14px;
            border-bottom: 1px solid #edf1f5;
            background: linear-gradient(180deg,#fff,#fbfdff);
        }

        .head-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .head-icon.blue { background: #eaf3ff; color: #0d6efd; }
        .head-icon.purple { background: #f0ebff; color: #7950f2; }
        .head-icon.red { background: #fff0f1; color: #dc3545; }

        .profile-card-head h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            color: #182235;
        }

        .profile-card-head p {
            margin: 4px 0 0;
            font-size: 13px;
            color: #7d899a;
        }

        .profile-card-body {
            padding: 26px;
        }

        .profile-card-body input,
        .profile-card-body select,
        .profile-card-body textarea {
            border-radius: 10px !important;
        }

        .profile-card-body button {
            border-radius: 10px !important;
        }

        .security-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
            padding: 13px 15px;
            border-radius: 12px;
            background: #f7f4ff;
            border: 1px solid #e7ddff;
            color: #6841c6;
            font-size: 13px;
            line-height: 1.55;
        }

        .security-note i {
            font-size: 17px;
            margin-top: 1px;
        }

        .danger-card {
            border-color: #f2d9dc;
        }

        .danger-note {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 13px;
            background: #fff7f7;
            border: 1px solid #ffdadd;
            color: #842029;
        }

        .danger-note i {
            font-size: 20px;
            color: #dc3545;
        }

        .danger-note strong {
            display: block;
            font-size: 13px;
            margin-bottom: 3px;
        }

        .danger-note span {
            display: block;
            color: #9b555b;
            font-size: 12px;
            line-height: 1.55;
        }

        .profile-footer {
            display: flex;
            justify-content: center;
            margin-top: 24px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 18px;
            border-radius: 11px;
            text-decoration: none;
            color: #475467;
            background: #fff;
            border: 1px solid #dce3eb;
            box-shadow: 0 5px 18px rgba(31,45,61,.045);
            font-size: 13px;
            font-weight: 700;
            transition: .2s ease;
        }

        .back-button:hover {
            color: #0d6efd;
            border-color: #bcd5f8;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .profile-hero {
                padding: 30px 0 65px;
            }

            .profile-hero-row {
                align-items: flex-start;
            }

            .profile-avatar {
                width: 72px;
                min-width: 72px;
                height: 72px;
                border-radius: 21px;
                font-size: 28px;
            }

            .profile-title-line h1 {
                font-size: 23px;
            }

            .profile-main {
                padding: 0 14px;
            }

            .profile-intro {
                align-items: flex-start;
                flex-direction: column;
            }

            .dashboard-link {
                width: 100%;
                justify-content: center;
            }

            .profile-card-body {
                padding: 20px 18px;
            }
        }

        @media (max-width: 480px) {
            .profile-hero-row {
                gap: 14px;
            }

            .profile-avatar {
                width: 62px;
                min-width: 62px;
                height: 62px;
                border-radius: 18px;
                font-size: 24px;
            }

            .profile-title-line h1 {
                font-size: 20px;
            }

            .profile-email {
                font-size: 12px;
            }

            .murid-badge {
                padding: 5px 9px;
                font-size: 10px;
            }

            .profile-card-head {
                padding: 18px;
            }

            .profile-card-head h2 {
                font-size: 16px;
            }

            .profile-card-body {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    {{-- =========================================================
         NAVBAR MURID
         SATU NAVBAR UNTUK SEMUA HALAMAN
    ========================================================== --}}
    @include('layouts.navbar-murid')


    <main class="profile-page">

        {{-- =====================================================
             HERO PROFIL
        ====================================================== --}}
        <section class="profile-hero">

            <div class="profile-hero-inner">

                <div class="profile-hero-row">

                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>

                        <div class="profile-title-line">

                            <h1>
                                {{ auth()->user()->name }}
                            </h1>

                            <span class="murid-badge">
                                <i class="bi bi-person-check-fill"></i>
                                MURID
                            </span>

                        </div>

                        <div class="profile-email">
                            <i class="bi bi-envelope-fill me-1"></i>
                            {{ auth()->user()->email }}
                        </div>

                        <div class="profile-status">
                            <span class="online-dot"></span>
                            Akun aktif di ZAVIER Learning Center
                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             MAIN
        ====================================================== --}}
        <div class="profile-main">

            {{-- INTRO --}}
            <div class="profile-intro">

                <div class="intro-left">

                    <div class="intro-icon">
                        <i class="bi bi-person-circle"></i>
                    </div>

                    <div>

                        <h2 class="intro-title">
                            Pengaturan Profil
                        </h2>

                        <p class="intro-text">
                            Kelola informasi pribadi dan keamanan akun Anda.
                        </p>

                    </div>

                </div>

                <a
                    href="{{ route('murid.dashboard') }}"
                    class="dashboard-link"
                >
                    <i class="bi bi-grid-1x2-fill"></i>
                    Dashboard
                </a>

            </div>


            <div class="profile-grid">

                {{-- =================================================
                     INFORMASI PROFIL
                ================================================== --}}
                <section class="profile-card">

                    <div class="profile-card-head">

                        <div class="head-icon blue">
                            <i class="bi bi-person-vcard-fill"></i>
                        </div>

                        <div>
                            <h2>Informasi Profil</h2>
                            <p>
                                Perbarui nama dan informasi akun Anda.
                            </p>
                        </div>

                    </div>

                    <div class="profile-card-body">

                        @include(
                            'profile.partials.update-profile-information-form'
                        )

                    </div>

                </section>


                {{-- =================================================
                     PASSWORD
                ================================================== --}}
                <section class="profile-card">

                    <div class="profile-card-head">

                        <div class="head-icon purple">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>

                        <div>
                            <h2>Keamanan Akun</h2>
                            <p>
                                Pastikan password Anda selalu aman.
                            </p>
                        </div>

                    </div>

                    <div class="profile-card-body">

                        <div class="security-note">

                            <i class="bi bi-shield-check"></i>

                            <span>
                                Gunakan password yang kuat dan jangan
                                membagikannya kepada orang lain.
                            </span>

                        </div>

                        @include(
                            'profile.partials.update-password-form'
                        )

                    </div>

                </section>


                {{-- =================================================
                     HAPUS AKUN
                ================================================== --}}
                <section class="profile-card danger-card">

                    <div class="profile-card-head">

                        <div class="head-icon red">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>

                        <div>
                            <h2>Hapus Akun</h2>
                            <p>
                                Gunakan pilihan ini dengan hati-hati.
                            </p>
                        </div>

                    </div>

                    <div class="profile-card-body">

                        <div class="danger-note">

                            <i class="bi bi-exclamation-circle-fill"></i>

                            <div>

                                <strong>
                                    Perhatian
                                </strong>

                                <span>
                                    Menghapus akun merupakan tindakan
                                    permanen. Data akun yang telah dihapus
                                    tidak dapat dipulihkan kembali.
                                </span>

                            </div>

                        </div>

                        @include(
                            'profile.partials.delete-user-form'
                        )

                    </div>

                </section>

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}
            <div class="profile-footer">

                <a
                    href="{{ route('murid.dashboard') }}"
                    class="back-button"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Dashboard
                </a>

            </div>

        </div>

    </main>

</body>
</html>
