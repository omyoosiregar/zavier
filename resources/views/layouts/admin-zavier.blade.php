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

        * {
            box-sizing: border-box;
        }

        :root {

            --z-primary: #2563eb;
            --z-primary-dark: #123b82;
            --z-cyan: #06b6d4;

            --z-bg: #f5f8fd;

            --z-text: #172554;
            --z-muted: #7183a0;

            --sidebar-width: 270px;
            --sidebar-mini: 82px;

        }


        html {
            scroll-behavior: smooth;
        }


        body {

            margin: 0;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(37,99,235,.07),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 20%,
                    rgba(6,182,212,.06),
                    transparent 28%
                ),
                var(--z-bg);

            color: var(--z-text);

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .admin-sidebar {

            position: fixed;

            left: 0;
            top: 0;
            bottom: 0;

            width: var(--sidebar-width);

            background:
                linear-gradient(
                    180deg,
                    #0b1730 0%,
                    #102b63 55%,
                    #123b82 100%
                );

            color: white;

            padding: 18px 14px;

            z-index: 1050;

            overflow-x: hidden;
            overflow-y: auto;

            transition:
                width .28s ease,
                transform .28s ease;

            box-shadow:
                8px 0 35px
                rgba(15,23,42,.08);

        }


        /* =====================================================
           BRAND
        ===================================================== */

        .brand {

            height: 72px;

            display: flex;

            align-items: center;

            gap: 12px;

            padding:
                7px 10px;

            margin-bottom: 20px;

            text-decoration: none;

            color: white;

            border-bottom:
                1px solid
                rgba(255,255,255,.10);

        }


        .brand:hover {
            color: white;
        }


        .brand-logo {

            width: 48px;
            height: 48px;

            flex-shrink: 0;

            object-fit: contain;

            border-radius: 13px;

            background: white;

            padding: 3px;

            box-shadow:
                0 8px 20px
                rgba(0,0,0,.15);

        }


        .brand-text {

            min-width: 0;

            transition:
                opacity .2s ease,
                transform .2s ease;

        }


        .brand-name {

            font-size: 19px;

            font-weight: 900;

            letter-spacing: .7px;

            line-height: 1;

        }


        .brand-subtitle {

            display: block;

            margin-top: 5px;

            font-size: 9px;

            font-weight: 700;

            letter-spacing: 1.5px;

            color:
                rgba(255,255,255,.55);

        }


        /* =====================================================
           NAV LABEL
        ===================================================== */

        .nav-label {

            padding:
                14px 12px 7px;

            color:
                rgba(255,255,255,.38);

            font-size: 9px;

            font-weight: 900;

            letter-spacing: 1.7px;

            text-transform: uppercase;

            white-space: nowrap;

        }


        /* =====================================================
           NAVIGATION
        ===================================================== */

        .admin-nav {

            margin-bottom: 5px;

        }


        .admin-nav a {

            position: relative;

            display: flex;

            align-items: center;

            gap: 13px;

            min-height: 48px;

            padding:
                11px 13px;

            margin-bottom: 5px;

            border-radius: 14px;

            color:
                rgba(255,255,255,.72);

            text-decoration: none;

            font-size: 14px;

            font-weight: 600;

            white-space: nowrap;

            transition:
                background .2s ease,
                color .2s ease,
                transform .2s ease;

        }


        .admin-nav a i {

            width: 23px;

            min-width: 23px;

            text-align: center;

            font-size: 18px;

        }


        .admin-nav a:hover {

            color: white;

            background:
                rgba(255,255,255,.09);

            transform:
                translateX(2px);

        }


        .admin-nav a.active {

            color: white;

            background:
                linear-gradient(
                    135deg,
                    rgba(37,99,235,.65),
                    rgba(6,182,212,.25)
                );

            box-shadow:
                0 8px 20px
                rgba(0,0,0,.10);

        }


        .admin-nav a.active::before {

            content: "";

            position: absolute;

            left: 0;
            top: 9px;
            bottom: 9px;

            width: 3px;

            border-radius: 10px;

            background: #60a5fa;

        }


        /* =====================================================
           SIDEBAR FOOTER
        ===================================================== */

        .sidebar-footer {

            margin-top: 25px;

            padding-top: 15px;

            border-top:
                1px solid
                rgba(255,255,255,.10);

        }


        .logout-button {

            display: flex;

            align-items: center;

            gap: 13px;

            width: 100%;

            border: 0;

            background: transparent;

            color:
                rgba(255,255,255,.62);

            padding:
                11px 13px;

            border-radius: 13px;

            font-size: 14px;

            transition: .2s ease;

        }


        .logout-button:hover {

            background:
                rgba(239,68,68,.12);

            color: #fecaca;

        }


        .logout-button i {

            width: 23px;

            text-align: center;

            font-size: 18px;

        }


        /* =====================================================
           MAIN
        ===================================================== */

        .admin-main {

            margin-left: var(--sidebar-width);

            min-height: 100vh;

            transition:
                margin-left .28s ease;

        }


        /* =====================================================
           COLLAPSED SIDEBAR
        ===================================================== */

        body.sidebar-collapsed .admin-sidebar {

            width: var(--sidebar-mini);

        }


        body.sidebar-collapsed .admin-main {

            margin-left: var(--sidebar-mini);

        }


        body.sidebar-collapsed .brand {

            justify-content: center;

            padding-left: 0;
            padding-right: 0;

        }


        body.sidebar-collapsed .brand-text,
        body.sidebar-collapsed .nav-label,
        body.sidebar-collapsed .nav-text,
        body.sidebar-collapsed .logout-text {

            opacity: 0;

            width: 0;

            overflow: hidden;

            transform: translateX(-10px);

        }


        body.sidebar-collapsed .admin-nav a {

            justify-content: center;

            padding-left: 0;
            padding-right: 0;

        }


        body.sidebar-collapsed .admin-nav a i {

            margin: 0;

        }


        body.sidebar-collapsed .logout-button {

            justify-content: center;

            padding-left: 0;
            padding-right: 0;

        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .admin-topbar {

            position: sticky;

            top: 0;

            z-index: 1000;

            height: 76px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding:
                0 30px;

            background:
                rgba(255,255,255,.93);

            backdrop-filter:
                blur(15px);

            border-bottom:
                1px solid #e7edf5;

            box-shadow:
                0 5px 25px
                rgba(30,60,100,.04);

        }


        .top-left {

            display: flex;

            align-items: center;

            gap: 14px;

            min-width: 0;

        }


        .sidebar-toggle {

            width: 42px;
            height: 42px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid #e2e8f0;

            border-radius: 12px;

            background: white;

            color: #2563eb;

            font-size: 20px;

            transition: .2s ease;

        }


        .sidebar-toggle:hover {

            background: #edf5ff;

            transform:
                translateY(-1px);

        }


        .top-title {

            font-size: 15px;

            font-weight: 900;

            color: #172554;

        }


        .top-subtitle {

            color: #94a3b8;

            font-size: 11px;

            margin-top: 2px;

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

            width: 43px;
            height: 43px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 50%;

            color: white;

            font-weight: 900;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #06b6d4
                );

            box-shadow:
                0 7px 18px
                rgba(37,99,235,.18);

        }


        .profile-name {

            font-size: 13px;

            font-weight: 800;

            color: #172554;

        }


        .profile-role {

            font-size: 10px;

            color: #94a3b8;

            margin-top: 2px;

        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .admin-content {

            max-width: 1550px;

            margin: auto;

            padding:
                30px;

        }


        /* =====================================================
           MOBILE OVERLAY
        ===================================================== */

        .sidebar-overlay {

            display: none;

            position: fixed;

            inset: 0;

            background:
                rgba(15,23,42,.45);

            backdrop-filter:
                blur(2px);

            z-index: 1040;

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 991.98px) {

            .admin-sidebar {

                transform:
                    translateX(-100%);

                width: 270px;

            }


            .admin-sidebar.mobile-show {

                transform:
                    translateX(0);

            }


            .admin-main {

                margin-left: 0 !important;

            }


            body.sidebar-collapsed .admin-sidebar {

                width: 270px;

            }


            body.sidebar-collapsed .admin-sidebar .brand-text,
            body.sidebar-collapsed .admin-sidebar .nav-label,
            body.sidebar-collapsed .admin-sidebar .nav-text,
            body.sidebar-collapsed .admin-sidebar .logout-text {

                opacity: 1;

                width: auto;

                transform: none;

            }


            body.sidebar-collapsed .admin-sidebar .brand {

                justify-content: flex-start;

            }


            body.sidebar-collapsed .admin-sidebar .admin-nav a {

                justify-content: flex-start;

                padding-left: 13px;
                padding-right: 13px;

            }


            body.sidebar-collapsed .admin-sidebar .logout-button {

                justify-content: flex-start;

                padding-left: 13px;
                padding-right: 13px;

            }


            .sidebar-overlay.show {

                display: block;

            }


            .admin-topbar {

                height: 70px;

                padding:
                    0 18px;

            }


            .admin-content {

                padding:
                    22px 18px 45px;

            }

        }


        @media (max-width: 575.98px) {

            .admin-topbar {

                padding:
                    0 14px;

            }


            .top-subtitle {

                display: none;

            }


            .profile-name,
            .profile-role {

                display: none;

            }


            .profile-circle {

                width: 39px;
                height: 39px;

            }


            .admin-content {

                padding:
                    18px 14px 35px;

            }

        }


        /* =====================================================
           GLOBAL DASHBOARD HELPERS
        ===================================================== */

        .dashboard-card {

            border: 1px solid #e7edf6;

            background: white;

            border-radius: 22px;

            box-shadow:
                0 10px 30px
                rgba(30,60,100,.055);

            transition:
                transform .2s ease,
                box-shadow .2s ease;

        }


        .dashboard-card:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 16px 38px
                rgba(30,60,100,.09);

        }

    </style>

    @stack('styles')

