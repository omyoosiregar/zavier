<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Riwayat Ujian - ZAVIER Learning Center
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <script
        src="https://cdn.jsdelivr.net/npm/chart.js"
    ></script>


    <style>

        * {
            box-sizing: border-box;
        }


        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }


        body {

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #f5f9ff 0%,
                    #eef5ff 100%
                );

            color: #17386f;
        }


        a {
            text-decoration: none;
            color: inherit;
        }


        /*
        |--------------------------------------------------------------------------
        | PAGE
        |--------------------------------------------------------------------------
        */

        .page {

            max-width: 1750px;

            margin: 0 auto;

            padding:
                30px
                34px
                45px;
        }


        /*
        |--------------------------------------------------------------------------
        | PAGE HEADER
        |--------------------------------------------------------------------------
        */

        .page-header {

            margin-bottom: 23px;
        }


        .page-header h1 {

            margin: 0;

            color: #102f67;

            font-size: 28px;

            font-weight: 800;

            letter-spacing: -.6px;
        }


        .page-header p {

            margin:
                7px 0 0;

            color: #8195b6;

            font-size: 14px;
        }


        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        .stats {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 18px;

            margin-bottom: 24px;
        }


        .stat-card {

            background: #ffffff;

            border:
                1px solid #e5edf8;

            border-radius: 22px;

            padding:
                21px
                23px;

            display: flex;

            align-items: center;

            gap: 16px;

            min-height: 100px;

            box-shadow:
                0 10px 30px
                rgba(35, 76, 130, .06);
        }


        .stat-icon {

            width: 54px;

            height: 54px;

            flex-shrink: 0;

            border-radius: 16px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 23px;
        }


        .blue-icon {

            background: #e8f1ff;

            color: #2167ef;
        }


        .green-icon {

            background: #e4faef;

            color: #0baa65;
        }


        .orange-icon {

            background: #fff2df;

            color: #f08a13;
        }


        .stat-content small {

            display: block;

            margin-bottom: 4px;

            color: #7c91b2;

            font-size: 12px;

            font-weight: 700;
        }


        .stat-content strong {

            display: block;

            color: #17376f;

            font-size: 25px;

            line-height: 1.1;

            font-weight: 800;
        }


        /*
        |--------------------------------------------------------------------------
        | MAIN GRID
        |--------------------------------------------------------------------------
        */

        .main-grid {

            display: grid;

            grid-template-columns:
                minmax(0, 1.7fr)
                minmax(360px, .95fr);

            gap: 24px;

            height: 690px;

            align-items: stretch;
        }


        /*
        |--------------------------------------------------------------------------
        | CARD
        |--------------------------------------------------------------------------
        */

        .card {

            background: #ffffff;

            border:
                1px solid #e4ebf6;

            border-radius: 25px;

            overflow: hidden;

            box-shadow:
                0 12px 38px
                rgba(35, 76, 130, .07);
        }


        /*
        |--------------------------------------------------------------------------
        | GRAPH CARD
        |--------------------------------------------------------------------------
        */

        .graph-card {

            height: 100%;

            padding:
                26px
                28px
                25px;

            display: flex;

            flex-direction: column;
        }


        .card-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            flex-shrink: 0;

            margin-bottom: 18px;
        }


        .title-area {

            display: flex;

            align-items: center;

            gap: 14px;
        }


        .title-icon {

            width: 52px;

            height: 52px;

            flex-shrink: 0;

            border-radius: 16px;

            background: #e9f2ff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 24px;

            color: #2167ef;
        }


        .card-header h2 {

            margin: 0;

            color: #12366f;

            font-size: 20px;

            font-weight: 800;

            letter-spacing: -.2px;
        }


        .card-header p {

            margin:
                4px 0 0;

            color: #91a1ba;

            font-size: 13px;
        }


        .count-badge {

            padding:
                10px
                15px;

            border-radius: 13px;

            background: #edf4ff;

            color: #1763e8;

            font-size: 12px;

            font-weight: 800;

            white-space: nowrap;
        }


        /*
        |--------------------------------------------------------------------------
        | CHART
        |--------------------------------------------------------------------------
        */

        .chart-wrapper {

            position: relative;

            flex: 1;

            min-height: 0;

            width: 100%;
        }


        .chart-wrapper canvas {

            width: 100% !important;

            height: 100% !important;
        }


        /*
        |--------------------------------------------------------------------------
        | HISTORY CARD
        |--------------------------------------------------------------------------
        */

        .history-card {

            height: 100%;

            display: flex;

            flex-direction: column;

            min-height: 0;
        }


        .history-header {

            padding:
                25px
                25px
                18px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: space-between;
        }


        .history-title {

            display: flex;

            align-items: center;

            gap: 13px;

            min-width: 0;
        }


        .history-title-icon {

            width: 52px;

            height: 52px;

            flex-shrink: 0;

            border-radius: 16px;

            background: #eaf3ff;

            color: #2167ef;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 24px;
        }


        .history-title h2 {

            margin: 0;

            color: #12366f;

            font-size: 20px;

            font-weight: 800;

            white-space: nowrap;
        }


        .history-title p {

            margin:
                4px 0 0;

            color: #91a1ba;

            font-size: 13px;
        }


        .latest-label {

            padding:
                9px
                13px;

            border-radius: 12px;

            background: #edf4ff;

            color: #1763e8;

            font-size: 11px;

            font-weight: 800;

            white-space: nowrap;
        }


        /*
        |--------------------------------------------------------------------------
        | HISTORY LIST
        |--------------------------------------------------------------------------
        */

        .history-list {

            flex: 1;

            min-height: 0;

            overflow-y: auto;

            padding:
                0
                18px
                18px
                25px;

            scrollbar-width: thin;

            scrollbar-color:
                #b7c9e4
                transparent;
        }


        .history-list::-webkit-scrollbar {

            width: 7px;
        }


        .history-list::-webkit-scrollbar-track {

            background: transparent;
        }


        .history-list::-webkit-scrollbar-thumb {

            background: #b9cbe5;

            border-radius: 20px;
        }


        /*
        |--------------------------------------------------------------------------
        | HISTORY ITEM
        |--------------------------------------------------------------------------
        */

        .history-item {

            display: flex;

            align-items: center;

            gap: 13px;

            padding:
                14px
                8px;

            border-bottom:
                1px solid #edf1f7;

            transition:
                background .2s ease,
                padding .2s ease;

            cursor: pointer;
        }


        .history-item:last-child {

            border-bottom: none;
        }


        .history-item:hover {

            background: #f5f9ff;

            border-radius: 15px;

            padding-left: 12px;

            padding-right: 12px;
        }


        /*
        |--------------------------------------------------------------------------
        | HISTORY ICON
        |--------------------------------------------------------------------------
        */

        .history-icon {

            width: 45px;

            height: 45px;

            flex-shrink: 0;

            border-radius: 14px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;
        }


        .history-icon.kecermatan {

            background: #edf4ff;

            color: #2167ef;
        }


        .history-icon.kepribadian {

            background: #e5faef;

            color: #0baa65;
        }


        /*
        |--------------------------------------------------------------------------
        | HISTORY INFO
        |--------------------------------------------------------------------------
        */

        .history-info {

            min-width: 0;

            flex: 1;
        }


        .history-info strong {

            display: block;

            color: #17386f;

            font-size: 14px;

            font-weight: 800;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .history-info span {

            display: block;

            margin-top: 5px;

            color: #93a4bd;

            font-size: 11px;
        }


        /*
        |--------------------------------------------------------------------------
        | TEST BADGE
        |--------------------------------------------------------------------------
        */

        .test-badge {

            display: inline-flex !important;

            width: fit-content;

            margin-top: 5px;

            padding:
                3px
                8px;

            border-radius: 8px;

            font-size: 9px !important;

            font-weight: 800;

            line-height: 1.2;
        }


        .test-badge.kecermatan {

            background: #edf4ff;

            color: #2167ef;
        }


        .test-badge.kepribadian {

            background: #e5faef;

            color: #0baa65;
        }


        /*
        |--------------------------------------------------------------------------
        | SCORE
        |--------------------------------------------------------------------------
        */

        .history-score {

            min-width: 70px;

            padding:
                9px
                10px;

            border-radius: 12px;

            text-align: center;

            font-size: 13px;

            font-weight: 800;

            flex-shrink: 0;
        }


        .score-good {

            background: #e5faef;

            color: #0ba766;
        }


        .score-medium {

            background: #fff4dd;

            color: #e88900;
        }


        .score-low {

            background: #ffe8ec;

            color: #ee334b;
        }


        /*
        |--------------------------------------------------------------------------
        | ARROW
        |--------------------------------------------------------------------------
        */

        .history-arrow {

            color: #9aacc4;

            font-size: 20px;

            flex-shrink: 0;

            transition: .2s;
        }


        .history-item:hover
        .history-arrow {

            color: #2167ef;

            transform:
                translateX(3px);
        }


        /*
        |--------------------------------------------------------------------------
        | EMPTY
        |--------------------------------------------------------------------------
        */

        .empty-history {

            min-height: 300px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            text-align: center;

            color: #91a1b9;
        }


        .empty-icon {

            width: 65px;

            height: 65px;

            border-radius: 20px;

            background: #edf4ff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 28px;

            margin-bottom: 15px;
        }


        .empty-history strong {

            color: #38547f;

            margin-bottom: 5px;
        }


        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1200px) {

            .page {

                padding-left: 25px;

                padding-right: 25px;
            }


            .main-grid {

                grid-template-columns:
                    minmax(0, 1.45fr)
                    minmax(330px, .9fr);

                height: 650px;
            }
        }


        @media (max-width: 900px) {

            .page {

                padding:
                    22px
                    16px
                    35px;
            }


            .stats {

                grid-template-columns:
                    1fr;
            }


            .main-grid {

                grid-template-columns:
                    1fr;

                height: auto;
            }


            .graph-card {

                height: 520px;
            }


            .history-card {

                height: 500px;
            }
        }


        @media (max-width: 600px) {

            .page-header h1 {

                font-size: 24px;
            }


            .graph-card {

                padding:
                    20px
                    16px;
            }


            .card-header {

                align-items: flex-start;
            }


            .card-header h2 {

                font-size: 17px;
            }


            .card-header p {

                font-size: 11px;
            }


            .count-badge {

                display: none;
            }


            .history-header {

                padding:
                    20px
                    18px
                    15px;
            }


            .history-title h2 {

                font-size: 17px;
            }


            .history-title p {

                font-size: 11px;
            }


            .latest-label {

                display: none;
            }


            .history-list {

                padding-left: 18px;
            }


            .history-score {

                min-width: 58px;

                font-size: 12px;
            }
        }

    </style>

