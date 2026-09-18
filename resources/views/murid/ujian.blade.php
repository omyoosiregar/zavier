<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>Ujian Kecermatan</title>

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            padding: 8px;
            background: #f5f7fa;
            font-family:
                Arial,
                Helvetica,
                sans-serif;
            color: #111827;
        }

        .ujian-container {
            width: 100%;
            max-width: 1600px;
            min-height:
                calc(100vh - 16px);
            margin: auto;
            background: #ffffff;
            border:
                1px solid #dfe3e8;
            border-radius: 7px;
            overflow: hidden;
            box-shadow:
                0 2px 8px
                rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .header {
            height: 76px;
            border-bottom:
                1px solid #dfe3e8;
            display: grid;
            grid-template-columns:
                1fr
                auto
                1fr;
            align-items: center;
            padding: 0 24px;
            flex-shrink: 0;
        }

        .judul {
            font-size:
                clamp(22px, 2vw, 28px);
            font-weight: 700;
            color: #111111;
        }

        .kolom-tengah {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            font-size: 20px;
        }

        .kolom-badge {
            background: #0866d8;
            color: white;
            padding:
                6px 12px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
        }

        .timer {
            justify-self: end;
            min-width: 145px;
            border:
                1px solid #78aef7;
            border-radius: 8px;
            padding:
                9px 18px;
            font-size: 25px;
            font-weight: 700;
            text-align: center;
            background: white;
            transition:
                all 0.2s ease;
        }

        .timer.warning {
            border-color:
                #f59e0b;
            color:
                #b45309;
            background:
                #fffbeb;
        }

        .timer.danger {
            border-color:
                #ef4444;
            color:
                #dc2626;
            background:
                #fef2f2;
            animation:
                timerPulse 0.6s
                infinite alternate;
        }

        @keyframes timerPulse {

            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.05);
            }

        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            flex: 1;
            padding:
                28px 24px 18px;
            display: flex;
            flex-direction: column;
        }


        /* =====================================================
           KUNCI
        ===================================================== */

        .kunci-wrapper {
            width:
                min(58%, 850px);
            margin:
                0 auto 45px auto;
        }

        .kunci-table {
            width: 100%;
            border-collapse:
                collapse;
            table-layout:
                fixed;
        }

        .kunci-table td {
            border:
                1px solid #8f8f8f;
            text-align: center;
            padding: 0;
        }

        .judul-kolom {
            height: 50px;
            font-size: 24px;
            font-weight: 700;
        }

        .huruf-kunci {
            height: 68px;
            font-size: 39px;
            font-weight: 700;
        }

        .pilihan-kunci {
            height: 42px;
            font-size: 22px;
        }


        /* =====================================================
           POLA SOAL
        ===================================================== */

        .pola-wrapper {
            width:
                min(42%, 620px);
            margin:
                0 auto 55px auto;
        }

        .pola-box {
            height: 88px;
            border:
                2px solid #555555;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            font-weight: 700;
            letter-spacing: 18px;
            padding-left: 18px;
            overflow: hidden;
            background: #ffffff;
        }

        .pola-box.selesai {
            letter-spacing: 0;
            color: #64748b;
        }


        /* =====================================================
           STATUS SOAL
        ===================================================== */

        .status-soal {
            text-align: center;
            margin-top: -20px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #64748b;
        }


        /* =====================================================
           JAWABAN
        ===================================================== */

        .jawaban-wrapper {
            width:
                min(88%, 1250px);
            margin:
                0 auto 32px auto;
            display: grid;
            grid-template-columns:
                repeat(5, 1fr);
            gap: 12px;
        }

        .jawaban-btn {
            height: 72px;
            background: white;
            border:
                1px solid #b8b8b8;
            border-radius: 5px;
            font-size: 30px;
            font-weight: 400;
            cursor: pointer;
            transition:
                background 0.15s,
                border-color 0.15s,
                transform 0.1s;
        }

        .jawaban-btn:hover {
            background: #f1f5f9;
            border-color:
                #0d6efd;
        }

        .jawaban-btn:active {
            transform:
                scale(0.98);
        }

        .jawaban-btn:disabled {
            cursor:
                not-allowed;
            opacity:
                0.6;
        }

        .jawaban-btn.dipilih {
            background:
                #e8f1ff;
            border-color:
                #0866d8;
        }


        /* =====================================================
           INFO
        ===================================================== */

        .info-box {
            border:
                1px solid #a9d0ff;
            background:
                #eef7ff;
            color:
                #1769c2;
            border-radius:
                6px;
            padding:
                12px 15px;
            font-size:
                14px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {
            height: 66px;
            border-top:
                1px solid #dfe3e8;
            padding:
                10px 22px;
            display: flex;
            justify-content:
                space-between;
            align-items:
                center;
            flex-shrink: 0;
        }

        .btn-akhir {
            background:
                #ef2b2d;
            color:
                white;
            border:
                none;
            border-radius:
                6px;
            padding:
                9px 16px;
            font-size:
                15px;
            cursor:
                pointer;
        }

        .btn-akhir:hover {
            background:
                #d91f21;
        }

        .btn-akhir:disabled {
            cursor:
                not-allowed;
            opacity:
                0.6;
        }

        .btn-keluar {
            background:
                white;
            border:
                1px solid #d6d9dd;
            border-radius:
                6px;
            padding:
                9px 16px;
            font-size:
                15px;
            cursor:
                pointer;
        }

        .btn-keluar:hover {
            background:
                #f5f5f5;
        }


        /* =====================================================
           OVERLAY COUNTDOWN 3 DETIK
        ===================================================== */

        .countdown-overlay {
            position:
                fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;

            background:
                rgba(0, 0, 0, 0.68);

            display: flex;
            align-items:
                center;
            justify-content:
                center;

            z-index:
                999999;

            opacity: 0;
            visibility:
                hidden;

            pointer-events:
                none;

            transition:
                opacity 0.15s ease,
                visibility 0.15s ease;
        }

        .countdown-overlay.active {
            opacity: 1;
            visibility:
                visible;

            pointer-events:
                all;
        }

        .countdown-content {
            display: flex;
            flex-direction:
                column;
            align-items:
                center;
            justify-content:
                center;
            text-align:
                center;

            user-select:
                none;
        }

        .countdown-label {
            color:
                rgba(255, 255, 255, 0.96);

            font-size:
                clamp(20px, 3vw, 34px);

            font-weight:
                700;

            margin-bottom:
                10px;

            letter-spacing:
                1px;

            text-shadow:
                0 2px 8px
                rgba(0, 0, 0, 0.5);
        }

        .countdown-number {
            color:
                #ffffff;

            font-size:
                clamp(100px, 18vw, 220px);

            line-height:
                1;

            font-weight:
                800;

            text-shadow:
                0 5px 25px
                rgba(0, 0, 0, 0.7);

            animation:
                countdownPop 0.9s
                ease-in-out infinite;
        }

        .countdown-sub {
            margin-top:
                14px;

            color:
                rgba(255, 255, 255, 0.85);

            font-size:
                clamp(14px, 2vw, 20px);
        }

        @keyframes countdownPop {

            0% {
                transform:
                    scale(0.85);
                opacity:
                    0.5;
            }

            50% {
                transform:
                    scale(1.08);
                opacity:
                    1;
            }

            100% {
                transform:
                    scale(1);
                opacity:
                    0.9;
            }

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-height: 850px) {

            .header {
                height: 68px;
            }

            .content {
                padding-top:
                    22px;
                padding-bottom:
                    14px;
            }

            .kunci-wrapper {
                margin-bottom:
                    32px;
            }

            .judul-kolom {
                height:
                    43px;
                font-size:
                    21px;
            }

            .huruf-kunci {
                height:
                    57px;
                font-size:
                    34px;
            }

            .pilihan-kunci {
                height:
                    35px;
                font-size:
                    19px;
            }

            .pola-wrapper {
                margin-bottom:
                    38px;
            }

            .pola-box {
                height:
                    74px;
                font-size:
                    33px;
                letter-spacing:
                    15px;
                padding-left:
                    15px;
            }

            .jawaban-wrapper {
                margin-bottom:
                    23px;
            }

            .jawaban-btn {
                height:
                    62px;
                font-size:
                    27px;
            }

            .info-box {
                padding:
                    10px 13px;
                font-size:
                    13px;
            }

            .footer {
                height:
                    58px;
            }
        }


        @media (max-width: 1100px) {

            .kunci-wrapper {
                width:
                    70%;
            }

            .pola-wrapper {
                width:
                    52%;
            }

            .jawaban-wrapper {
                width:
                    94%;
            }
        }


        @media (max-width: 700px) {

            body {
                padding: 4px;
            }

            .ujian-container {
                min-height:
                    calc(100vh - 8px);
            }

            .header {
                height:
                    auto;
                min-height:
                    110px;

                grid-template-columns:
                    1fr;

                gap:
                    8px;

                padding:
                    12px;
            }

            .judul {
                text-align:
                    center;

                font-size:
                    22px;
            }

            .kolom-tengah {
                font-size:
                    18px;
            }

            .timer {
                justify-self:
                    center;

                font-size:
                    22px;

                min-width:
                    130px;
            }

            .content {
                padding:
                    18px 10px;
            }

            .kunci-wrapper {
                width:
                    100%;

                margin-bottom:
                    30px;
            }

            .judul-kolom {
                height:
                    40px;

                font-size:
                    20px;
            }

            .huruf-kunci {
                height:
                    55px;

                font-size:
                    30px;
            }

            .pilihan-kunci {
                height:
                    34px;

                font-size:
                    18px;
            }

            .pola-wrapper {
                width:
                    90%;

                margin-bottom:
                    35px;
            }

            .pola-box {
                height:
                    70px;

                font-size:
                    29px;

                letter-spacing:
                    9px;

                padding-left:
                    9px;
            }

            .jawaban-wrapper {
                width:
                    100%;

                gap:
                    6px;
            }

            .jawaban-btn {
                height:
                    58px;

                font-size:
                    24px;
            }

            .info-box {
                font-size:
                    12px;
            }

            .footer {
                padding:
                    10px;
            }

            .countdown-label {
                font-size:
                    22px;
            }

            .countdown-number {
                font-size:
                    120px;
            }

            .countdown-sub {
                font-size:
                    14px;
            }
        }

    </style>

</head>


<body>


<div class="ujian-container">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="header">

        <div class="judul">
            Ujian Kecermatan
        </div>

        <div class="kolom-tengah">

            <span class="kolom-badge">
                Kolom
            </span>

            <span id="kolomIndicator">
                1 / {{ $kolomUjians->count() }}
            </span>

        </div>

        <div
            class="timer"
            id="timer"
        >
            ⏱ 01:00
        </div>

    </div>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <div class="content">


        <!-- =================================================
             KUNCI
        ================================================== -->

        <div class="kunci-wrapper">

            <table class="kunci-table">

                <tr>

                    <td
                        colspan="5"
                        class="judul-kolom"
                        id="judulKolom"
                    >
                        Kolom 1
                    </td>

                </tr>

                <tr id="kunciKarakter">

                    <td class="huruf-kunci">
                        -
                    </td>

                    <td class="huruf-kunci">
                        -
                    </td>

                    <td class="huruf-kunci">
                        -
                    </td>

                    <td class="huruf-kunci">
                        -
                    </td>

                    <td class="huruf-kunci">
                        -
                    </td>

                </tr>

                <tr>

                    <td class="pilihan-kunci">
                        A
                    </td>

                    <td class="pilihan-kunci">
                        B
                    </td>

                    <td class="pilihan-kunci">
                        C
                    </td>

                    <td class="pilihan-kunci">
                        D
                    </td>

                    <td class="pilihan-kunci">
                        E
                    </td>

                </tr>

            </table>

        </div>


        <!-- =================================================
             SOAL
        ================================================== -->

        <div class="pola-wrapper">

            <div
                class="pola-box"
                id="polaSoal"
            >
                Memuat soal...
            </div>

        </div>
<!-- =================================================
             TOMBOL JAWABAN
        ================================================== -->

        <div
            class="jawaban-wrapper"
            id="jawaban"
        >

            <button
                type="button"
                class="jawaban-btn"
                data-jawaban="A"
            >
                A
            </button>

            <button
                type="button"
                class="jawaban-btn"
                data-jawaban="B"
            >
                B
            </button>

            <button
                type="button"
                class="jawaban-btn"
                data-jawaban="C"
            >
                C
            </button>

            <button
                type="button"
                class="jawaban-btn"
                data-jawaban="D"
            >
                D
            </button>

            <button
                type="button"
                class="jawaban-btn"
                data-jawaban="E"
            >
                E
            </button>

        </div>


        <!-- =================================================
             INFO
        ================================================== -->

        <div class="info-box">

            ℹ️

            Pilih huruf yang sesuai dengan pola
            berdasarkan kunci jawaban di atas.

        </div>

    </div>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <div class="footer">

        <button
            type="button"
            class="btn-akhir"
            id="btnAkhiri"
        >
            ⇥ &nbsp; Akhiri Ujian
        </button>

        <button
            type="button"
            class="btn-keluar"
            id="btnKeluar"
        >
            ⇥ &nbsp; Keluar
        </button>

    </div>

</div>



<!-- =========================================================
     OVERLAY COUNTDOWN 3 DETIK
========================================================= -->

<div
    class="countdown-overlay"
    id="countdownOverlay"
>

    <div class="countdown-content">

        <div class="countdown-label">
            WAKTU HAMPIR HABIS
        </div>

        <div
            class="countdown-number"
            id="countdownNumber"
        >
            3
        </div>

        <div class="countdown-sub">
            Jawaban dikunci sementara...
        </div>

    </div>

</div>



<script>
/* ==========================================================
   DATA LARAVEL
========================================================== */

const semuaKolom = @json($kolomUjians);
const paketSoalId = @json($paketSoal->id);

const routeSimpanKolom = "{{ route('murid.ujian.simpan-kolom') }}";
const routeSelesai = "{{ route('murid.ujian.selesai') }}";
const routeHasilTerakhir = "{{ route('murid.hasil.terakhir') }}";

const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute('content');

/* ==========================================================
   ELEMENT
========================================================== */

const kolomIndicator = document.getElementById('kolomIndicator');
const judulKolom = document.getElementById('judulKolom');
const kunciKarakter = document.getElementById('kunciKarakter');
const polaSoal = document.getElementById('polaSoal');
const timerElement = document.getElementById('timer');const tombolJawaban = document.querySelectorAll('.jawaban-btn');
const btnAkhiri = document.getElementById('btnAkhiri');
const btnKeluar = document.getElementById('btnKeluar');
const countdownOverlay = document.getElementById('countdownOverlay');
const countdownNumber = document.getElementById('countdownNumber');

/* ==========================================================
   STATE
========================================================== */

let indexKolom = 0;
let indexSoal = 0;
let waktu = 60;

let jawabanKolom = {};

let timerInterval = null;
let countdownInterval = null;
let countdownTimeout = null;

let sedangMemproses = false;
let ujianSelesai = false;
let countdownAktif = false;

/* ==========================================================
   DEBUG
========================================================== */

console.log('DATA KOLOM:', semuaKolom);
console.log('PAKET SOAL ID:', paketSoalId);

/* ==========================================================
   HELPER
========================================================== */

function kolomAktif() {
    return semuaKolom[indexKolom] || null;
}

function daftarSoalAktif() {
    const kolom = kolomAktif();
    return kolom ? (kolom.soal_kecermatan || []) : [];
}

function nomorKolomAktif() {
    const kolom = kolomAktif();

    return Number(
        kolom?.nomor_kolom ??
        (indexKolom + 1)
    );
}

function clearSemuaTimer() {
    if (timerInterval) {
        clearInterval(timerInterval);
        timerInterval = null;
    }

    if (countdownInterval) {
        clearInterval(countdownInterval);
        countdownInterval = null;
    }

    if (countdownTimeout) {
        clearTimeout(countdownTimeout);
        countdownTimeout = null;
    }
}

function formatWaktu(detik) {
    const menit = Math.floor(detik / 60);
    const sisaDetik = detik % 60;

    return (
        String(menit).padStart(2, '0') +
        ':' +
        String(sisaDetik).padStart(2, '0')
    );
}

/* ==========================================================
   TIMER
========================================================== */

function tampilkanTimer() {
    timerElement.textContent = '⏱ ' + formatWaktu(waktu);

    timerElement.classList.remove(
        'warning',
        'danger'
    );

    if (waktu <= 20) {
        timerElement.classList.add('warning');
    }

    if (waktu <= 10) {
        timerElement.classList.remove('warning');
        timerElement.classList.add('danger');
    }
}

function mulaiTimer() {
    clearInterval(timerInterval);

    timerInterval = setInterval(() => {

        if (
            ujianSelesai ||
            countdownAktif ||
            sedangMemproses
        ) {
            return;
        }

        waktu--;

        if (waktu < 0) {
            waktu = 0;
        }

        tampilkanTimer();

        /*
         * 00:03:
         * jawaban langsung dikunci,
         * countdown 3 -> 2 -> 1 -> 0.
         */
        if (waktu === 3) {
            mulaiCountdown();
            return;
        }

        /*
         * Pengaman jika timer sampai 0 tanpa countdown.
         */
        if (waktu <= 0) {
            clearInterval(timerInterval);
            timerInterval = null;

            prosesAkhirKolom();
        }

    }, 1000);
}

/* ==========================================================
   KUNCI / BUKA JAWABAN
========================================================== */

function kunciJawaban() {
    tombolJawaban.forEach(button => {
        button.disabled = true;
    });
}

function bukaJawaban() {
    if (
        countdownAktif ||
        sedangMemproses ||
        ujianSelesai
    ) {
        return;
    }

    if (waktu <= 3) {
        kunciJawaban();
        return;
    }

    tombolJawaban.forEach(button => {
        button.disabled = false;
    });
}

/* ==========================================================
   TAMPILKAN KUNCI
========================================================== */

function tampilkanKunci(kolom) {

    let kunci = kolom.kunci || {};

    if (typeof kunci === 'string') {
        try {
            kunci = JSON.parse(kunci);
        } catch (error) {
            console.error(
                'Kunci tidak dapat dibaca:',
                error
            );

            kunci = {};
        }
    }

    const huruf = [
        kunci.A ?? '',
        kunci.B ?? '',
        kunci.C ?? '',
        kunci.D ?? '',
        kunci.E ?? ''
    ];

    kunciKarakter.innerHTML = '';

    huruf.forEach(item => {
        const td = document.createElement('td');

        td.className = 'huruf-kunci';
        td.textContent = item;

        kunciKarakter.appendChild(td);
    });
}

/* ==========================================================
   TAMPILKAN SOAL
========================================================== */

function tampilkanSoal() {

    const kolom = kolomAktif();

    if (!kolom) {
        return;
    }

    const daftarSoal = daftarSoalAktif();

    /*
     * Tidak ada soal.
     */
    if (daftarSoal.length === 0) {

        polaSoal.textContent = 'SOAL TIDAK TERSEDIA';
        polaSoal.classList.add('selesai');

        kunciJawaban();

        return;
    }

    /*
     * Soal sudah habis.
     */
    if (indexSoal >= daftarSoal.length) {

        polaSoal.textContent = 'SOAL SELESAI';
        polaSoal.classList.add('selesai');

        kunciJawaban();

        return;
    }

    polaSoal.classList.remove('selesai');

    const soal = daftarSoal[indexSoal];

    polaSoal.textContent =
        soal.pertanyaan ?? '';

    tombolJawaban.forEach(button => {

        button.disabled = false;
        button.classList.remove('dipilih');

    });

    /*
     * Controller menghitung jawaban berdasarkan
     * soal.nomor_soal, bukan soal.id.
     */
    const kunciJawabanUser =
        String(
            soal.nomor_soal ??
            soal.id
        );

    const jawabanLama =
        jawabanKolom[kunciJawabanUser];

    if (jawabanLama) {

        tombolJawaban.forEach(button => {

            if (
                button.dataset.jawaban ===
                jawabanLama
            ) {
                button.classList.add('dipilih');
            }

        });
    }

    if (countdownAktif) {
        kunciJawaban();
    }
}

/* ==========================================================
   COUNTDOWN 3 DETIK
========================================================== */

function mulaiCountdown() {

    if (
        countdownAktif ||
        ujianSelesai ||
        sedangMemproses
    ) {
        return;
    }

    countdownAktif = true;

    clearInterval(timerInterval);
    timerInterval = null;

    kunciJawaban();

    countdownOverlay.classList.add('active');

    let angka = 3;

    countdownNumber.textContent = angka;

    if (countdownInterval) {
        clearInterval(countdownInterval);
    }

    countdownInterval = setInterval(() => {

        angka--;

        if (angka >= 1) {

            countdownNumber.textContent =
                angka;

            return;
        }

        /*
         * Sampai angka 0.
         */
        clearInterval(countdownInterval);
        countdownInterval = null;

        countdownNumber.textContent = '0';

        /*
         * Beri sedikit waktu agar angka 0 terlihat,
         * lalu simpan kolom dan pindah otomatis.
         */
        countdownTimeout = setTimeout(() => {

            countdownTimeout = null;

            prosesAkhirKolom();

        }, 250);

    }, 1000);
}

/* ==========================================================
   TAMPILKAN KOLOM
========================================================== */

function tampilkanKolom() {

    const kolom = kolomAktif();

    if (!kolom) {

        console.error(
            'Kolom tidak ditemukan:',
            indexKolom
        );

        return;
    }

    clearSemuaTimer();

    countdownAktif = false;
    sedangMemproses = false;

    countdownOverlay.classList.remove('active');

    indexSoal = 0;
    jawabanKolom = {};

    const nomorKolom = nomorKolomAktif();

    kolomIndicator.textContent =
        nomorKolom +
        ' / ' +
        semuaKolom.length;

    judulKolom.textContent =
        'Kolom ' +
        nomorKolom;

    tampilkanKunci(kolom);

    /*
     * Ambil waktu dari database.
     */
    waktu = parseInt(
        kolom.waktu_detik ?? 60,
        10
    );

    if (
        isNaN(waktu) ||
        waktu <= 0
    ) {
        waktu = 60;
    }

    tampilkanSoal();
    tampilkanTimer();

    /*
     * Kunci tombol hanya jika waktu <= 3.
     */
    if (waktu <= 3) {
        kunciJawaban();
    } else {
        bukaJawaban();
    }

    mulaiTimer();

    console.log(
        'MULAI KOLOM:',
        nomorKolom,
        'INDEX:',
        indexKolom,
        'WAKTU:',
        waktu
    );
}

/* ==========================================================
   SIMPAN KOLOM
========================================================== */

async function simpanKolom() {

    const kolom = kolomAktif();

    if (!kolom) {
        return false;
    }

    const nomorKolom = nomorKolomAktif();

    const dataJawaban = {
        ...jawabanKolom
    };

    console.log(
        '================================'
    );

    console.log(
        'SIMPAN KOLOM:',
        nomorKolom
    );

    console.log(
        'PAKET SOAL ID:',
        paketSoalId
    );

    console.log(
        'KOLOM ID:',
        kolom.id
    );

    console.log(
        'JAWABAN:',
        dataJawaban
    );

    try {

        const response = await fetch(
            routeSimpanKolom,
            {
                method: 'POST',

                headers: {
                    'Content-Type':
                        'application/json',

                    'X-CSRF-TOKEN':
                        csrfToken,

                    'Accept':
                        'application/json'
                },

                body: JSON.stringify({

                    /*
                     * INI PERBAIKAN PENTING.
                     * Controller membutuhkan:
                     * paket_soal_id
                     * kolom_id
                     * jawaban
                     */
                    paket_soal_id:
                        paketSoalId,

                    kolom_id:
                        kolom.id,

                    jawaban:
                        dataJawaban

                })
            }
        );

        const data =
            await response.json();

        console.log(
            'HASIL SIMPAN:',
            data
        );

        if (
            !response.ok ||
            data.success !== true
        ) {
            throw new Error(
                data.message ||
                'Gagal menyimpan jawaban.'
            );
        }

        return true;

    } catch (error) {

        console.error(
            'ERROR SIMPAN KOLOM:',
            error
        );

        alert(
            'Jawaban kolom ' +
            nomorKolom +
            ' gagal disimpan.\n\n' +
            error.message
        );

        return false;
    }
}

/* ==========================================================
   PROSES AKHIR KOLOM
========================================================== */

async function prosesAkhirKolom() {

    if (
        sedangMemproses ||
        ujianSelesai
    ) {
        return;
    }

    sedangMemproses = true;

    clearSemuaTimer();

    countdownAktif = false;

    /*
     * Tetap tampilkan overlay ketika proses simpan.
     * Ini mencegah murid menekan tombol saat data sedang
     * dikirim ke server.
     */
    countdownOverlay.classList.add('active');

    countdownNumber.textContent = '0';

    kunciJawaban();

    const nomorKolom = nomorKolomAktif();

    console.log(
        'AKHIR KOLOM:',
        nomorKolom
    );

    /*
     * SIMPAN DULU.
     */
    const berhasil =
        await simpanKolom();

    /*
     * Jika gagal, jangan pindah kolom.
     * Kembalikan kesempatan mengerjakan sebentar.
     */
    if (!berhasil) {

        countdownOverlay.classList.remove(
            'active'
        );

        sedangMemproses = false;
        countdownAktif = false;

        waktu = 4;

        tampilkanTimer();
        bukaJawaban();
        mulaiTimer();

        return;
    }

    /*
     * MASIH ADA KOLOM BERIKUTNYA.
     */
    if (
        indexKolom <
        semuaKolom.length - 1
    ) {

        indexKolom++;

        console.log(
            'PINDAH KE KOLOM:',
            nomorKolomAktif()
        );

        /*
         * Tunggu sebentar agar perpindahan
         * terasa jelas.
         */
        setTimeout(() => {

            countdownOverlay.classList.remove(
                'active'
            );

            sedangMemproses = false;

            tampilkanKolom();

        }, 300);

        return;
    }

    /*
     * SUDAH KOLOM TERAKHIR.
     */
    console.log(
        'SEMUA KOLOM SELESAI'
    );

    await selesaiUjian();
}

/* ==========================================================
   SELESAI UJIAN
========================================================== */

async function selesaiUjian() {

    if (ujianSelesai) {
        return;
    }

    ujianSelesai = true;

    clearSemuaTimer();

    countdownAktif = false;

    countdownOverlay.classList.add('active');

    countdownNumber.textContent = '✓';

    kunciJawaban();

    btnAkhiri.disabled = true;
    btnKeluar.disabled = true;

    try {

        const response = await fetch(
            routeSelesai,
            {
                method: 'POST',

                headers: {
                    'Content-Type':
                        'application/json',

                    'X-CSRF-TOKEN':
                        csrfToken,

                    'Accept':
                        'text/html,application/json'
                },

                body: JSON.stringify({})
            }
        );

        /*
         * Controller selesaiUjian() saat ini
         * mengembalikan redirect HTML,
         * bukan JSON.
         *
         * Jadi jangan paksa response.json().
         */

        if (!response.ok) {

            let pesan =
                'Gagal menyimpan hasil ujian.';

            try {
                const data =
                    await response.json();

                pesan =
                    data.message ||
                    pesan;

            } catch (e) {
                // Response bukan JSON.
            }

            throw new Error(pesan);
        }

        /*
         * Karena hasil sudah dibuat oleh controller,
         * arahkan murid ke hasil ujian terakhir.
         */
        window.location.href =
            routeHasilTerakhir;

    } catch (error) {

        console.error(
            'ERROR SELESAI UJIAN:',
            error
        );

        ujianSelesai = false;
        sedangMemproses = false;

        countdownOverlay.classList.remove(
            'active'
        );

        btnAkhiri.disabled = false;
        btnKeluar.disabled = false;

        alert(
            'Hasil ujian gagal disimpan.\n\n' +
            error.message
        );
    }
}

/* ==========================================================
   JAWAB SOAL
========================================================== */

function jawab(pilihan) {

    if (
        countdownAktif ||
        sedangMemproses ||
        ujianSelesai
    ) {
        return;
    }

    if (waktu <= 3) {
        return;
    }

    const kolom = kolomAktif();

    if (!kolom) {
        return;
    }

    const daftarSoal =
        daftarSoalAktif();

    const soal =
        daftarSoal[indexSoal];

    if (!soal) {
        return;
    }

    /*
     * PENTING:
     * Controller menghitung berdasarkan nomor_soal.
     * Jangan menggunakan soal.id.
     */
    const nomorSoal =
        String(
            soal.nomor_soal ??
            soal.id
        );

    jawabanKolom[nomorSoal] =
        String(pilihan).toUpperCase();

    console.log(
        'JAWAB:',
        nomorSoal,
        jawabanKolom[nomorSoal]
    );

    tombolJawaban.forEach(button => {

        button.classList.remove(
            'dipilih'
        );

        if (
            button.dataset.jawaban ===
            String(pilihan).toUpperCase()
        ) {
            button.classList.add(
                'dipilih'
            );
        }

    });

    /*
     * Lanjut soal.
     */
    indexSoal++;

    /*
     * Masih ada soal.
     */
    if (
        indexSoal <
        daftarSoal.length
    ) {

        tampilkanSoal();

        return;
    }

    /*
     * Soal terakhir selesai.
     * Simpan kolom dan pindah ke kolom berikutnya.
     */
    prosesAkhirKolom();
}

/* ==========================================================
   EVENT TOMBOL A - E
========================================================== */

tombolJawaban.forEach(button => {

    button.addEventListener(
        'click',
        function() {

            if (
                this.disabled ||
                countdownAktif ||
                sedangMemproses ||
                ujianSelesai
            ) {
                return;
            }

            jawab(
                this.dataset.jawaban
            );
        }
    );

});

/* ==========================================================
   TOMBOL AKHIRI UJIAN
========================================================== */

btnAkhiri.addEventListener(
    'click',
    async function() {

        if (
            sedangMemproses ||
            ujianSelesai ||
            countdownAktif
        ) {
            return;
        }

        const yakin = confirm(
            'Apakah Anda yakin ingin mengakhiri ujian sekarang?\n\n' +
            'Soal yang belum dijawab akan dihitung sebagai tidak dijawab.'
        );

        if (!yakin) {
            return;
        }

        sedangMemproses = true;

        clearSemuaTimer();

        kunciJawaban();

        /*
         * Simpan kolom yang sedang aktif.
         */
        const berhasil =
            await simpanKolom();

        if (!berhasil) {

            sedangMemproses = false;

            bukaJawaban();
            mulaiTimer();

            return;
        }

        await selesaiUjian();
    }
);

/* ==========================================================
   TOMBOL KELUAR
========================================================== */

btnKeluar.addEventListener(
    'click',
    function() {

        if (
            sedangMemproses ||
            ujianSelesai ||
            countdownAktif
        ) {
            return;
        }

        const yakin = confirm(
            'Keluar dari ujian?\n\n' +
            'Progress yang belum tersimpan dapat hilang.'
        );

        if (!yakin) {
            return;
        }

        clearSemuaTimer();

        window.history.back();
    }
);

/* ==========================================================
   CEGAH REFRESH / CLOSE
========================================================== */

window.addEventListener(
    'beforeunload',
    function(event) {

        if (!ujianSelesai) {

            event.preventDefault();

            event.returnValue = '';
        }

    }
);

/* ==========================================================
   MULAI UJIAN
========================================================== */

if (
    Array.isArray(semuaKolom) &&
    semuaKolom.length > 0
) {

    tampilkanKolom();

} else {

    polaSoal.textContent =
        'DATA UJIAN TIDAK TERSEDIA';

    polaSoal.classList.add(
        'selesai'
    );

    tombolJawaban.forEach(button => {
        button.disabled = true;
    });

    btnAkhiri.disabled = true;
}

</script>

</body>

</html>