</head>


<body>


<div class="admin-shell">


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside
        class="admin-sidebar"
        id="adminSidebar"
    >


        {{-- LOGO ZAVIER --}}

        <a
            href="{{ route('admin.dashboard') }}"
            class="brand"
        >

            <img
                src="{{ asset('images/zavier-logo.png') }}"
                alt="ZAVIER"
                class="brand-logo"
            >

            <span class="brand-text">

                <span class="brand-name">
                    ZAVIER
                </span>

                <span class="brand-subtitle">
                    LEARNING CENTER
                </span>

            </span>

        </a>


        {{-- =================================================
             UTAMA
        ================================================== --}}

        <div class="nav-label">
            Utama
        </div>


        <nav class="admin-nav">


            {{-- DASHBOARD --}}

            <a
                href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                title="Dashboard"
            >

                <i class="bi bi-grid-1x2-fill"></i>

                <span class="nav-text">
                    Dashboard
                </span>

            </a>


            {{-- BANK SOAL --}}

            <a
                href="{{ route('admin.bank-soal.index') }}"
                class="{{ request()->routeIs('admin.bank-soal.*') ? 'active' : '' }}"
                title="Bank Soal"
            >

                <i class="bi bi-journal-text"></i>

                <span class="nav-text">
                    Bank Soal
                </span>

            </a>


            {{-- PAKET UJIAN --}}

            <a
                href="{{ url('/admin/paket-ujian') }}"
                class="{{ request()->is('admin/paket-ujian*') ? 'active' : '' }}"
                title="Paket Ujian"
            >

                <i class="bi bi-collection-fill"></i>

                <span class="nav-text">
                    Paket Ujian
                </span>

            </a>

        </nav>


        {{-- =================================================
             PESERTA
        ================================================== --}}

        <div class="nav-label">
            Peserta
        </div>


        <nav class="admin-nav">


            {{-- MENTOR --}}

            <a
                href="{{ route('admin.mentor.index') }}"
                class="{{ request()->routeIs('admin.mentor.*') ? 'active' : '' }}"
                title="Mentor"
            >

                <i class="bi bi-person-workspace"></i>

                <span class="nav-text">
                    Mentor
                </span>

            </a>


            {{-- MURID --}}

            <a
                href="{{ route('admin.murid') }}"
                class="{{ request()->routeIs('admin.murid') ? 'active' : '' }}"
                title="Murid"
            >

                <i class="bi bi-people-fill"></i>

                <span class="nav-text">
                    Murid
                </span>

            </a>


            {{-- RIWAYAT UJIAN --}}

            <a
                href="{{ route('admin.riwayat-kecerdasan.index') }}"
                class="{{ request()->routeIs('admin.riwayat-kecerdasan.*') ? 'active' : '' }}"
                title="Riwayat Ujian"
            >

                <i class="bi bi-clock-history"></i>

                <span class="nav-text">
                    Riwayat Ujian
                </span>

            </a>

        </nav>


        {{-- =================================================
             LOGOUT
        ================================================== --}}

        <div class="sidebar-footer">

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-button"
                    title="Keluar"
                >

                    <i class="bi bi-box-arrow-right"></i>

                    <span class="logout-text">
                        Keluar
                    </span>

                </button>

            </form>

        </div>


    </aside>


    {{-- OVERLAY MOBILE --}}

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
        onclick="closeMobileSidebar()"
    ></div>


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <div class="admin-main">


        {{-- =================================================
             TOPBAR
        ================================================== --}}

        <header class="admin-topbar">


            <div class="top-left">


                {{-- TOGGLE SIDEBAR --}}

                <button
                    type="button"
                    class="sidebar-toggle"
                    id="sidebarToggle"
                    title="Buka / Tutup Menu"
                >

                    <i
                        class="bi bi-layout-sidebar-inset"
                        id="sidebarToggleIcon"
                    ></i>

                </button>


                <div>

                    <div class="top-title">

                        @yield(
                            'title',
                            'Dashboard Admin'
                        )

                    </div>

                    <div class="top-subtitle">

                        Panel administrasi ZAVIER Learning Center

                    </div>

                </div>

            </div>


            {{-- =================================================
                 PROFILE
            ================================================== --}}

            <div class="profile-area">


                <div class="text-end d-none d-sm-block">

                    <div class="profile-name">

                        {{ Auth::user()->name ?? 'Admin' }}

                    </div>

                    <div class="profile-role">

                        Super Admin

                    </div>

                </div>


                <div class="profile-circle">

                    {{ strtoupper(
                        substr(
                            Auth::user()->name ?? 'A',
                            0,
                            1
                        )
                    ) }}

                </div>

            </div>


        </header>


        {{-- =================================================
             CONTENT
        ================================================== --}}

        <main class="admin-content">

            @yield('content')

        </main>


    </div>

