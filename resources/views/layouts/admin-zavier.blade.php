<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'ZAVIER Admin')
    </title>


    {{-- BOOTSTRAP --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- BOOTSTRAP ICON --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >


    <style>

        :root {

            --z-primary: #2563eb;

            --z-primary-dark: #1d4ed8;

            --z-dark: #0f172a;

            --z-sidebar: #111827;

            --z-bg: #f4f7fb;

        }


        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            background: var(--z-bg);

            color: #172033;

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

        }


        /* =========================================================
           ADMIN SHELL
        ========================================================= */

        .admin-shell {

            min-height: 100vh;

        }


        /* =========================================================
           SIDEBAR
        ========================================================= */

        .admin-sidebar {

            position: fixed;

            inset: 0 auto 0 0;

            width: 265px;

            background:
                linear-gradient(
                    180deg,
                    #111827 0%,
                    #172554 100%
                );

            color: #fff;

            padding: 24px 16px;

            overflow-y: auto;

            z-index: 1040;

        }


        /* =========================================================
           BRAND
        ========================================================= */

        .brand {

            display: flex;

            align-items: center;

            gap: 12px;

            color: #fff;

            text-decoration: none;

            padding: 4px 10px 24px;

            border-bottom:
                1px solid
                rgba(255,255,255,.10);

            margin-bottom: 18px;

        }


        .brand:hover {

            color: #fff;

        }


        .brand-mark {

            width: 44px;

            height: 44px;

            display: grid;

            place-items: center;

            border-radius: 14px;

            background:
                rgba(255,255,255,.12);

            font-size: 22px;

        }


        .brand strong {

            font-size: 20px;

            letter-spacing: .5px;

        }


        .brand small {

            display: block;

            color:
                rgba(255,255,255,.55);

            font-size: 11px;

            margin-top: 2px;

            letter-spacing: .8px;

        }


        /* =========================================================
           NAV LABEL
        ========================================================= */

        .nav-label {

            color:
                rgba(255,255,255,.40);

            font-size: 10px;

            font-weight: 800;

            letter-spacing: 1.4px;

            text-transform: uppercase;

            padding: 12px 12px 8px;

        }


        /* =========================================================
           NAVIGATION
        ========================================================= */

        .admin-nav a {

            display: flex;

            align-items: center;

            gap: 11px;

            color:
                rgba(255,255,255,.78);

            text-decoration: none;

            padding: 11px 12px;

            border-radius: 11px;

            margin-bottom: 4px;

            transition: .18s ease;

            font-size: 14px;

        }


        .admin-nav a i {

            width: 20px;

            min-width: 20px;

            text-align: center;

            font-size: 17px;

        }


        .admin-nav a:hover {

            background:
                rgba(255,255,255,.11);

            color: #fff;

        }


        .admin-nav a.active {

            background:
                rgba(255,255,255,.11);

            color: #fff;

            box-shadow:
                inset 3px 0 0 #60a5fa;

        }


        /* =========================================================
           MAIN
        ========================================================= */

        .admin-main {

            margin-left: 265px;

            min-height: 100vh;

        }


        /* =========================================================
           TOPBAR
        ========================================================= */

        .admin-topbar {

            height: 72px;

            background:
                rgba(255,255,255,.94);

            border-bottom:
                1px solid #e5eaf1;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 30px;

            position: sticky;

            top: 0;

            z-index: 1030;

            backdrop-filter: blur(10px);

        }


        .top-title {

            font-weight: 700;

            color: #172033;

        }


        /* =========================================================
           USER PILL
        ========================================================= */

        .user-pill {

            display: flex;

            align-items: center;

            gap: 10px;

            background:
                #f1f5f9;

            border:
                1px solid #e2e8f0;

            border-radius: 999px;

            padding:
                7px 13px 7px 8px;

        }


        .user-avatar {

            width: 34px;

            height: 34px;

            border-radius: 50%;

            display: grid;

            place-items: center;

            background:
                #dbeafe;

            color:
                #1d4ed8;

            font-weight: 800;

        }


        /* =========================================================
           CONTENT
        ========================================================= */

        .admin-content {

            padding: 30px;

        }


        /* =========================================================
           MOBILE BUTTON
        ========================================================= */

        .mobile-toggle {

            display: none;

        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 991.98px) {

            .admin-sidebar {

                transform:
                    translateX(-100%);

                transition:
                    transform .2s ease;

            }


            .admin-sidebar.show {

                transform:
                    translateX(0);

            }


            .admin-main {

                margin-left: 0;

            }


            .mobile-toggle {

                display: inline-flex;

                width: 40px;

                height: 40px;

                align-items: center;

                justify-content: center;

                border:
                    1px solid #e2e8f0;

                background: #fff;

                border-radius: 10px;

            }


            .admin-content {

                padding:
                    22px 16px;

            }

        }


        /* =========================================================
           MOBILE KECIL
        ========================================================= */

        @media (max-width: 575.98px) {

            .admin-topbar {

                padding:
                    0 14px;

            }


            .user-pill .user-name {

                display: none;

            }

        }

    </style>


    @stack('styles')

</head>


<body>


<div class="admin-shell">


    {{-- =========================================================
       SIDEBAR
    ========================================================= --}}

    <aside
        class="admin-sidebar"
        id="adminSidebar"
    >


        {{-- BRAND --}}

        <a
            href="{{ route('admin.dashboard') }}"
            class="brand"
        >

            <span class="brand-mark">

                <i class="bi bi-stars"></i>

            </span>


            <span>

                <strong>
                    ZAVIER
                </strong>

                <small>
                    LEARNING CENTER
                </small>

            </span>

        </a>



        {{-- =====================================================
           UTAMA
        ====================================================== --}}

        <div class="nav-label">
            Utama
        </div>


        <nav class="admin-nav">


            {{-- DASHBOARD --}}

            <a
                href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            >

                <i class="bi bi-grid-1x2-fill"></i>

                <span>
                    Dashboard
                </span>

            </a>



            {{-- BANK SOAL UTAMA --}}

            <a
                href="{{ route('admin.bank-soal.index') }}"
                class="{{ request()->routeIs('admin.bank-soal.*') ? 'active' : '' }}"
            >

                <i class="bi bi-journal-text"></i>

                <span>
                    Bank Soal
                </span>

            </a>



            {{-- =================================================
               PAKET UJIAN UTAMA
               
               PENTING:
               BUKAN paket-kepribadian.
               Ini menuju halaman utama Paket Ujian.
            ================================================== --}}

            <a
                href="{{ url('/admin/paket-ujian') }}"
                class="{{ request()->is('admin/paket-ujian*') ? 'active' : '' }}"
            >

                <i class="bi bi-collection"></i>

                <span>
                    Paket Ujian
                </span>

            </a>


        </nav>



        {{-- =====================================================
           KEPRIBADIAN
        ====================================================== --}}

        <div class="nav-label">

            Kepribadian

        </div>


        <nav class="admin-nav">


            {{-- BANK KEPRIBADIAN --}}

            <a
                href="{{ route('admin.kepribadian-bank.index') }}"
                class="{{ request()->routeIs('admin.kepribadian-bank.*') ? 'active' : '' }}"
            >

                <i class="bi bi-person-vcard"></i>

                <span>
                    Bank Kepribadian
                </span>

            </a>



            {{-- PAKET KEPRIBADIAN --}}

            <a
                href="{{ route('admin.paket-kepribadian.index') }}"
                class="{{ request()->routeIs('admin.paket-kepribadian.*') ? 'active' : '' }}"
            >

                <i class="bi bi-ui-checks-grid"></i>

                <span>
                    Paket Kepribadian
                </span>

            </a>


        </nav>



        {{-- =====================================================
           PESERTA
        ====================================================== --}}

        <div class="nav-label">

            Peserta

        </div>


        <nav class="admin-nav">


            {{-- MENTOR --}}

            <a
                href="{{ route('admin.mentor.index') }}"
                class="{{ request()->routeIs('admin.mentor.*') ? 'active' : '' }}"
            >

                <i class="bi bi-person-workspace"></i>

                <span>
                    Mentor
                </span>

            </a>



            {{-- MURID --}}

            <a
                href="{{ route('admin.murid') }}"
                class="{{ request()->routeIs('admin.murid') ? 'active' : '' }}"
            >

                <i class="bi bi-people"></i>

                <span>
                    Murid
                </span>

            </a>


        </nav>



        {{-- =====================================================
           SISTEM LAMA
        ====================================================== --}}

        <div class="nav-label">

            Sistem Lama

        </div>


        <nav class="admin-nav">


            {{-- KECERMATAN --}}

            <a
                href="{{ route('admin.paket-soal') }}"
                class="{{ request()->routeIs('admin.paket-soal*') ? 'active' : '' }}"
            >

                <i class="bi bi-bullseye"></i>

                <span>
                    Kecermatan
                </span>

            </a>


        </nav>



        {{-- =====================================================
           LOGOUT
        ====================================================== --}}

        <div
            class="mt-4 pt-3 border-top border-light border-opacity-10"
        >

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf


                <button
                    type="submit"
                    class="btn btn-link text-white-50 text-decoration-none w-100 text-start px-3"
                >

                    <i
                        class="bi bi-box-arrow-right me-2"
                    ></i>

                    Keluar

                </button>

            </form>

        </div>


    </aside>



    {{-- =========================================================
       MAIN AREA
    ========================================================= --}}

    <div class="admin-main">


        {{-- =====================================================
           TOPBAR
        ====================================================== --}}

        <header class="admin-topbar">


            <div
                class="d-flex align-items-center gap-3"
            >


                {{-- MOBILE TOGGLE --}}

                <button
                    class="mobile-toggle"
                    type="button"
                    onclick="document.getElementById('adminSidebar').classList.toggle('show')"
                >

                    <i
                        class="bi bi-list fs-5"
                    ></i>

                </button>



                {{-- TITLE --}}

                <div>

                    <div class="top-title">

                        @yield(
                            'title',
                            'Dashboard Admin'
                        )

                    </div>


                    <div
                        class="small text-secondary d-none d-sm-block"
                    >

                        Panel administrasi ZAVIER

                    </div>

                </div>


            </div>



            {{-- =================================================
               USER
            ================================================== --}}

            <div class="user-pill">


                <div class="user-avatar">

                    {{ strtoupper(
                        substr(
                            Auth::user()->name ?? 'A',
                            0,
                            1
                        )
                    ) }}

                </div>


                <div class="user-name">

                    <div class="fw-semibold small">

                        {{ Auth::user()->name ?? 'Admin' }}

                    </div>


                    <div
                        class="text-secondary"
                        style="font-size:10px"
                    >

                        Super Admin

                    </div>

                </div>


            </div>


        </header>



        {{-- =====================================================
           PAGE CONTENT
        ====================================================== --}}

        <main class="admin-content">

            @yield('content')

        </main>


    </div>


</div>



{{-- =========================================================
   BOOTSTRAP JS
========================================================= --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


@stack('scripts')


</body>

</html>