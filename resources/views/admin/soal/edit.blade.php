<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Soal - POLRI CERMAT</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background: #f4f7fb;
            color: #1e293b;
            min-height: 100vh;
        }

        /* ================= HEADER ================= */

        .header {
            background: linear-gradient(135deg, #0f172a, #172554);
            color: white;
            padding: 20px 30px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, .15);
        }

        .header-inner {
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px;
        }

        .brand h2 {
            font-size: 19px;
        }

        .brand p {
            color: #94a3b8;
            font-size: 11px;
            margin-top: 3px;
        }

        /* ================= CONTAINER ================= */

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* ================= TOP ================= */

        .page-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            gap: 15px;
        }

        .page-title h1 {
            font-size: 25px;
            margin-bottom: 5px;
        }

        .page-title p {
            color: #64748b;
            font-size: 13px;
        }

        /* ================= BUTTON ================= */

        .btn {
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 17px;
            border-radius: 10px;
            font-size: 13px;
            cursor: pointer;
            transition: .2s;
        }

        .btn-back {
            background: white;
            color: #334155;
            border: 1px solid #e2e8f0;
        }

        .btn-back:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-save {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            color: white;
            padding: 13px 25px;
            font-weight: 600;
        }

        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(37, 99, 235, .25);
        }

        /* ================= CARD ================= */

        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, .04);
            margin-bottom: 20px;
        }

        .card-header {
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 17px;
            margin-bottom: 22px;
        }

        .card-header h3 {
            font-size: 16px;
        }

        .card-header p {
            color: #64748b;
            font-size: 12px;
            margin-top: 4px;
        }

        /* ================= FORM ================= */

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 7px;
            color: #334155;
        }

        .required {
            color: #ef4444;
        }

        input,
        textarea,
        select {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 11px 13px;
            font-size: 13px;
            color: #1e293b;
            background: white;
            outline: none;
            transition: .2s;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
        }

        /* ================= PILIHAN ================= */

        .choices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .choice {
            position: relative;
        }

        .choice-label {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .choice-badge {
            width: 27px;
            height: 27px;
            border-radius: 8px;
            background: #eff6ff;
            color: #2563eb;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 12px;
        }

        /* ================= STATUS ================= */

        .status-box {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        .status-box input {
            width: auto;
        }

        .status-text strong {
            display: block;
            font-size: 13px;
        }

        .status-text small {
            color: #64748b;
            font-size: 11px;
        }

        /* ================= ERROR ================= */

        .alert {
            border-radius: 10px;
            padding: 13px 15px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-danger ul {
            margin: 7px 0 0 18px;
        }

        .field-error {
            color: #dc2626;
            font-size: 11px;
            margin-top: 5px;
        }

        /* ================= FOOTER BUTTON ================= */

        .form-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            padding-top: 5px;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width: 700px) {

            .header {
                padding: 17px 15px;
            }

            .container {
                margin: 20px auto;
                padding: 0 15px;
            }

            .page-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-top .btn {
                width: 100%;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-group.full {
                grid-column: auto;
            }

            .choices {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 18px;
            }

            .form-footer {
                flex-direction: column-reverse;
            }

            .form-footer .btn {
                width: 100%;
            }
        }
    </style>
</head>


<body>

    <!-- ================= HEADER ================= -->

    <header class="header">

        <div class="header-inner">

            <div class="brand">

                <div class="brand-icon">
                    PC
                </div>

                <div>
                    <h2>POLRI CERMAT</h2>
                    <p>Examination System</p>
                </div>

            </div>

        </div>

    </header>


    <!-- ================= CONTENT ================= -->

    <main class="container">


        <!-- PAGE TITLE -->

        <div class="page-top">

            <div class="page-title">

                <h1>✏️ Edit Soal</h1>

                <p>
                    Perbarui data soal kecermatan POLRI
                </p>

            </div>


            <a href="{{ route('admin.soal') }}" class="btn btn-back">
                ← Kembali ke Bank Soal
            </a>

        </div>



        <!-- ================= VALIDATION ERROR ================= -->

        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>
                    ⚠️ Terdapat kesalahan:
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif



        <!-- ================= FORM ================= -->

        <form
            action="{{ route('admin.soal.update', $soal) }}"
            method="POST"
            id="editSoalForm"
        >

            @csrf
            @method('PUT')


            <!-- ================= INFORMASI SOAL ================= -->

            <div class="card">

                <div class="card-header">

                    <h3>
                        📋 Informasi Soal
                    </h3>

                    <p>
                        Atur kategori, pertanyaan, tingkat kesulitan,
                        dan status soal.
                    </p>

                </div>


                <div class="form-grid">


                    <!-- KATEGORI -->

                    <div class="form-group">

                        <label>
                            Kategori <span class="required">*</span>
                        </label>

                        <select name="kategori" required>

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            <option value="Huruf"
                                {{ old('kategori', $soal->kategori) == 'Huruf' ? 'selected' : '' }}>
                                Huruf
                            </option>

                            <option value="Angka"
                                {{ old('kategori', $soal->kategori) == 'Angka' ? 'selected' : '' }}>
                                Angka
                            </option>

                            <option value="Simbol"
                                {{ old('kategori', $soal->kategori) == 'Simbol' ? 'selected' : '' }}>
                                Simbol
                            </option>

                            <option value="Gabungan"
                                {{ old('kategori', $soal->kategori) == 'Gabungan' ? 'selected' : '' }}>
                                Gabungan
                            </option>

                        </select>

                        @error('kategori')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <!-- TINGKAT -->

                    <div class="form-group">

                        <label>
                            Tingkat Kesulitan <span class="required">*</span>
                        </label>

                        <select name="tingkat" required>

                            <option value="Mudah"
                                {{ old('tingkat', $soal->tingkat) == 'Mudah' ? 'selected' : '' }}>
                                🟢 Mudah
                            </option>

                            <option value="Sedang"
                                {{ old('tingkat', $soal->tingkat) == 'Sedang' ? 'selected' : '' }}>
                                🟡 Sedang
                            </option>

                            <option value="Sulit"
                                {{ old('tingkat', $soal->tingkat) == 'Sulit' ? 'selected' : '' }}>
                                🔴 Sulit
                            </option>

                        </select>

                        @error('tingkat')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <!-- PERTANYAAN -->

                    <div class="form-group full">

                        <label>
                            Pertanyaan <span class="required">*</span>
                        </label>

                        <textarea
                            name="pertanyaan"
                            placeholder="Masukkan pertanyaan soal..."
                            required
                        >{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>

                        @error('pertanyaan')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>



            <!-- ================= PILIHAN JAWABAN ================= -->

            <div class="card">

                <div class="card-header">

                    <h3>
                        🔤 Pilihan Jawaban
                    </h3>

                    <p>
                        Masukkan lima pilihan jawaban untuk soal.
                    </p>

                </div>


                <div class="choices">


                    <!-- A -->

                    <div class="choice form-group">

                        <label class="choice-label">

                            <span class="choice-badge">
                                A
                            </span>

                            Pilihan A

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="pilihan_a"
                            value="{{ old('pilihan_a', $soal->pilihan_a) }}"
                            placeholder="Pilihan A"
                            required
                        >

                        @error('pilihan_a')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <!-- B -->

                    <div class="choice form-group">

                        <label class="choice-label">

                            <span class="choice-badge">
                                B
                            </span>

                            Pilihan B

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="pilihan_b"
                            value="{{ old('pilihan_b', $soal->pilihan_b) }}"
                            placeholder="Pilihan B"
                            required
                        >

                        @error('pilihan_b')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <!-- C -->

                    <div class="choice form-group">

                        <label class="choice-label">

                            <span class="choice-badge">
                                C
                            </span>

                            Pilihan C

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="pilihan_c"
                            value="{{ old('pilihan_c', $soal->pilihan_c) }}"
                            placeholder="Pilihan C"
                            required
                        >

                        @error('pilihan_c')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <!-- D -->

                    <div class="choice form-group">

                        <label class="choice-label">

                            <span class="choice-badge">
                                D
                            </span>

                            Pilihan D

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="pilihan_d"
                            value="{{ old('pilihan_d', $soal->pilihan_d) }}"
                            placeholder="Pilihan D"
                            required
                        >

                        @error('pilihan_d')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <!-- E -->

                    <div class="choice form-group">

                        <label class="choice-label">

                            <span class="choice-badge">
                                E
                            </span>

                            Pilihan E

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="pilihan_e"
                            value="{{ old('pilihan_e', $soal->pilihan_e) }}"
                            placeholder="Pilihan E"
                            required
                        >

                        @error('pilihan_e')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>



            <!-- ================= JAWABAN & STATUS ================= -->

            <div class="card">

                <div class="card-header">

                    <h3>
                        ✅ Kunci Jawaban & Status
                    </h3>

                    <p>
                        Tentukan jawaban yang benar dan status soal.
                    </p>

                </div>


                <div class="form-grid">


                    <!-- JAWABAN BENAR -->

                    <div class="form-group">

                        <label>
                            Jawaban Benar <span class="required">*</span>
                        </label>

                        <select name="jawaban_benar" required>

                            <option value="A"
                                {{ old('jawaban_benar', $soal->jawaban_benar) == 'A' ? 'selected' : '' }}>
                                A
                            </option>

                            <option value="B"
                                {{ old('jawaban_benar', $soal->jawaban_benar) == 'B' ? 'selected' : '' }}>
                                B
                            </option>

                            <option value="C"
                                {{ old('jawaban_benar', $soal->jawaban_benar) == 'C' ? 'selected' : '' }}>
                                C
                            </option>

                            <option value="D"
                                {{ old('jawaban_benar', $soal->jawaban_benar) == 'D' ? 'selected' : '' }}>
                                D
                            </option>

                            <option value="E"
                                {{ old('jawaban_benar', $soal->jawaban_benar) == 'E' ? 'selected' : '' }}>
                                E
                            </option>

                        </select>

                        @error('jawaban_benar')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <!-- STATUS -->

                    <div class="form-group">

                        <label>
                            Status Soal
                        </label>

                        <div class="status-box">

                            <input
                                type="hidden"
                                name="status"
                                value="0"
                            >

                            <input
                                type="checkbox"
                                name="status"
                                value="1"
                                id="status"
                                {{ old('status', $soal->status) ? 'checked' : '' }}
                            >

                            <label
                                for="status"
                                class="status-text"
                                style="margin:0; cursor:pointer;"
                            >

                                <strong>
                                    Soal Aktif
                                </strong>

                                <small>
                                    Soal dapat digunakan dalam paket ujian.
                                </small>

                            </label>

                        </div>

                        @error('status')
                            <div class="field-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>



            <!-- ================= ACTION ================= -->

            <div class="form-footer">

                <a
                    href="{{ route('admin.soal') }}"
                    class="btn btn-back"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-save"
                >
                    💾 Simpan Perubahan
                </button>

            </div>


        </form>

    </main>


    <!-- ================= JAVASCRIPT ================= -->

    <script>

        document
            .getElementById('editSoalForm')
            .addEventListener('submit', function(event) {

                const confirmed = confirm(
                    'Apakah Anda yakin ingin menyimpan perubahan soal ini?'
                );

                if (!confirmed) {
                    event.preventDefault();
                }

            });

    </script>

</body>

</html>