</div>


{{-- BOOTSTRAP JS --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<script>

    const sidebar =
        document.getElementById('adminSidebar');

    const sidebarToggle =
        document.getElementById('sidebarToggle');

    const sidebarToggleIcon =
        document.getElementById('sidebarToggleIcon');

    const sidebarOverlay =
        document.getElementById('sidebarOverlay');


    /* =====================================================
       LOAD STATUS SIDEBAR
    ===================================================== */

    const sidebarState =
        localStorage.getItem('zavier_admin_sidebar');


    if (
        sidebarState === 'collapsed'
        &&
        window.innerWidth > 991
    ) {

        document.body.classList.add(
            'sidebar-collapsed'
        );

    }


    /* =====================================================
       TOGGLE
    ===================================================== */

    sidebarToggle.addEventListener(
        'click',
        function() {

            if (window.innerWidth <= 991) {

                sidebar.classList.toggle(
                    'mobile-show'
                );

                sidebarOverlay.classList.toggle(
                    'show'
                );

                return;

            }


            document.body.classList.toggle(
                'sidebar-collapsed'
            );


            const collapsed =
                document.body.classList.contains(
                    'sidebar-collapsed'
                );


            localStorage.setItem(
                'zavier_admin_sidebar',
                collapsed
                    ? 'collapsed'
                    : 'open'
            );


            updateSidebarIcon();

        }
    );


    /* =====================================================
       ICON
    ===================================================== */

    function updateSidebarIcon() {

        const collapsed =
            document.body.classList.contains(
                'sidebar-collapsed'
            );


        if (collapsed) {

            sidebarToggleIcon.className =
                'bi bi-layout-sidebar-inset';

        } else {

            sidebarToggleIcon.className =
                'bi bi-layout-sidebar-inset-reverse';

        }

    }


    updateSidebarIcon();


    /* =====================================================
       MOBILE CLOSE
    ===================================================== */

    function closeMobileSidebar() {

        sidebar.classList.remove(
            'mobile-show'
        );

        sidebarOverlay.classList.remove(
            'show'
        );

    }


    /* =====================================================
       RESIZE
    ===================================================== */

    window.addEventListener(
        'resize',
        function() {

            if (window.innerWidth > 991) {

                closeMobileSidebar();

            }

        }
    );

</script>


@stack('scripts')


</body>

</html>