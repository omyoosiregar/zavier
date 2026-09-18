<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Hasil Tes Kepribadian - ZAVIER</title>

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(30, 136, 229, .07),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 20%,
                    rgba(13, 202, 240, .06),
                    transparent 30%
                ),
                #f3f9fe;

            color: #12336d;

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .result-navbar {
            width: 100%;

            background: rgba(255,255,255,.97);

            border-bottom: 1px solid #e4edf7;

            box-shadow:
                0 5px 24px rgba(22,42,70,.07);

            position: sticky;

            top: 0;

            z-index: 999;
        }


        .result-navbar-inner {
            max-width: 1180px;

            min-height: 72px;

            margin: auto;

            padding: 0 20px;

            display: flex;

            align-items: center;

            gap: 18px;
        }


        .result-brand {
            display: flex;

            align-items: center;

            gap: 10px;

            text-decoration: none;

            color: #142033;

            flex-shrink: 0;
        }


        .result-brand-logo {
            width: 43px;
            height: 43px;

            border-radius: 11px;

            object-fit: contain;
        }


        .result-brand-text strong {
            display: block;

            font-size: 17px;

            font-weight: 900;

            line-height: 1;
        }


        .result-brand-text span {
            display: block;

            margin-top: 4px;

            font-size: 9px;

            letter-spacing: 2px;

            color: #718096;

            font-weight: 700;
        }


        .result-menu {
            display: flex;

            align-items: center;

            justify-content: center;

            gap: 5px;

            margin-left: auto;
        }


        .result-menu a {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 10px 13px;

            border-radius: 10px;

            color: #667085;

            text-decoration: none;

            font-size: 13px;

            font-weight: 700;

            transition: .2s ease;
        }


        .result-menu a:hover {
            color: #0d6efd;

            background: #edf5ff;
        }


        .result-menu a.active {
            color: #0d6efd;

            background: #edf5ff;
        }


        .result-account {
            margin-left: 5px;

            display: flex;

            align-items: center;

            gap: 8px;

            padding: 5px 10px;

            border: 1px solid #e3e8f0;

            border-radius: 13px;

            background: white;
        }


        .result-avatar {
            width: 34px;
            height: 34px;

            border-radius: 10px;

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

            font-weight: 800;
        }


        .result-account-name {
            font-size: 11px;

            font-weight: 800;

            color: #172554;
        }


        .result-account-role {
            display: block;

            font-size: 9px;

            color: #8792a3;
        }


        /* =====================================================
           MAIN
        ===================================================== */

        .result-page {
            max-width: 1180px;

            margin: auto;

            padding: 26px 20px 45px;
        }


        /* =====================================================
           TOP
        ===================================================== */

        .top-grid {

            display: grid;

            grid-template-columns:
                1.05fr
                .95fr;

            gap: 20px;

            margin-bottom: 18px;
        }


        .result-card {

            background: rgba(255,255,255,.96);

            border: 1px solid #d9eafb;

            border-radius: 13px;

            box-shadow:
                0 8px 25px rgba(25,90,150,.055);
        }


        /* =====================================================
           SCORE CARD
        ===================================================== */

        .score-card {

            min-height: 258px;

            padding: 24px 30px;

            display: flex;

            align-items: center;
        }


        .score-circle-area {

            width: 225px;

            padding-right: 28px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-right: 1px solid #e3edf7;
        }


        .score-circle {

            width: 190px;

            height: 190px;

            border-radius: 50%;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            position: relative;

            background:
                conic-gradient(
                    #1476ed 0deg,
                    #1c8de9 var(--score-degree),
                    #dce7f2 var(--score-degree),
                    #dce7f2 360deg
                );
        }


        .score-circle::before {

            content: "";

            position: absolute;

            width: 168px;

            height: 168px;

            border-radius: 50%;

            background: white;
        }


        .score-number {

            position: relative;

            z-index: 2;

            font-size: 52px;

            line-height: 1;

            font-weight: 850;

            color: #103a82;
        }


        .score-denominator {

            position: relative;

            z-index: 2;

            margin-top: 5px;

            font-size: 15px;

            color: #163e7c;
        }


        .score-content {

            padding-left: 25px;

            flex: 1;
        }


        .score-content h2 {

            margin: 0;

            font-size: 18px;

            font-weight: 800;

            color: #102d68;
        }


        .score-big {

            margin-top: 8px;

            font-size: 38px;

            font-weight: 850;

            color: #103a82;
        }


        .score-big span {

            font-size: 24px;

            font-weight: 500;

            color: #37588f;
        }


        .result-badge {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            margin-top: 8px;

            padding: 9px 21px;

            border-radius: 25px;

            background: #16b86b;

            color: white;

            font-size: 15px;

            font-weight: 750;
        }


        .score-description {

            max-width: 390px;

            margin-top: 12px;

            color: #48628d;

            font-size: 13px;

            line-height: 1.65;
        }


        /* =====================================================
           SUMMARY
        ===================================================== */

        .summary-card {

            min-height: 258px;

            padding: 22px 25px;
        }


        .summary-title {

            margin: 0;

            padding-bottom: 13px;

            border-bottom: 1px solid #e2edf8;

            font-size: 18px;

            font-weight: 800;

            color: #102d68;
        }


        .summary-row {

            min-height: 36px;

            display: flex;

            align-items: center;

            justify-content: space-between;
        }


        .summary-label {

            display: flex;

            align-items: center;

            gap: 11px;

            color: #18376f;

            font-size: 13px;

            font-weight: 650;
        }


        .summary-dot {

            width: 16px;

            height: 16px;

            border-radius: 50%;

            flex-shrink: 0;
        }


        .dot-green {
            background: #13b76a;
        }


        .dot-red {
            background: #ef3d4b;
        }


        .dot-gray {
            background: #aabbd0;
        }


        .summary-value {

            color: #123576;

            font-size: 14px;

            font-weight: 850;
        }


        .summary-list {

            margin-top: 12px;
        }


        .summary-divider {

            height: 1px;

            background: #e3edf8;

            margin: 8px 0;
        }


        .summary-total {

            min-height: 30px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            color: #18376f;

            font-size: 13px;
        }


        .summary-total strong {

            color: #123576;
        }


        /* =====================================================
           PROFILE
        ===================================================== */

        .profile-card {

            padding: 17px 27px 20px;

            margin-bottom: 18px;
        }


        .profile-heading {

            display: flex;

            align-items: center;

            gap: 14px;

            padding-bottom: 9px;

            border-bottom: 1px solid #e1edf8;
        }


        .profile-icon {

            width: 42px;

            height: 42px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #2079e8;

            color: white;

            font-size: 21px;
        }


        .profile-heading h2 {

            margin: 0;

            font-size: 18px;

            font-weight: 800;

            color: #102d68;
        }


        .profile-heading p {

            margin: 3px 0 0;

            color: #526b93;

            font-size: 12px;
        }


        .aspect-row {

            min-height: 37px;

            display: grid;

            grid-template-columns:
                250px
                1fr
                55px
                120px;

            gap: 15px;

            align-items: center;

            border-bottom: 1px solid #e3edf7;
        }


        .aspect-row:last-child {

            border-bottom: 0;
        }


        .aspect-name {

            font-size: 13px;

            font-weight: 650;

            color: #16376f;
        }


        .aspect-progress {

            height: 12px;

            width: 100%;

            border-radius: 20px;

            background: #e4edf6;

            overflow: hidden;
        }


        .aspect-progress-bar {

            width: var(--aspect-value);

            height: 100%;

            border-radius: 20px;

            background:
                linear-gradient(
                    90deg,
                    #1676ec,
                    #1d98eb
                );
        }


        .aspect-score {

            text-align: center;

            font-size: 14px;

            font-weight: 850;

            color: #123576;
        }


        .aspect-category {

            justify-self: end;

            min-width: 110px;

            padding: 5px 10px;

            border-radius: 20px;

            text-align: center;

            font-size: 11px;

            font-weight: 750;
        }


        .very-good {

            background: #12ad69;

            color: white;
        }


        .good {

            background: #239de9;

            color: white;
        }


        .enough {

            background: #ffb318;

            color: white;
        }


        .not-rated {

            background: #e9eef4;

            color: #718096;
        }


        /* =====================================================
           CONCLUSION
        ===================================================== */

        .conclusion-card {

            min-height: 145px;

            padding: 23px 27px;

            display: grid;

            grid-template-columns:
                70px
                1fr
                285px;

            gap: 20px;

            align-items: center;
        }


        .conclusion-icon {

            width: 55px;

            height: 55px;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #e9f4ff;

            color: #1476e8;

            font-size: 30px;
        }


        .conclusion-content h2 {

            margin: 0 0 7px;

            font-size: 18px;

            font-weight: 800;

            color: #102d68;
        }


        .conclusion-content p {

            margin: 0;

            max-width: 680px;

            color: #48628d;

            font-size: 13px;

            line-height: 1.65;
        }


        .conclusion-button {

            padding-left: 20px;

            border-left: 1px solid #b8d8f7;

            display: flex;

            justify-content: flex-end;
        }


        .detail-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 10px;

            min-width: 230px;

            padding: 14px 19px;

            border-radius: 13px;

            background:
                linear-gradient(
                    135deg,
                    #1376ed,
                    #2189eb
                );

            color: white;

            text-decoration: none;

            font-size: 13px;

            font-weight: 750;

            transition: .2s ease;
        }


        .detail-button:hover {

            color: white;

            transform: translateY(-1px);

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width: 950px) {

            .top-grid {

                grid-template-columns: 1fr;

            }


            .result-account {

                display: none;

            }


            .aspect-row {

                grid-template-columns:
                    190px
                    1fr
                    50px
                    110px;

            }


            .conclusion-card {

                grid-template-columns:
                    60px
                    1fr;

            }


            .conclusion-button {

                grid-column: 2;

                border-left: 0;

                border-top: 1px solid #b8d8f7;

                padding: 17px 0 0;

                justify-content: flex-start;

            }

        }


        @media(max-width: 700px) {

            .result-menu a span {

                display: none;

            }


            .result-navbar-inner {

                padding: 0 12px;

            }


            .result-page {

                padding: 18px 12px 35px;

            }


            .score-card {

                flex-direction: column;

                padding: 25px 18px;

            }


            .score-circle-area {

                width: 100%;

                padding: 0 0 20px;

                border-right: 0;

                border-bottom: 1px solid #e3edf7;

            }


            .score-content {

                width: 100%;

                padding: 20px 0 0;

            }


            .aspect-row {

                grid-template-columns:
                    1fr
                    50px;

                gap: 7px;

                padding: 10px 0;

            }


            .aspect-name {

                grid-column: 1;

            }


            .aspect-progress {

                grid-column: 1;

            }


            .aspect-score {

                grid-column: 2;

                grid-row: 1 / span 2;

            }


            .aspect-category {

                grid-column: 1 / span 2;

                justify-self: start;

            }


            .conclusion-card {

                grid-template-columns: 1fr;

            }


            .conclusion-button {

                grid-column: 1;

            }

        }

    </style>

