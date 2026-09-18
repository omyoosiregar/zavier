<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Paket Soal - POLRI CERMAT</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            background: #f4f7fb;
            color: #1e293b;
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(
                135deg,
                #2563eb,
                #06b6d4
            );

            color: white;

            padding: 25px;

            border-radius: 18px 18px 0 0;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 13px;
            opacity: .9;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 0 0 18px 18px;
            box-shadow: 0 5px 20px rgba(0,0,0,.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 7px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #2563eb;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .readonly {
            background: #f1f5f9;
            color: #64748b;
        }

        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        @media(max-width: 650px) {

            .container {
                margin: 15px auto;
                padding: 10px;
            }

            .card {
                padding: 20px;
            }

            .row {
                grid-template-columns: 1fr;
            }

            .buttons {
                flex-direction: column;
            }

            .btn {
                text-align: center;
            }

        }

    </style>

</head>

<body>

<div class="container">

    <div class="header">

        <h1>
            ✏️ Edit Paket Soal
        </h1>

        <p>
            Perbarui informasi paket soal kecermatan
        </p>

    </div>


    <div class="card">

        <form
            method="POST"
            action="{{ route('admin.paket-soal.update', $paketSoal->id) }}"
        >

            @csrf

            @method('PUT')


            {{-- NAMA PAKET --}}

            <div class="form-group">

                <label>
                    Nama Paket
                </label>

                <input
                    type="text"
                    name="nama_paket"
                    value="{{ old('nama_paket', $paketSoal->nama_paket) }}"
                    required
                >

                @error('nama_paket')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- JENIS TES --}}

            <div class="form-group">

                <label>
                    Jenis Tes
                </label>

                <input
                    type="text"
                    value="Kecermatan"
                    class="readonly"
                    readonly
                >

            </div>


            {{-- KETERANGAN --}}

            <div class="form-group">

                <label>
                    Keterangan
                </label>

                <textarea
                    name="keterangan"
                    placeholder="Masukkan keterangan paket soal..."
                >{{ old('keterangan', $paketSoal->keterangan) }}</textarea>

                @error('keterangan')
                    <div class="error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- JUMLAH + DURASI --}}

            <div class="row">


                <div class="form-group">

                    <label>
                        Jumlah Soal
                    </label>

                    <input
                        type="number"
                        name="jumlah_soal"
                        min="1"
                        max="100"
                        value="{{ old('jumlah_soal', $paketSoal->jumlah_soal) }}"
                        required
                    >

                    @error('jumlah_soal')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Durasi (Menit)
                    </label>

                    <input
                        type="number"
                        name="durasi"
                        min="1"
                        max="180"
                        value="{{ old('durasi', $paketSoal->durasi) }}"
                        required
                    >

                    @error('durasi')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


            </div>


            {{-- TINGKAT + STATUS --}}

            <div class="row">


                <div class="form-group">

                    <label>
                        Tingkat Kesulitan
                    </label>

                    <select name="tingkat" required>

                        <option value="Mudah"
                            {{ old('tingkat', $paketSoal->tingkat) == 'Mudah' ? 'selected' : '' }}>
                            Mudah
                        </option>

                        <option value="Sedang"
                            {{ old('tingkat', $paketSoal->tingkat) == 'Sedang' ? 'selected' : '' }}>
                            Sedang
                        </option>

                        <option value="Sulit"
                            {{ old('tingkat', $paketSoal->tingkat) == 'Sulit' ? 'selected' : '' }}>
                            Sulit
                        </option>

                    </select>

                    @error('tingkat')
                        <div class="error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Status
                    </label>

                    <select name="status" required>

                        <option value="1"
                            {{ old('status', $paketSoal->status) == 1 ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0"
                            {{ old('status', $paketSoal->status) == 0 ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>

                </div>


            </div>


            {{-- BUTTON --}}

            <div class="buttons">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    💾 Simpan Perubahan
                </button>

                <a
                    href="{{ route('admin.paket-soal') }}"
                    class="btn btn-secondary"
                >
                    ← Kembali
                </a>

            </div>


        </form>

    </div>

</div>

</body>

</html>