</head>


<body>


    {{-- =========================================================
         NAVBAR
    ========================================================== --}}

    @include('layouts.navbar-murid')


    {{-- =========================================================
         PAGE
    ========================================================== --}}

    <main class="page">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="page-header">

            <h1>
                Riwayat Ujian
            </h1>

            <p>
                Lihat perkembangan nilai dan seluruh hasil ujian Anda.
            </p>

        </div>


        {{-- =====================================================
             STATISTIK
        ====================================================== --}}

        <div class="stats">


            {{-- TOTAL UJIAN --}}

            <div class="stat-card">

                <div class="stat-icon blue-icon">

                    <i class="bi bi-journal-check"></i>

                </div>

                <div class="stat-content">

                    <small>
                        Total Ujian
                    </small>

                    <strong>
                        {{ $totalUjian }}
                    </strong>

                </div>

            </div>


            {{-- RATA-RATA --}}

            <div class="stat-card">

                <div class="stat-icon green-icon">

                    <i class="bi bi-graph-up-arrow"></i>

                </div>

                <div class="stat-content">

                    <small>
                        Rata-rata Nilai
                    </small>

                    <strong>

                        {{ number_format(
                            $rataRata ?? 0,
                            2,
                            '.',
                            ''
                        ) }}

                    </strong>

                </div>

            </div>


            {{-- NILAI TERTINGGI --}}

            <div class="stat-card">

                <div class="stat-icon orange-icon">

                    <i class="bi bi-trophy-fill"></i>

                </div>

                <div class="stat-content">

                    <small>
                        Nilai Tertinggi
                    </small>

                    <strong>

                        {{ number_format(
                            $nilaiTertinggi ?? 0,
                            2,
                            '.',
                            ''
                        ) }}

                    </strong>

                </div>

            </div>


        </div>


        {{-- =====================================================
             MAIN GRID
        ====================================================== --}}

        <div class="main-grid">


            {{-- =================================================
                 KIRI : GRAFIK
            ================================================== --}}

            <section class="card graph-card">


                <div class="card-header">


                    <div class="title-area">


                        <div class="title-icon">

                            <i class="bi bi-bar-chart-line-fill"></i>

                        </div>


                        <div>

                            <h2>
                                Grafik Perkembangan Nilai
                            </h2>

                            <p>
                                Lihat tren nilai ujian Anda dari waktu ke waktu
                            </p>

                        </div>


                    </div>


                    <div class="count-badge">

                        {{ $totalUjian }}

                        Ujian

                    </div>


                </div>


                <div class="chart-wrapper">

                    <canvas
                        id="nilaiChart"
                    ></canvas>

                </div>


            </section>


            {{-- =================================================
                 KANAN : RIWAYAT
            ================================================== --}}

            <section class="card history-card">


                {{-- HEADER --}}

                <div class="history-header">


                    <div class="history-title">


                        <div class="history-title-icon">

                            <i class="bi bi-clock-history"></i>

                        </div>


                        <div>

                            <h2>
                                Riwayat Ujian Terbaru
                            </h2>

                            <p>
                                Daftar ujian yang telah Anda kerjakan
                            </p>

                        </div>


                    </div>


                    <div class="latest-label">
                        Terbaru
                    </div>


                </div>


                {{-- =================================================
                     HISTORY LIST
                ================================================== --}}

                <div class="history-list">


                    @forelse(
                        $hasilUjians
                        as $hasil
                    )


                        @php

                            $nilai =
                                (float) (
                                    $hasil->nilai ?? 0
                                );


                            if (
                                $nilai >= 80
                            ) {

                                $scoreClass =
                                    'score-good';

                            } elseif (
                                $nilai >= 60
                            ) {

                                $scoreClass =
                                    'score-medium';

                            } else {

                                $scoreClass =
                                    'score-low';
                            }


                            $isKepribadian =
                                $hasil->tipe ===
                                'kepribadian';


                            $isKecermatan =
                                $hasil->tipe ===
                                'kecermatan';


                            $icon =
                                $hasil->icon
                                ?? (
                                    $isKepribadian
                                        ? 'bi-person-badge-fill'
                                        : 'bi-bullseye'
                                );


                        @endphp


                        {{-- =================================================
                             ITEM RIWAYAT
                        ================================================== --}}

                        <a
                            href="{{ $hasil->url }}"
                            class="history-item"
                        >


                            {{-- ICON --}}

                            <div
                                class="history-icon {{ $hasil->warna }}"
                            >

                                <i
                                    class="bi {{ $icon }}"
                                ></i>

                            </div>


                            {{-- INFORMASI --}}

                            <div class="history-info">


                                <strong>

                                    {{ $hasil->nama_paket }}

                                </strong>


                                <span>

                                    <i
                                        class="bi bi-calendar3 me-1"
                                    ></i>

                                    {{ $hasil->tanggal
                                        ? $hasil->tanggal->format('d M Y, H:i')
                                        : '-'
                                    }}

                                </span>


                                {{-- JENIS TES --}}

                                <span
                                    class="test-badge {{ $hasil->warna }}"
                                >

                                    @if(
                                        $isKepribadian
                                    )

                                        <i
                                            class="bi bi-person-badge me-1"
                                        ></i>

                                        Kepribadian

                                    @else

                                        <i
                                            class="bi bi-bullseye me-1"
                                        ></i>

                                        Kecermatan

                                    @endif

                                </span>


                            </div>


                            {{-- NILAI --}}

                            <div
                                class="history-score {{ $scoreClass }}"
                            >

                                {{ number_format(
                                    $nilai,
                                    2,
                                    '.',
                                    ''
                                ) }}

                            </div>


                            {{-- ARROW --}}

                            <div class="history-arrow">

                                <i
                                    class="bi bi-chevron-right"
                                ></i>

                            </div>


                        </a>


                    @empty


                        {{-- EMPTY --}}

                        <div class="empty-history">


                            <div class="empty-icon">

                                <i
                                    class="bi bi-clipboard-x"
                                ></i>

                            </div>


                            <strong>

                                Belum Ada Riwayat Ujian

                            </strong>


                            <span>

                                Silakan kerjakan paket soal terlebih dahulu.

                            </span>


                        </div>


                    @endforelse


                </div>


            </section>


        </div>


    </main>


    {{-- =========================================================
         CHART JS
    ========================================================== --}}

    <script>

        const chartData = @json(
            $grafikHasil ?? []
        );


        const labels =
            chartData.map(
                item =>
                    item.tanggal
            );


        const values =
            chartData.map(
                item =>
                    item.nilai
            );


        const canvas =
            document.getElementById(
                'nilaiChart'
            );


        if (
            canvas
        ) {

            new Chart(
                canvas,
                {

                    type: 'line',


                    data: {

                        labels: labels,

                        datasets: [

                            {

                                label:
                                    'Nilai',

                                data:
                                    values,

                                borderWidth:
                                    4,

                                borderColor:
                                    '#2167ef',

                                backgroundColor:
                                    'rgba(33, 103, 239, 0.13)',

                                pointBackgroundColor:
                                    '#2167ef',

                                pointBorderColor:
                                    '#ffffff',

                                pointBorderWidth:
                                    3,

                                pointRadius:
                                    5,

                                pointHoverRadius:
                                    7,

                                fill:
                                    true,

                                tension:
                                    .4

                            }

                        ]

                    },


                    options: {

                        responsive:
                            true,

                        maintainAspectRatio:
                            false,


                        interaction: {

                            intersect:
                                false,

                            mode:
                                'index'

                        },


                        plugins: {

                            legend: {

                                display:
                                    false

                            },


                            tooltip: {

                                backgroundColor:
                                    '#142f67',

                                titleColor:
                                    '#ffffff',

                                bodyColor:
                                    '#ffffff',

                                padding:
                                    12,

                                cornerRadius:
                                    10,

                                displayColors:
                                    false,


                                callbacks: {

                                    label:
                                        function(
                                            context
                                        ) {

                                            return (
                                                ' Nilai: ' +
                                                context.parsed.y
                                            );

                                        }

                                }

                            }

                        },


                        scales: {

                            x: {

                                grid: {

                                    display:
                                        false

                                },


                                ticks: {

                                    color:
                                        '#8498b8',

                                    font: {

                                        size:
                                            11,

                                        weight:
                                            '600'

                                    }

                                }

                            },


                            y: {

                                beginAtZero:
                                    true,

                                max:
                                    100,


                                ticks: {

                                    stepSize:
                                        10,

                                    color:
                                        '#8498b8',

                                    font: {

                                        size:
                                            11

                                    }

                                },


                                grid: {

                                    color:
                                        '#e4ebf5',

                                    drawBorder:
                                        false

                                }

                            }

                        }

                    }

                }
            );

        }

    </script>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>


</body>

</html>