</head>


<body>


{{-- =========================================================
     NAVBAR YANG SAMA DENGAN NAVBAR MURID
========================================================= --}}

@include('layouts.navbar-murid')


@php

    /*
    |--------------------------------------------------------------------------
    | NILAI UTAMA
    |--------------------------------------------------------------------------
    */

    $persentaseHasil =
        (float) ($persentase ?? $hasil->persentase ?? 0);

    $persentaseHasil =
        max(0, min(100, $persentaseHasil));

    $nilaiAkhir =
        round($persentaseHasil);


    /*
    |--------------------------------------------------------------------------
    | KATEGORI
    |--------------------------------------------------------------------------
    */

    if (is_array($kategori ?? null)) {

        $labelKategori =
            $kategori['label']
            ?? $kategori['nama']
            ?? 'Belum ditentukan';

        $deskripsiKategori =
            $kategori['description']
            ?? $kategori['deskripsi']
            ?? '';

    } else {

        $labelKategori =
            $kategori
            ?? 'Belum ditentukan';

        $deskripsiKategori = '';

    }


    /*
    |--------------------------------------------------------------------------
    | DESKRIPSI
    |--------------------------------------------------------------------------
    */

    if (!$deskripsiKategori) {

        if ($persentaseHasil >= 80) {

            $deskripsiKategori =
                'Anda menunjukkan profil kepribadian yang baik dan sesuai dengan kriteria seleksi Polri.';

        } elseif ($persentaseHasil >= 60) {

            $deskripsiKategori =
                'Anda menunjukkan profil kepribadian yang cukup baik dan masih memiliki beberapa aspek yang dapat dikembangkan.';

        } else {

            $deskripsiKategori =
                'Beberapa aspek kepribadian masih perlu dikembangkan berdasarkan hasil tes.';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | RINGKASAN
    |--------------------------------------------------------------------------
    */

    $totalSoalHasil =
        (int) ($totalSoal ?? $hasil->total_soal ?? 0);

    $dijawabHasil =
        (int) ($dijawab ?? $hasil->jumlah_dijawab ?? 0);

    $tidakDijawabHasil =
        (int) ($tidakDijawab ?? $hasil->jumlah_tidak_dijawab ?? 0);


    /*
    |--------------------------------------------------------------------------
    | JAWABAN SESUAI
    |--------------------------------------------------------------------------
    */

    $jawabanSesuai =
        isset($jawabanSesuai)
            ? (int) $jawabanSesuai
            : 0;


    $jawabanKurangSesuai =
        isset($jawabanKurangSesuai)
            ? (int) $jawabanKurangSesuai
            : 0;


    /*
    |--------------------------------------------------------------------------
    | ASPEK
    |--------------------------------------------------------------------------
    */

    $daftarAspek = [

        'Integritas',

        'Tanggung Jawab',

        'Disiplin',

        'Pengendalian Emosi',

        'Kerja Sama',

        'Kepercayaan Diri',

        'Ketahanan Tekanan',

        'Adaptasi',

    ];


@endphp



{{-- =========================================================
     KONTEN
========================================================= --}}

<main class="result-page">


    {{-- =====================================================
         NILAI + RINGKASAN
    ====================================================== --}}

    <div class="top-grid">


        {{-- NILAI --}}

        <section class="result-card score-card">


            <div class="score-circle-area">

                <div
                    class="score-circle"
                    style="
                        --score-degree:
                        {{ $persentaseHasil * 3.6 }}deg;
                    "
                >

                    <div class="score-number">

                        {{ $nilaiAkhir }}

                    </div>

                    <div class="score-denominator">

                        /100

                    </div>

                </div>

            </div>


            <div class="score-content">


                <h2>
                    Nilai Akhir
                </h2>


                <div class="score-big">

                    {{ $nilaiAkhir }}

                    <span>
                        / 100
                    </span>

                </div>


                <div class="result-badge">

                    ✓

                    {{ $labelKategori }}

                </div>


                <div class="score-description">

                    {{ $deskripsiKategori }}

                </div>


            </div>


        </section>



        {{-- RINGKASAN --}}

        <section class="result-card summary-card">


            <h2 class="summary-title">

                Ringkasan Jawaban

            </h2>


            <div class="summary-list">


                <div class="summary-row">

                    <div class="summary-label">

                        <span class="summary-dot dot-green"></span>

                        Jawaban Sesuai

                    </div>

                    <div class="summary-value">

                        {{ $jawabanSesuai }}

                    </div>

                </div>


                <div class="summary-row">

                    <div class="summary-label">

                        <span class="summary-dot dot-red"></span>

                        Jawaban Kurang Sesuai

                    </div>

                    <div class="summary-value">

                        {{ $jawabanKurangSesuai }}

                    </div>

                </div>


                <div class="summary-row">

                    <div class="summary-label">

                        <span class="summary-dot dot-gray"></span>

                        Tidak Terjawab

                    </div>

                    <div class="summary-value">

                        {{ $tidakDijawabHasil }}

                    </div>

                </div>


                <div class="summary-divider"></div>


                <div class="summary-total">

                    <span>
                        Total Soal
                    </span>

                    <strong>
                        {{ $totalSoalHasil }}
                    </strong>

                </div>


                <div class="summary-total">

                    <span>
                        Terjawab
                    </span>

                    <strong>
                        {{ $dijawabHasil }}
                    </strong>

                </div>


            </div>


        </section>


    </div>



    {{-- =====================================================
         PROFIL KEPRIBADIAN
    ====================================================== --}}

    <section class="result-card profile-card">


        <div class="profile-heading">


            <div class="profile-icon">

                ♙

            </div>


            <div>

                <h2>
                    Profil Kepribadian
                </h2>

                <p>
                    Nilai setiap aspek kepribadian berdasarkan hasil tes.
                </p>

            </div>


        </div>



        <div>


            @foreach($daftarAspek as $index => $namaAspek)


                @php

                    $nilaiAspek = null;

                    /*
                     * Jika controller sudah mengirim
                     * hasil aspek, gunakan hasil tersebut.
                     */

                    if (
                        isset($aspekKepribadian)
                        && is_array($aspekKepribadian)
                    ) {

                        $dataAspek =
                            $aspekKepribadian[$namaAspek]
                            ?? $aspekKepribadian[$index]
                            ?? null;


                        if (is_array($dataAspek)) {

                            $nilaiAspek =
                                $dataAspek['nilai']
                                ?? $dataAspek['score']
                                ?? $dataAspek['skor']
                                ?? null;

                            $kategoriAspek =
                                $dataAspek['kategori']
                                ?? null;

                        } else {

                            $nilaiAspek =
                                $dataAspek;

                            $kategoriAspek =
                                null;

                        }

                    } else {

                        $kategoriAspek =
                            null;

                    }


                    /*
                     * Kategori berdasarkan nilai jika tersedia.
                     */

                    if (
                        $nilaiAspek !== null
                        && is_numeric($nilaiAspek)
                        && !$kategoriAspek
                    ) {

                        $nilaiAspek =
                            max(
                                0,
                                min(
                                    100,
                                    (float) $nilaiAspek
                                )
                            );


                        if ($nilaiAspek >= 80) {

                            $kategoriAspek = 'Sangat Baik';

                        } elseif ($nilaiAspek >= 70) {

                            $kategoriAspek = 'Baik';

                        } elseif ($nilaiAspek >= 60) {

                            $kategoriAspek = 'Cukup';

                        } else {

                            $kategoriAspek = 'Kurang';

                        }

                    }


                    if ($nilaiAspek !== null && is_numeric($nilaiAspek)) {

                        $nilaiAspek =
                            max(
                                0,
                                min(
                                    100,
                                    (float) $nilaiAspek
                                )
                            );

                    }


                    if (!$kategoriAspek) {

                        $kategoriAspek =
                            'Belum Dinilai';

                    }


                    if ($kategoriAspek === 'Sangat Baik') {

                        $classKategori =
                            'very-good';

                    } elseif ($kategoriAspek === 'Baik') {

                        $classKategori =
                            'good';

                    } elseif ($kategoriAspek === 'Cukup') {

                        $classKategori =
                            'enough';

                    } else {

                        $classKategori =
                            'not-rated';

                    }

                @endphp



                <div class="aspect-row">


                    <div class="aspect-name">

                        {{ $namaAspek }}

                    </div>


                    <div class="aspect-progress">

                        <div
                            class="aspect-progress-bar"
                            style="
                                --aspect-value:
                                {{ $nilaiAspek !== null
                                    ? $nilaiAspek
                                    : 0
                                }}%;
                            "
                        ></div>

                    </div>


                    <div class="aspect-score">

                        @if($nilaiAspek !== null)

                            {{ round($nilaiAspek) }}

                        @else

                            -

                        @endif

                    </div>


                    <div class="aspect-category {{ $classKategori }}">

                        {{ $kategoriAspek }}

                    </div>


                </div>


            @endforeach


        </div>


    </section>



    {{-- =====================================================
         KESIMPULAN
    ====================================================== --}}

    <section class="result-card conclusion-card">


        <div class="conclusion-icon">

            ◎

        </div>


        <div class="conclusion-content">


            <h2>
                Kesimpulan
            </h2>


            <p>

                @if($persentaseHasil >= 80)

                    Peserta menunjukkan kecenderungan kepribadian
                    yang baik pada hasil tes dan memenuhi kriteria
                    penilaian yang tersedia.

                @elseif($persentaseHasil >= 60)

                    Peserta menunjukkan kecenderungan kepribadian
                    yang cukup baik. Beberapa aspek masih dapat
                    dikembangkan untuk memperoleh hasil yang lebih optimal.

                @else

                    Hasil menunjukkan masih terdapat beberapa aspek
                    kepribadian yang perlu dikembangkan berdasarkan
                    hasil penilaian.

                @endif

            </p>


        </div>



        <div class="conclusion-button">


            <a
                href="{{ route('murid.riwayat') }}"
                class="detail-button"
            >

                ▣

                Lihat Riwayat Ujian

                <span>
                    ›
                </span>

            </a>


        </div>


    </section>


</main>


</body>

</html>