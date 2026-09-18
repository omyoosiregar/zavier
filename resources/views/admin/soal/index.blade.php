<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bank Soal - POLRI Cermat</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        .container {
            width: 94%;
            max-width: 1450px;
            margin: 30px auto;
        }

        /* HEADER */

        .header {
            background: linear-gradient(
                135deg,
                #0f4c81,
                #1976d2,
                #38bdf8
            );

            color: white;
            padding: 30px;
            border-radius: 20px;

            box-shadow:
                0 15px 35px rgba(15, 76, 129, .20);

            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .header p {
            opacity: .90;
            font-size: 15px;
        }


        /* ALERT */

        .alert {
            padding: 15px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }


        /* TOOLBAR */

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;

            gap: 15px;
            margin-bottom: 20px;

            flex-wrap: wrap;
        }

        .toolbar-left {
            display: flex;
            gap: 10px;
        }

        .btn {
            border: none;
            padding: 11px 18px;

            border-radius: 10px;

            font-size: 14px;
            font-weight: bold;

            cursor: pointer;

            text-decoration: none;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            transition: .2s;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-dashboard {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-generator {
            background: linear-gradient(
                135deg,
                #2563eb,
                #0284c7
            );

            color: white;

            box-shadow:
                0 7px 18px rgba(37, 99, 235, .20);
        }

        .btn-edit {
            background: #f59e0b;
            color: white;
        }

        .btn-delete {
            background: #dc2626;
            color: white;
        }


        /* TABLE */

        .table-box {
            background: white;

            border-radius: 18px;

            padding: 20px;

            box-shadow:
                0 8px 30px rgba(15, 23, 42, .07);

            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;

            min-width: 1200px;
        }

        th {
            background: #f1f5f9;

            padding: 14px;

            text-align: left;

            font-size: 13px;

            color: #334155;

            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 14px;

            border-bottom: 1px solid #e5e7eb;

            vertical-align: top;

            font-size: 14px;
        }

        tr:hover {
            background: #f8fafc;
        }

        .question {
            min-width: 280px;
            max-width: 420px;

            line-height: 1.6;
        }

        .choices {
            line-height: 1.8;
            min-width: 220px;
        }


        /* BADGE */

        .badge {
            display: inline-block;

            padding: 6px 11px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;
        }

        .badge-category {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-level {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
        }


        /* ACTION */

        .action-buttons {
            display: flex;

            gap: 7px;

            flex-wrap: wrap;
        }


        /* EMPTY */

        .empty {
            text-align: center;

            padding: 70px 20px;

            color: #64748b;
        }

        .empty-icon {
            font-size: 55px;

            margin-bottom: 15px;
        }

        .empty h3 {
            margin-bottom: 8px;

            color: #334155;
        }


        /* MODAL */

        .modal {
            display: none;

            position: fixed;

            z-index: 9999;

            inset: 0;

            background: rgba(15, 23, 42, .65);

            padding: 30px 15px;

            overflow-y: auto;
        }

        .modal.show {
            display: flex;

            align-items: flex-start;

            justify-content: center;
        }

        .modal-content {
            background: white;

            width: 100%;

            max-width: 600px;

            margin: 30px auto;

            border-radius: 22px;

            padding: 30px;

            box-shadow:
                0 25px 70px rgba(0, 0, 0, .25);

            animation: modalShow .2s ease;
        }

        @keyframes modalShow {

            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        .modal-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 25px;
        }

        .modal-header h2 {
            color: #0f4c81;

            font-size: 23px;
        }

        .modal-header p {
            color: #64748b;

            font-size: 13px;

            margin-top: 5px;
        }

        .close {
            width: 36px;
            height: 36px;

            border-radius: 50%;

            background: #f1f5f9;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 22px;

            cursor: pointer;

            color: #475569;
        }

        .close:hover {
            background: #e2e8f0;
        }


        /* FORM */

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            font-weight: bold;

            font-size: 14px;

            color: #334155;
        }

        .form-group select,
        .form-group input {
            width: 100%;

            padding: 13px 14px;

            border: 1px solid #cbd5e1;

            border-radius: 10px;

            background: white;

            font-size: 14px;

            outline: none;
        }

        .form-group select:focus,
        .form-group input:focus {
            border-color: #1976d2;

            box-shadow:
                0 0 0 3px rgba(25, 118, 210, .10);
        }

        .info-box {
            background: #eff6ff;

            border: 1px solid #bfdbfe;

            color: #1e40af;

            padding: 13px 15px;

            border-radius: 10px;

            font-size: 13px;

            line-height: 1.6;

            margin-bottom: 20px;
        }

        .form-footer {
            display: flex;

            justify-content: flex-end;

            gap: 10px;

            margin-top: 25px;
        }


        /* CATEGORY PREVIEW */

        .category-preview {
            display: none;

            padding: 14px;

            border-radius: 10px;

            background: #f8fafc;

            border: 1px solid #e2e8f0;

            margin-top: 10px;

            font-size: 13px;

            color: #475569;
        }

        .category-preview.show {
            display: block;
        }


        /* RESPONSIVE */

        @media (max-width: 700px) {

            .container {
                width: 92%;
            }

            .header {
                padding: 22px;
            }

            .header h1 {
                font-size: 23px;
            }

            .toolbar {
                align-items: stretch;
            }

            .toolbar-left {
                width: 100%;
            }

            .btn {
                width: 100%;
            }

            .toolbar-left .btn {
                flex: 1;
            }

            .modal-content {
                padding: 22px;
            }

        }

    </style>

</head>


<body>


<div class="container">


    <!-- HEADER -->

    <div class="header">

        <h1>
            📚 Bank Soal
        </h1>

        <p>
            Generator soal otomatis untuk sistem POLRI Cermat
        </p>

    </div>


    <!-- ALERT SUCCESS -->

    @if(session('success'))

        <div class="alert alert-success">

            ✅ {{ session('success') }}

        </div>

    @endif


    <!-- ALERT ERROR -->

    @if(session('error'))

        <div class="alert alert-error">

            ❌ {{ session('error') }}

        </div>

    @endif


    <!-- VALIDATION ERROR -->

    @if($errors->any())

        <div class="alert alert-error">

            <strong>Terjadi kesalahan:</strong>

            <ul style="margin-top: 8px; margin-left: 20px;">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- TOOLBAR -->

    <div class="toolbar">


        <div class="toolbar-left">

            <a
                href="{{ route('admin.dashboard') }}"
                class="btn btn-dashboard"
            >
                ← Dashboard
            </a>

        </div>


        <button
            type="button"
            onclick="openGenerator()"
            class="btn btn-generator"
        >
            ⚡ Generate Soal Otomatis
        </button>


    </div>


    <!-- TABLE -->

    <div class="table-box">


        @if($soals->count() > 0)


            <table>

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Kategori</th>

                        <th>Pertanyaan</th>

                        <th>Pilihan Jawaban</th>

                        <th>Jawaban</th>

                        <th>Tingkat</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>


                @foreach($soals as $index => $soal)


                    <tr>


                        <td>

                            <strong>
                                {{ $index + 1 }}
                            </strong>

                        </td>


                        <td>

                            <span class="badge badge-category">

                                {{ $soal->kategori }}

                            </span>

                        </td>


                        <td class="question">

                            {{ $soal->pertanyaan }}

                        </td>


                        <td class="choices">

                            <div>
                                <strong>A.</strong>
                                {{ $soal->pilihan_a }}
                            </div>

                            <div>
                                <strong>B.</strong>
                                {{ $soal->pilihan_b }}
                            </div>

                            <div>
                                <strong>C.</strong>
                                {{ $soal->pilihan_c }}
                            </div>

                            <div>
                                <strong>D.</strong>
                                {{ $soal->pilihan_d }}
                            </div>

                            <div>
                                <strong>E.</strong>
                                {{ $soal->pilihan_e }}
                            </div>

                        </td>


                        <td>

                            <strong style="font-size: 18px;">

                                {{ $soal->jawaban_benar }}

                            </strong>

                        </td>


                        <td>

                            <span class="badge badge-level">

                                {{ $soal->tingkat }}

                            </span>

                        </td>


                        <td>

                            @if($soal->status)

                                <span class="badge badge-active">
                                    Aktif
                                </span>

                            @else

                                <span class="badge badge-inactive">
                                    Nonaktif
                                </span>

                            @endif

                        </td>


                        <td>

                            <div class="action-buttons">


                                <a
                                    href="{{ route('admin.soal.edit', $soal->id) }}"
                                    class="btn btn-edit"
                                >
                                    ✏️ Edit
                                </a>


                                <form
                                    action="{{ route('admin.soal.destroy', $soal->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus soal ini?')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-delete"
                                    >
                                        🗑️ Hapus
                                    </button>

                                </form>


                            </div>

                        </td>


                    </tr>


                @endforeach


                </tbody>

            </table>


        @else


            <div class="empty">

                <div class="empty-icon">
                    📭
                </div>

                <h3>
                    Belum Ada Soal
                </h3>

                <p>
                    Klik tombol
                    <strong>Generate Soal Otomatis</strong>
                    untuk membuat soal.
                </p>

            </div>


        @endif


    </div>


</div>



<!-- ===================================================== -->
<!-- MODAL GENERATOR -->
<!-- ===================================================== -->


<div
    id="generatorModal"
    class="modal"
>


    <div class="modal-content">


        <div class="modal-header">


            <div>

                <h2>
                    ⚡ Generator Soal
                </h2>

                <p>
                    Buat soal secara otomatis
                </p>

            </div>


            <div
                class="close"
                onclick="closeGenerator()"
            >
                ×
            </div>


        </div>


        <div class="info-box">

            💡 Pilih kategori soal dan jumlah soal.
            Sistem akan membuat pertanyaan, pilihan jawaban,
            serta jawaban benar secara otomatis.

        </div>


        <form
            action="{{ route('admin.soal.generate') }}"
            method="POST"
        >

            @csrf


            <!-- KATEGORI -->

            <div class="form-group">

                <label>
                    📂 Kategori Soal
                </label>


                <select
                    name="kategori"
                    id="kategori"
                    onchange="showCategoryInfo()"
                    required
                >

                    <option value="">
                        -- Pilih Kategori --
                    </option>

                    <option value="Huruf">
                        🔤 Huruf
                    </option>

                    <option value="Angka">
                        🔢 Angka
                    </option>

                    <option value="Simbol">
                        🔣 Simbol
                    </option>

                    <option value="Gabungan">
                        🔀 Gabungan
                    </option>

                </select>


                <div
                    id="categoryInfo"
                    class="category-preview"
                ></div>


            </div>


            <!-- JUMLAH -->

            <div class="form-group">

                <label>
                    🔢 Jumlah Soal
                </label>


                <select
                    name="jumlah"
                    required
                >

                    <option value="5">
                        5 Soal
                    </option>

                    <option value="10" selected>
                        10 Soal
                    </option>

                    <option value="20">
                        20 Soal
                    </option>

                    <option value="30">
                        30 Soal
                    </option>

                    <option value="50">
                        50 Soal
                    </option>

                    <option value="100">
                        100 Soal
                    </option>

                </select>

            </div>


            <!-- TINGKAT -->

            <div class="form-group">

                <label>
                    🎯 Tingkat Kesulitan
                </label>


                <select
                    name="tingkat"
                    required
                >

                    <option value="Mudah">
                        🟢 Mudah
                    </option>

                    <option value="Sedang" selected>
                        🟡 Sedang
                    </option>

                    <option value="Sulit">
                        🔴 Sulit
                    </option>

                </select>

            </div>


            <!-- FOOTER -->

            <div class="form-footer">


                <button
                    type="button"
                    onclick="closeGenerator()"
                    class="btn btn-dashboard"
                >
                    Batal
                </button>


                <button
                    type="submit"
                    class="btn btn-generator"
                    onclick="return confirmGenerate()"
                >
                    ⚡ Generate Sekarang
                </button>


            </div>


        </form>


    </div>

</div>



<script>


    /*
    |--------------------------------------------------------------------------
    | BUKA MODAL
    |--------------------------------------------------------------------------
    */

    function openGenerator() {

        document
            .getElementById('generatorModal')
            .classList.add('show');

    }


    /*
    |--------------------------------------------------------------------------
    | TUTUP MODAL
    |--------------------------------------------------------------------------
    */

    function closeGenerator() {

        document
            .getElementById('generatorModal')
            .classList.remove('show');

    }


    /*
    |--------------------------------------------------------------------------
    | INFO KATEGORI
    |--------------------------------------------------------------------------
    */

    function showCategoryInfo() {

        const kategori =
            document.getElementById('kategori').value;

        const info =
            document.getElementById('categoryInfo');


        if (kategori === 'Huruf') {

            info.innerHTML =
                '🔤 Sistem akan membuat soal berdasarkan pola huruf secara otomatis.';

            info.classList.add('show');

        }

        else if (kategori === 'Angka') {

            info.innerHTML =
                '🔢 Sistem akan membuat soal berdasarkan pola angka secara otomatis.';

            info.classList.add('show');

        }

        else if (kategori === 'Simbol') {

            info.innerHTML =
                '🔣 Sistem akan membuat soal berdasarkan pola simbol secara otomatis.';

            info.classList.add('show');

        }

        else if (kategori === 'Gabungan') {

            info.innerHTML =
                '🔀 Sistem akan membuat soal gabungan huruf, angka, dan simbol secara otomatis.';

            info.classList.add('show');

        }

        else {

            info.innerHTML = '';

            info.classList.remove('show');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI GENERATE
    |--------------------------------------------------------------------------
    */

    function confirmGenerate() {

        const kategori =
            document.getElementById('kategori').value;


        if (!kategori) {

            alert('Silakan pilih kategori soal terlebih dahulu.');

            return false;

        }


        return confirm(
            'Soal akan dibuat secara otomatis berdasarkan kategori "' +
            kategori +
            '". Lanjutkan?'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | KLIK DI LUAR MODAL
    |--------------------------------------------------------------------------
    */

    window.onclick = function(event) {

        const modal =
            document.getElementById('generatorModal');


        if (event.target === modal) {

            closeGenerator();

        }

    };


    /*
    |--------------------------------------------------------------------------
    | ESC UNTUK MENUTUP MODAL
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key === 'Escape') {

                closeGenerator();

            }

        }
    );


</script>


</body>

</html>