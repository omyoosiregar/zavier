<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Ujian Kepribadian - ZAVIER Learning Center
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        body {
            background:
                linear-gradient(
                    135deg,
                    #f4f8ff 0%,
                    #edf4fc 45%,
                    #f8fbff 100%
                );

            font-family:
                "Segoe UI",
                Arial,
                sans-serif;

            color: #18345f;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .exam-header {

            height: 105px;

            background:
                linear-gradient(
                    135deg,
                    #101f45 0%,
                    #173b82 55%,
                    #1459b8 100%
                );

            color: white;

            box-shadow:
                0 10px 30px
                rgba(18,48,95,.18);
        }


        .exam-header-inner {

            max-width: 1250px;

            height: 100%;

            margin: 0 auto;

            padding:
                18px 25px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 25px;
        }


        .exam-title-area {
            min-width: 0;
        }


        .exam-label {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            font-size: 10px;

            font-weight: 800;

            letter-spacing: 1.1px;

            opacity: .72;

            margin-bottom: 5px;
        }


        .exam-title {

            margin: 0;

            font-size: 28px;

            font-weight: 850;

            letter-spacing: -.6px;
        }


        .exam-package {

            margin-top: 3px;

            font-size: 13px;

            opacity: .78;
        }


        /* =====================================================
           TIMER
        ===================================================== */

        .timer-box {

            min-width: 170px;

            padding:
                12px 18px;

            border-radius: 17px;

            background:
                rgba(255,255,255,.10);

            border:
                1px solid
                rgba(255,255,255,.16);

            text-align: center;

            backdrop-filter:
                blur(10px);
        }


        .timer-label {

            font-size: 10px;

            font-weight: 700;

            opacity: .70;

            margin-bottom: 2px;
        }


        .timer {

            font-size: 27px;

            line-height: 1.1;

            font-weight: 850;

            letter-spacing: 1px;

            font-variant-numeric:
                tabular-nums;
        }


        .timer.warning {
            color: #ffe08a;
        }


        .timer.danger {

            color: #ffb3b3;

            animation:
                pulseTimer 1s infinite;
        }


        @keyframes pulseTimer {

            50% {
                opacity: .55;
            }

        }


        /* =====================================================
           MAIN
        ===================================================== */

        .exam-page {

            width: 100%;

            max-width: 1050px;

            height:
                calc(100vh - 105px);

            margin:
                0 auto;

            padding:
                20px
                20px
                12px;

            display: flex;

            flex-direction: column;

            overflow: hidden;
        }


        /* =====================================================
           PROGRESS
        ===================================================== */

        .progress-card {

            flex-shrink: 0;

            background: white;

            border:
                1px solid
                #e1e9f5;

            border-radius: 20px;

            padding:
                13px 21px;

            margin-bottom: 12px;

            box-shadow:
                0 10px 28px
                rgba(38,72,120,.055);
        }


        .progress-top {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-bottom: 7px;
        }


        .progress-label {

            font-size: 12px;

            color: #7488a7;

            font-weight: 700;
        }


        .progress-number {

            font-size: 13px;

            color: #1764db;

            font-weight: 850;
        }


        .progress-track {

            height: 7px;

            background: #edf2f8;

            border-radius: 20px;

            overflow: hidden;
        }


        .progress-fill {

            width: 0%;

            height: 100%;

            border-radius: 20px;

            background:
                linear-gradient(
                    90deg,
                    #1769e8,
                    #10b9d5
                );

            transition:
                width .35s ease;
        }


        /* =====================================================
           QUESTION CARD
        ===================================================== */

        .question-card {

            flex: 1;

            min-height: 0;

            background: white;

            border:
                1px solid
                #e0e8f4;

            border-radius: 27px;

            padding:
                25px 32px;

            box-shadow:
                0 18px 45px
                rgba(37,71,119,.075);

            position: relative;

            overflow: hidden;
        }


        .question-card::before {

            content: "";

            position: absolute;

            width: 220px;

            height: 220px;

            border-radius: 50%;

            background:
                rgba(13,110,253,.035);

            right: -100px;

            top: -100px;

            pointer-events: none;
        }


        .question-card::after {

            content: "";

            position: absolute;

            width: 150px;

            height: 150px;

            border-radius: 50%;

            background:
                rgba(13,202,240,.025);

            left: -80px;

            bottom: -80px;

            pointer-events: none;
        }


        .question-content {

            width: 100%;

            height: 100%;

            position: relative;

            z-index: 2;

            display: flex;

            flex-direction: column;

            min-height: 0;
        }


        /* =====================================================
           QUESTION NUMBER
        ===================================================== */

        .question-number {

            flex-shrink: 0;

            display: inline-flex;

            align-items: center;

            gap: 8px;

            width: fit-content;

            padding:
                7px 13px;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #eaf3ff,
                    #eefaff
                );

            color: #1765d9;

            font-size: 11px;

            font-weight: 850;

            margin-bottom: 12px;
        }


        .question-number i {
            font-size: 14px;
        }


        /* =====================================================
           QUESTION TEXT
        ===================================================== */

        .question-text {

            flex-shrink: 0;

            margin:
                0 0 15px;

            font-size: 21px;

            line-height: 1.45;

            color: #172f57;

            font-weight: 750;

            letter-spacing: -.2px;

            max-height: 92px;

            overflow: hidden;
        }


        /* =====================================================
           ANSWERS
        ===================================================== */

        .answer-list {

            flex: 1;

            min-height: 0;

            display: flex;

            flex-direction: column;

            justify-content: space-between;

            gap: 8px;

            overflow: hidden;
        }


        .answer-option {

            width: 100%;

            min-height: 0;

            flex: 1;

            border:
                2px solid
                #e3eaf4;

            background:
                linear-gradient(
                    135deg,
                    #ffffff,
                    #fbfdff
                );

            border-radius: 15px;

            padding:
                9px 15px;

            display: flex;

            align-items: center;

            gap: 14px;

            cursor: pointer;

            transition:
                transform .20s ease,
                border-color .20s ease,
                background .20s ease,
                box-shadow .20s ease;

            text-align: left;

            overflow: hidden;
        }


        .answer-option:hover {

            transform:
                translateY(-2px);

            border-color:
                #a8caff;

            background:
                #f7fbff;

            box-shadow:
                0 8px 20px
                rgba(31,100,200,.08);
        }


        .answer-letter {

            width: 40px;

            height: 40px;

            min-width: 40px;

            border-radius: 12px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                #f0f4f9;

            color: #365477;

            font-size: 14px;

            font-weight: 850;

            transition:
                .20s ease;
        }


        .answer-text {

            flex: 1;

            min-width: 0;

            color: #344c6d;

            font-size: 14px;

            line-height: 1.4;

            font-weight: 600;

            overflow: hidden;

            text-overflow: ellipsis;

            display: -webkit-box;

            -webkit-line-clamp: 2;

            -webkit-box-orient: vertical;
        }


        .answer-check {

            width: 25px;

            height: 25px;

            min-width: 25px;

            border-radius: 50%;

            border:
                1px solid
                #dbe4ef;

            display: flex;

            align-items: center;

            justify-content: center;

            color: transparent;

            transition:
                .20s ease;

            flex-shrink: 0;
        }


        .answer-option.selected {

            border-color:
                #2674eb;

            background:
                linear-gradient(
                    135deg,
                    #f1f7ff,
                    #f7fcff
                );

            box-shadow:
                0 10px 28px
                rgba(38,116,235,.12);

            transform:
                translateY(-2px);
        }


        .answer-option.selected
        .answer-letter {

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #1769e8,
                    #08a9d2
                );

            box-shadow:
                0 6px 15px
                rgba(23,105,232,.20);
        }


        .answer-option.selected
        .answer-text {

            color: #1458b9;

            font-weight: 750;
        }


        .answer-option.selected
        .answer-check {

            color: white;

            border-color:
                #2674eb;

            background:
                #2674eb;
        }


        .answer-option input {
            display: none;
        }


        /* =====================================================
           INFO
        ===================================================== */

        .exam-info {

            flex-shrink: 0;

            margin-top: 10px;

            padding:
                8px 15px;

            border-radius: 14px;

            background:
                rgba(255,255,255,.75);

            border:
                1px solid
                #e1e9f4;

            color: #8091aa;

            font-size: 10px;

            text-align: center;
        }


        .exam-info i {

            color: #2570df;

            margin-right: 5px;
        }


        /* =====================================================
           ANIMATION
        ===================================================== */

        .question-changing {

            animation:
                questionIn .30s ease;
        }


        @keyframes questionIn {

            from {

                opacity: 0;

                transform:
                    translateY(8px);
            }

            to {

                opacity: 1;

                transform:
                    translateY(0);
            }
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-question {

            background: white;

            border:
                1px solid
                #e2e9f3;

            border-radius: 25px;

            padding:
                70px 25px;

            text-align: center;

            box-shadow:
                0 15px 40px
                rgba(37,71,119,.07);
        }


        .empty-question i {

            font-size: 50px;

            color: #8ca4c2;

            margin-bottom: 15px;
        }


        .empty-question h4 {

            color: #314f78;

            font-weight: 800;
        }


        .empty-question p {

            color: #8b9bb2;

            font-size: 13px;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 767px) {

            .exam-header {
                height: 82px;
            }


            .exam-header-inner {

                padding:
                    12px 15px;

                gap: 12px;
            }


            .exam-title {
                font-size: 20px;
            }


            .exam-package {
                font-size: 10px;
            }


            .exam-label {
                font-size: 8px;
            }


            .timer-box {

                min-width: 112px;

                padding:
                    8px 10px;

                border-radius: 13px;
            }


            .timer-label {
                font-size: 8px;
            }


            .timer {
                font-size: 18px;
            }


            .exam-page {

                height:
                    calc(100vh - 82px);

                padding:
                    12px 10px 8px;
            }


            .progress-card {

                padding:
                    11px 15px;

                border-radius: 17px;

                margin-bottom: 9px;
            }


            .question-card {

                padding:
                    18px 15px;

                border-radius: 21px;
            }


            .question-number {

                margin-bottom: 10px;

                padding:
                    6px 10px;

                font-size: 10px;
            }


            .question-text {

                font-size: 17px;

                line-height: 1.45;

                margin-bottom: 11px;

                max-height: 72px;
            }


            .answer-list {
                gap: 6px;
            }


            .answer-option {

                padding:
                    7px 10px;

                gap: 9px;

                border-radius: 12px;
            }


            .answer-letter {

                width: 34px;

                height: 34px;

                min-width: 34px;

                border-radius: 9px;

                font-size: 12px;
            }


            .answer-text {

                font-size: 11px;

                line-height: 1.3;
            }


            .answer-check {

                width: 21px;

                height: 21px;

                min-width: 21px;
            }


            .exam-info {

                margin-top: 7px;

                padding:
                    6px 10px;

                font-size: 8px;
            }
        }


        /* =====================================================
           HP KECIL
        ===================================================== */

        @media (max-width: 430px) {

            .exam-title {
                font-size: 17px;
            }


            .timer-box {

                min-width: 96px;

                padding:
                    7px 8px;
            }


            .timer {
                font-size: 16px;
            }


            .question-card {

                padding:
                    15px 12px;
            }


            .question-text {

                font-size: 15px;

                max-height: 64px;
            }


            .answer-option {

                padding:
                    6px 8px;
            }


            .answer-letter {

                width: 31px;

                height: 31px;

                min-width: 31px;
            }


            .answer-text {
                font-size: 10px;
            }
        }


        /* =====================================================
           LAPTOP PENDEK
        ===================================================== */

        @media (
            min-width: 768px
        ) and (
            max-height: 750px
        ) {

            .exam-header {
                height: 90px;
            }


            .exam-header-inner {

                padding:
                    14px 25px;
            }


            .exam-title {
                font-size: 24px;
            }


            .exam-page {

                height:
                    calc(100vh - 90px);

                padding:
                    14px 20px 10px;
            }


            .progress-card {

                padding:
                    10px 18px;

                margin-bottom: 9px;
            }


            .question-card {

                padding:
                    18px 28px;
            }


            .question-number {
                margin-bottom: 9px;
            }


            .question-text {

                font-size: 19px;

                line-height: 1.4;

                margin-bottom: 10px;

                max-height: 70px;
            }


            .answer-list {
                gap: 6px;
            }


            .answer-option {

                padding:
                    7px 14px;
            }


            .answer-letter {

                width: 36px;

                height: 36px;

                min-width: 36px;
            }


            .exam-info {

                margin-top: 7px;

                padding:
                    6px 12px;
            }
        }

    </style>

</head>


<body>


<!-- =========================================================
     HEADER
========================================================= -->

<header class="exam-header">

    <div class="exam-header-inner">

        <div class="exam-title-area">

            <div class="exam-label">

                <i class="bi bi-person-badge-fill"></i>

                ZAVIER LEARNING CENTER

            </div>


            <h1 class="exam-title">
                Ujian Kepribadian
            </h1>


            <div class="exam-package">

                {{ $paket->nama_paket }}

            </div>

        </div>


        <div class="timer-box">

            <div class="timer-label">
                Sisa Waktu
            </div>


            <div
                class="timer"
                id="timer"
            >
                {{ sprintf(
                    '%02d:%02d',
                    floor($durasiMenit / 60),
                    $durasiMenit % 60
                ) }}
            </div>

        </div>

    </div>

</header>


<!-- =========================================================
     MAIN
========================================================= -->

<main class="exam-page">


    @if($soal && $soal->count() > 0)


        <!-- =================================================
             PROGRESS
        ================================================== -->

        <div class="progress-card">

            <div class="progress-top">

                <span class="progress-label">
                    Progress pengerjaan
                </span>


                <span
                    class="progress-number"
                    id="progressNumber"
                >
                    1 / {{ $soal->count() }}
                </span>

            </div>


            <div class="progress-track">

                <div
                    class="progress-fill"
                    id="progressFill"
                ></div>

            </div>

        </div>


        <!-- =================================================
             FORM
        ================================================== -->

        <form
            method="POST"
            action="{{ route(
                'murid.kepribadian.selesai',
                ['paket' => $paket->id]
            ) }}"
            id="ujianForm"
        >

            @csrf


            <div
                class="question-card"
                id="questionCard"
            >

                <div class="question-content">


                    <div
                        class="question-number"
                        id="questionNumber"
                    >

                        <i class="bi bi-file-earmark-text-fill"></i>

                        Soal 1

                    </div>


                    <h2
                        class="question-text"
                        id="questionText"
                    ></h2>


                    <div
                        class="answer-list"
                        id="answerList"
                    ></div>


                </div>

            </div>


            <div class="exam-info">

                <i class="bi bi-info-circle-fill"></i>

                Pilih salah satu jawaban.
                Setelah dipilih, soal berikutnya akan tampil otomatis.

            </div>


        </form>


    @else


        <div class="empty-question">

            <i class="bi bi-clipboard-x"></i>


            <h4>
                Soal Ujian Tidak Ditemukan
            </h4>


            <p>
                Belum terdapat soal Kepribadian yang aktif
                untuk paket ini.
            </p>

        </div>


    @endif


