<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'ZAVIER Learning Center')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f8fd;
            color: #17233c;
            font-family: "Segoe UI", Arial, sans-serif;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .navbar-zavier {

            background: rgba(255,255,255,.97);

            border-bottom: 1px solid #e6edf6;

            box-shadow:
                0 4px 20px rgba(30,60,100,.06);

            min-height: 76px;

            position: sticky;

            top: 0;

            z-index: 9999;
        }


        .navbar-container {

            max-width: 1500px;

            margin: auto;

            padding:
                0 28px;
        }


        /* =====================================================
           BRAND ZAVIER
        ===================================================== */

        .zavier-brand {

            display: flex;

            align-items: center;

            gap: 12px;

            text-decoration: none;

            color: #174ea6;

            min-width: 245px;
        }


        .zavier-logo {

            width: 48px;

            height: 48px;

            object-fit: contain;

            border-radius: 12px;

            background: white;

            padding: 3px;

            box-shadow:
                0 5px 15px rgba(37,99,235,.12);
        }


        .zavier-brand-text {

            line-height: 1.05;
        }


        .zavier-name {

            font-size: 21px;

            font-weight: 900;

            letter-spacing: .3px;

            color: #174ea6;
        }


        .zavier-subtitle {

            display: block;

            margin-top: 4px;

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 1.5px;

            color: #7b8ba5;
        }


        /* =====================================================
           MENU
        ===================================================== */

        .zavier-menu {

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 5px;

            flex: 1;
        }


        .zavier-nav-link {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            color: #64748b;

            text-decoration: none;

            font-size: 15px;

            font-weight: 650;

            padding: 11px 17px;

            border-radius: 14px;

            transition: all .2s ease;

            white-space: nowrap;
        }


        .zavier-nav-link i {

            font-size: 17px;
        }


        .zavier-nav-link:hover {

            color: #1769ff;

            background: #eef5ff;

            transform: translateY(-1px);
        }


        .zavier-nav-link.active {

            color: #1769ff;

            background:
                linear-gradient(
                    135deg,
                    #edf5ff,
                    #e5f0ff
                );

            box-shadow:
                0 5px 16px rgba(37,99,235,.08);
        }


        /* =====================================================
           SEGERA
        ===================================================== */

        .coming-soon {

            margin-left: 2px;

            padding: 4px 8px;

            border-radius: 20px;

            font-size: 9px;

            font-weight: 800;

            background: #f1ebff;

            color: #7955df;
        }


        /* =====================================================
           PROFILE
        ===================================================== */

        .zavier-profile {

            display: flex;

            align-items: center;

            gap: 11px;

            min-width: 220px;

            justify-content: flex-end;
        }


        .zavier-avatar {

            width: 44px;

            height: 44px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            color: white;

            font-size: 17px;

            font-weight: 800;

            background:
                linear-gradient(
                    135deg,
                    #1769ff,
                    #11b9d5
                );

            box-shadow:
                0 6px 18px rgba(37,99,235,.20);
        }


        .zavier-profile-name {

            color: #17233c;

            font-size: 14px;

            font-weight: 800;

            line-height: 1.2;
        }


        .zavier-profile-role {

            display: block;

            color: #7b879b;

            font-size: 11px;

            margin-top: 3px;
        }


        .zavier-profile-arrow {

            color: #64748b;

            font-size: 16px;

            margin-left: 4px;
        }


        /* =====================================================
           LOGOUT
        ===================================================== */

        .zavier-logout {

            width: 42px;

            height: 42px;

            border-radius: 12px;

            border: 1px solid #fecaca;

            background: white;

            color: #ef4444;

            display: flex;

            align-items: center;

            justify-content: center;

            transition: .2s;

        }


        .zavier-logout:hover {

            background: #fff1f2;

            transform: translateY(-1px);
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .zavier-content {

            min-height: calc(100vh - 76px);
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width: 1100px) {

            .zavier-brand {

                min-width: auto;
            }

            .zavier-profile {

                min-width: auto;
            }

            .zavier-profile-name,
            .zavier-profile-role {

                display: none;
            }

        }


        @media(max-width: 991px) {

            .navbar-container {

                padding: 0 18px;
            }

            .zavier-menu {

                display: none;
            }

            .zavier-brand {

                flex: 1;
            }

        }


        @media(max-width: 600px) {

            .navbar-zavier {

                min-height: 68px;
            }

            .navbar-container {

                padding: 0 13px;
            }

            .zavier-logo {

                width: 42px;

                height: 42px;
            }

            .zavier-name {

                font-size: 18px;
            }

            .zavier-subtitle {

                font-size: 8px;
            }

            .zavier-avatar {

                width: 39px;

                height: 39px;
            }

            .zavier-logout {

                width: 38px;

                height: 38px;
            }

        }

    </style>

    @stack('styles')

</head>


<body>


<!-- =========================================================
     NAVBAR ZAVIER
========================================================= -->

<nav class="navbar-zavier">

    <div
        class="navbar-container"
        style="
            display:flex;
            align-items:center;
            min-height:76px;
        "
    >


        <!-- =================================================
             LOGO + BRAND
        ================================================== -->

        <a
            href="{{ route('murid.dashboard') }}"
            class="zavier-brand"
        >

            <img
                src="{{ asset('images/zavier-logo.png') }}"
                alt="ZAVIER Learning Center"
                class="zavier-logo"
            >

            <div class="zavier-brand-text">

                <div class="zavier-name">
                    ZAVIER
                </div>

                <span class="zavier-subtitle">
                    LEARNING CENTER
                </span>

            </div>

        </a>


        <!-- =================================================
             MENU
        ================================================== -->

        <div class="zavier-menu">


            <!-- DASHBOARD -->

            <a
                href="{{ route('murid.dashboard') }}"
                class="zavier-nav-link
                {{ request()->routeIs('murid.dashboard') ? 'active' : '' }}"
            >

                <i class="bi bi-grid"></i>

                Dashboard

            </a>


            <!-- PAKET SOAL -->

            <a
                href="{{ route('murid.paket-soal') }}"
                class="zavier-nav-link
                {{ request()->routeIs('murid.paket-soal') || request()->routeIs('murid.ujian') ? 'active' : '' }}"
            >

                <i class="bi bi-journal-text"></i>

                Paket Soal

            </a>


            <!-- RIWAYAT -->

            <a
                href="{{ route('murid.riwayat') }}"
                class="zavier-nav-link
                {{ request()->routeIs('murid.riwayat') || request()->routeIs('murid.hasil') || request()->routeIs('murid.hasil.terakhir') ? 'active' : '' }}"
            >

                <i class="bi bi-clock-history"></i>

                Riwayat

            </a>


            <!-- RANKING -->

            <a
                href="#"
                class="zavier-nav-link"
                onclick="return false;"
            >

                <i class="bi bi-trophy"></i>

                Ranking

                <span class="coming-soon">
                    Segera
                </span>

            </a>


        </div>


        <!-- =================================================
             PROFILE
        ================================================== -->

        <div class="zavier-profile">


            <div class="zavier-avatar">

                {{ strtoupper(
                    substr(
                        auth()->user()->name,
                        0,
                        1
                    )
                ) }}

            </div>


            <div>

                <div class="zavier-profile-name">

                    {{ auth()->user()->name }}

                </div>

                <span class="zavier-profile-role">

                    Murid

                </span>

            </div>


            <i
                class="bi bi-chevron-down zavier-profile-arrow"
            ></i>


            <!-- LOGOUT -->

            <form
                method="POST"
                action="{{ route('logout') }}"
                style="margin-left:8px;"
            >

                @csrf

                <button
                    type="submit"
                    class="zavier-logout"
                    title="Keluar"
                >

                    <i class="bi bi-box-arrow-right"></i>

                </button>

            </form>


        </div>

    </div>

</nav>


<!-- =========================================================
     CONTENT
========================================================= -->

<main class="zavier-content">

    @yield('content')

</main>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


@stack('scripts')

</body>

</html>