</main>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* =====================================================
           DATA SOAL
        ===================================================== */

        const semuaSoal =
            @json($soal->values());


        /* =====================================================
           DURASI DARI PAKET SOAL
        ===================================================== */

        let durasiMenit =
            Number(
                @json($durasiMenit)
            );


        /*
         * Pastikan durasi valid.
         */

        if (
            !Number.isFinite(durasiMenit) ||
            durasiMenit <= 0
        ) {

            durasiMenit = 1;

        }


        /* =====================================================
           UBAH MENIT MENJADI DETIK
        ===================================================== */

        const waktuMulaiServer = Number(@json($startedAt ?? now()->timestamp));
        const batasServer = waktuMulaiServer + (durasiMenit * 60);
        let waktuTersisa = Math.max(0, batasServer - Math.floor(Date.now() / 1000));


        /* =====================================================
           ELEMENT
        ===================================================== */

        const questionCard =
            document.getElementById(
                'questionCard'
            );


        const questionNumber =
            document.getElementById(
                'questionNumber'
            );


        const questionText =
            document.getElementById(
                'questionText'
            );


        const answerList =
            document.getElementById(
                'answerList'
            );


        const progressNumber =
            document.getElementById(
                'progressNumber'
            );


        const progressFill =
            document.getElementById(
                'progressFill'
            );


        const timerElement =
            document.getElementById(
                'timer'
            );


        const form =
            document.getElementById(
                'ujianForm'
            );


        /* =====================================================
           VALIDASI
        ===================================================== */

        if (
            !questionCard ||
            !questionText ||
            !answerList ||
            !form ||
            !timerElement
        ) {

            return;

        }


        if (
            !Array.isArray(semuaSoal) ||
            semuaSoal.length === 0
        ) {

            return;

        }


        /* =====================================================
           STATE
        ===================================================== */

        let soalAktif = 0;

        let jawaban = {};

        let sedangPindah = false;

        let timerInterval = null;

        let ujianSudahSelesai = false;


        /* =====================================================
           FORMAT TIMER
        ===================================================== */

        function formatWaktu(
            totalDetik
        ) {

            totalDetik =
                Math.max(
                    0,
                    Math.floor(totalDetik)
                );


            const menit =
                Math.floor(
                    totalDetik / 60
                );


            const detik =
                totalDetik % 60;


            return (
                String(menit)
                    .padStart(2, '0')
                +
                ':'
                +
                String(detik)
                    .padStart(2, '0')
            );

        }


        /* =====================================================
           UPDATE TIMER
        ===================================================== */

        function updateTimer() {

            if (!timerElement) {
                return;
            }


            timerElement.textContent =
                formatWaktu(
                    waktuTersisa
                );


            timerElement.classList.remove(
                'warning',
                'danger'
            );


            /*
             * 5 menit terakhir
             */

            if (
                waktuTersisa <= 300 &&
                waktuTersisa > 60
            ) {

                timerElement.classList.add(
                    'warning'
                );

            }


            /*
             * 1 menit terakhir
             */

            if (
                waktuTersisa <= 60 &&
                waktuTersisa > 0
            ) {

                timerElement.classList.add(
                    'danger'
                );

            }


            /*
             * Waktu habis
             */

            if (
                waktuTersisa <= 0
            ) {

                waktuTersisa = 0;

                timerElement.textContent =
                    '00:00';

                selesaiOtomatis();

            }

        }


        /* =====================================================
           TIMER
        ===================================================== */

        function mulaiTimer() {

            /*
             * Hentikan timer lama jika ada.
             */

            if (timerInterval !== null) {

                clearInterval(
                    timerInterval
                );

            }


            /*
             * Tampilkan waktu awal.
             */

            updateTimer();


            /*
             * Jalankan timer setiap 1 detik.
             */

            timerInterval =
                setInterval(
                    function () {


                        if (
                            ujianSudahSelesai
                        ) {

                            clearInterval(
                                timerInterval
                            );

                            return;

                        }


                        if (
                            sedangPindah
                        ) {

                            return;

                        }


                        waktuTersisa--;


                        updateTimer();


                        if (
                            waktuTersisa <= 0
                        ) {

                            clearInterval(
                                timerInterval
                            );

                        }


                    },
                    1000
                );

        }


        /* =====================================================
           PROGRESS
        ===================================================== */

        function updateProgress() {

            const total =
                semuaSoal.length;


            const nomor =
                soalAktif + 1;


            if (progressNumber) {

                progressNumber.textContent =
                    nomor +
                    ' / ' +
                    total;

            }


            if (progressFill) {

                const persen =
                    (
                        nomor /
                        total
                    ) * 100;


                progressFill.style.width =
                    persen + '%';

            }

        }


        /* =====================================================
           SIMPAN JAWABAN KE FORM
        ===================================================== */

        function simpanJawabanKeForm() {

            Object.keys(
                jawaban
            ).forEach(
                function (soalId) {


                    let input =
                        form.querySelector(
                            'input[data-jawaban-id="' +
                            soalId +
                            '"]'
                        );


                    if (!input) {

                        input =
                            document.createElement(
                                'input'
                            );


                        input.type =
                            'hidden';


                        input.dataset.jawabanId =
                            soalId;


                        input.name =
                            'jawaban[' +
                            soalId +
                            ']';


                        form.appendChild(
                            input
                        );

                    }


                    input.value =
                        jawaban[
                            soalId
                        ];

                }
            );

        }


        /* =====================================================
           ACAK PILIHAN
           Fisher-Yates Shuffle
        ===================================================== */

        function acakPilihan(
            array
        ) {

            const hasil =
                [...array];


            for (
                let i =
                    hasil.length - 1;

                i > 0;

                i--
            ) {

                const j =
                    Math.floor(
                        Math.random() *
                        (i + 1)
                    );


                [
                    hasil[i],
                    hasil[j]
                ] =
                [
                    hasil[j],
                    hasil[i]
                ];

            }


            return hasil;

        }


        /* =====================================================
           TAMPILKAN SOAL
        ===================================================== */

        function tampilkanSoal() {

            const soal =
                semuaSoal[
                    soalAktif
                ];


            if (!soal) {
                return;
            }


            sedangPindah =
                false;


            /* =================================================
               ANIMASI
            ================================================= */

            questionCard.classList.remove(
                'question-changing'
            );


            void questionCard.offsetWidth;


            questionCard.classList.add(
                'question-changing'
            );


            /* =================================================
               NOMOR SOAL
            ================================================= */

            questionNumber.innerHTML =
                '<i class="bi bi-file-earmark-text-fill"></i>' +
                ' Soal ' +
                (soalAktif + 1);


            /* =================================================
               PERTANYAAN
            ================================================= */

            questionText.textContent =
                soal.pertanyaan || '';


            /* =================================================
               BERSIHKAN JAWABAN
            ================================================= */

            answerList.innerHTML =
                '';


            /* =================================================
               PILIHAN ASLI
            ================================================= */

            const pilihanAsli = [

                {
                    key: 'A',
                    text: soal.pilihan_a
                },

                {
                    key: 'B',
                    text: soal.pilihan_b
                },

                {
                    key: 'C',
                    text: soal.pilihan_c
                },

                {
                    key: 'D',
                    text: soal.pilihan_d
                },

                {
                    key: 'E',
                    text: soal.pilihan_e
                }

            ];


            /* =================================================
               FILTER PILIHAN KOSONG
            ================================================= */

            const pilihanValid =
                pilihanAsli.filter(
                    function (pilihan) {

                        return (
                            pilihan.text !== null &&
                            pilihan.text !== undefined &&
                            String(
                                pilihan.text
                            ).trim() !== ''
                        );

                    }
                );


            /* =================================================
               ACAK POSISI
            ================================================= */

            const pilihanAcak =
                acakPilihan(
                    pilihanValid
                );


            /* =================================================
               BUAT PILIHAN
            ================================================= */

            pilihanAcak.forEach(
                function (
                    pilihan,
                    index
                ) {


                    /*
                     * Huruf yang tampil:
                     * A, B, C, D, E
                     */

                    const hurufTampilan =
                        String.fromCharCode(
                            65 + index
                        );


                    /* =================================================
                       LABEL
                    ================================================= */

                    const label =
                        document.createElement(
                            'label'
                        );


                    label.className =
                        'answer-option';


                    /* =================================================
                       RADIO
                    ================================================= */

                    const radio =
                        document.createElement(
                            'input'
                        );


                    radio.type =
                        'radio';


                    radio.name =
                        'soal_' +
                        soal.id;


                    /*
                     * Penting:
                     * value tetap menggunakan
                     * kunci asli database.
                     */

                    radio.value =
                        pilihan.key;


                    /* =================================================
                       LETTER TAMPILAN
                    ================================================= */

                    const letter =
                        document.createElement(
                            'span'
                        );


                    letter.className =
                        'answer-letter';


                    letter.textContent =
                        hurufTampilan;


                    /* =================================================
                       TEXT
                    ================================================= */

                    const answerText =
                        document.createElement(
                            'span'
                        );


                    answerText.className =
                        'answer-text';


                    answerText.textContent =
                        pilihan.text;


                    /* =================================================
                       CHECK
                    ================================================= */

                    const check =
                        document.createElement(
                            'span'
                        );


                    check.className =
                        'answer-check';


                    check.innerHTML =
                        '<i class="bi bi-check-lg"></i>';


                    /* =================================================
                       SUSUN
                    ================================================= */

                    label.appendChild(
                        radio
                    );


                    label.appendChild(
                        letter
                    );


                    label.appendChild(
                        answerText
                    );


                    label.appendChild(
                        check
                    );


                    /* =================================================
                       JAWABAN SEBELUMNYA
                    ================================================= */

                    if (
                        jawaban[soal.id] ===
                        pilihan.key
                    ) {

                        radio.checked =
                            true;


                        label.classList.add(
                            'selected'
                        );

                    }


                    /* =================================================
                       KLIK JAWABAN
                    ================================================= */

                    label.addEventListener(
                        'click',
                        function () {


                            if (
                                sedangPindah ||
                                ujianSudahSelesai
                            ) {

                                return;

                            }


                            sedangPindah =
                                true;


                            /*
                             * Simpan kunci asli.
                             *
                             * Contoh:
                             *
                             * Tampilan:
                             * A = "Sangat Setuju"
                             *
                             * Tetapi pilihan asli:
                             * C
                             *
                             * Yang disimpan tetap C.
                             */

                            jawaban[soal.id] =
                                pilihan.key;


                            radio.checked =
                                true;


                            label.classList.add(
                                'selected'
                            );


                            /* =================================================
                               SIMPAN KE FORM
                            ================================================= */

                            simpanJawabanKeForm();


                            /* =================================================
                               LANJUT SOAL
                            ================================================= */

                            setTimeout(
                                function () {


                                    if (
                                        soalAktif <
                                        semuaSoal.length - 1
                                    ) {


                                        soalAktif++;


                                        updateProgress();


                                        tampilkanSoal();


                                    } else {


                                        selesaiUjian();

                                    }


                                },
                                280
                            );

                        }
                    );


                    /* =================================================
                       MASUKKAN KE DOM
                    ================================================= */

                    answerList.appendChild(
                        label
                    );

                }
            );


            /* =================================================
               UPDATE PROGRESS
            ================================================= */

            updateProgress();

        }


        /* =====================================================
           SELESAI UJIAN
        ===================================================== */

        function selesaiUjian() {

            if (
                ujianSudahSelesai
            ) {

                return;

            }


            simpanJawabanKeForm();


            ujianSudahSelesai =
                true;


            sedangPindah =
                true;


            if (
                timerInterval !== null
            ) {

                clearInterval(
                    timerInterval
                );

            }


            form.submit();

        }


        /* =====================================================
           WAKTU HABIS
        ===================================================== */

        function selesaiOtomatis() {

            if (
                ujianSudahSelesai
            ) {

                return;

            }


            ujianSudahSelesai =
                true;


            sedangPindah =
                true;


            simpanJawabanKeForm();


            if (
                timerInterval !== null
            ) {

                clearInterval(
                    timerInterval
                );

            }


            /*
             * Submit otomatis ketika waktu habis.
             */

            form.submit();

        }


        /* =====================================================
           MULAI UJIAN
        ===================================================== */

        tampilkanSoal();


        /*
         * Timer dimulai setelah soal berhasil
         * ditampilkan.
         */

        mulaiTimer();

    }
);

</script>


</body>

</html>