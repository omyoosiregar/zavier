@extends('layouts.admin-zavier')

@section('title', 'Generate Paket Soal Kecermatan')

@section('content')

<style>

    .kecermatan-page {
        min-height: calc(100vh - 80px);

        background:
            linear-gradient(
                135deg,
                #f8fbff 0%,
                #eef6ff 50%,
                #f8fbff 100%
            );

        padding: 35px 30px 60px;
    }


    .kecermatan-container {
        max-width: 1200px;
        margin: 0 auto;
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;

        margin-bottom: 28px;
    }


    .page-label {
        display: inline-block;

        color: #2563eb;

        font-size: 12px;
        font-weight: 800;

        letter-spacing: 2px;

        margin-bottom: 8px;
    }


    .page-title {
        margin: 0;

        color: #172554;

        font-size: 34px;
        font-weight: 800;

        line-height: 1.2;
    }


    .page-subtitle {
        margin: 8px 0 0;

        color: #64748b;

        font-size: 15px;

        line-height: 1.6;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .alert-success {
        display: flex;
        align-items: center;
        gap: 12px;

        margin-bottom: 25px;

        padding: 15px 18px;

        border-radius: 13px;

        background: #f0fdf4;

        border: 1px solid #bbf7d0;

        color: #15803d;

        font-size: 14px;
        font-weight: 600;
    }


    .alert-success i {
        font-size: 20px;
    }


    .alert-error {
        margin-bottom: 25px;

        padding: 16px 18px;

        border-radius: 13px;

        background: #fef2f2;

        border: 1px solid #fecaca;

        color: #b91c1c;

        font-size: 14px;
    }


    .alert-error ul {
        margin: 8px 0 0 20px;
    }


    /* =========================================================
       GENERATOR
    ========================================================= */

    .generator-card {
        background: #ffffff;

        border: 1px solid #dbeafe;

        border-radius: 22px;

        padding: 30px;

        box-shadow:
            0 15px 40px
            rgba(15, 23, 42, .07);

        margin-bottom: 35px;
    }


    .generator-heading {
        display: flex;
        align-items: center;

        gap: 14px;

        padding-bottom: 22px;

        margin-bottom: 25px;

        border-bottom: 1px solid #e2e8f0;
    }


    .generator-icon {
        width: 55px;
        height: 55px;

        min-width: 55px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 15px;

        background: #dbeafe;

        color: #2563eb;

        font-size: 25px;
    }


    .generator-heading h2 {
        margin: 0;

        color: #172554;

        font-size: 21px;
        font-weight: 800;
    }


    .generator-heading p {
        margin: 4px 0 0;

        color: #94a3b8;

        font-size: 13px;
    }


    /* =========================================================
       FORM
    ========================================================= */

    .form-grid {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 21px;
    }


    .form-group {
        display: flex;

        flex-direction: column;
    }


    .form-group.full {
        grid-column: 1 / -1;
    }


    .form-label {
        margin-bottom: 8px;

        color: #334155;

        font-size: 13px;
        font-weight: 700;
    }


    .form-control {
        width: 100%;

        box-sizing: border-box;

        padding: 13px 15px;

        border: 1px solid #cbd5e1;

        border-radius: 11px;

        background: #ffffff;

        color: #1e293b;

        font-size: 14px;

        outline: none;

        transition: .2s;
    }


    .form-control:focus {
        border-color: #2563eb;

        box-shadow:
            0 0 0 3px
            rgba(37, 99, 235, .10);
    }


    textarea.form-control {
        min-height: 90px;

        resize: vertical;
    }


    .total-preview {
        margin-top: 7px;

        color: #2563eb;

        font-size: 12px;
        font-weight: 700;
    }


    /* =========================================================
       TYPE SOAL
    ========================================================= */

    .type-section {
        grid-column: 1 / -1;

        margin-top: 4px;
    }


    .type-title {
        margin-bottom: 13px;

        color: #334155;

        font-size: 13px;
        font-weight: 700;
    }


    .type-grid {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 13px;
    }


    .type-option {
        position: relative;
    }


    .type-option input {
        position: absolute;

        opacity: 0;

        pointer-events: none;
    }


    .type-option label {
        min-height: 105px;

        padding: 16px;

        display: flex;

        flex-direction: column;

        align-items: center;

        justify-content: center;

        text-align: center;

        cursor: pointer;

        border: 1px solid #e2e8f0;

        border-radius: 15px;

        background: #f8fafc;

        transition: .2s;
    }


    .type-option label:hover {
        border-color: #93c5fd;

        background: #eff6ff;

        transform: translateY(-2px);
    }


    .type-option input:checked + label {
        border-color: #2563eb;

        background: #eff6ff;

        box-shadow:
            0 0 0 3px
            rgba(37, 99, 235, .10);
    }


    .type-icon {
        width: 43px;
        height: 43px;

        margin-bottom: 9px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background: #dbeafe;

        color: #2563eb;

        font-size: 21px;
    }


    .type-name {
        color: #1e293b;

        font-size: 14px;

        font-weight: 800;
    }


    .type-desc {
        margin-top: 3px;

        color: #94a3b8;

        font-size: 11px;
    }


    /* =========================================================
       INFO
    ========================================================= */

    .info-box {
        grid-column: 1 / -1;

        padding: 16px 18px;

        border-radius: 13px;

        background: #eff6ff;

        border: 1px solid #dbeafe;

        color: #475569;

        font-size: 13px;

        line-height: 1.7;
    }


    .info-box strong {
        color: #1d4ed8;
    }


    /* =========================================================
       ACTION
    ========================================================= */

    .form-actions {
        display: flex;

        justify-content: flex-end;

        margin-top: 25px;

        padding-top: 22px;

        border-top: 1px solid #e2e8f0;
    }


    .btn-generate {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 9px;

        padding: 13px 22px;

        border: 0;

        border-radius: 11px;

        background:
            linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

        color: #ffffff;

        font-size: 14px;

        font-weight: 800;

        cursor: pointer;

        box-shadow:
            0 8px 20px
            rgba(37, 99, 235, .20);

        transition: .2s;
    }


    .btn-generate:hover {
        transform: translateY(-2px);

        box-shadow:
            0 12px 25px
            rgba(37, 99, 235, .28);
    }


    /* =========================================================
       HASIL GENERATE
    ========================================================= */

    .result-header {
        display: flex;

        justify-content: space-between;

        align-items: center;

        gap: 15px;

        margin-bottom: 18px;
    }


    .result-title {
        margin: 0;

        color: #172554;

        font-size: 23px;

        font-weight: 800;
    }


    .result-subtitle {
        margin: 4px 0 0;

        color: #94a3b8;

        font-size: 13px;
    }


    .paket-list {
        display: grid;

        gap: 15px;
    }


    .paket-card {
        display: flex;

        align-items: center;

        gap: 18px;

        padding: 20px;

        background: #ffffff;

        border: 1px solid #dbeafe;

        border-radius: 17px;

        box-shadow:
            0 8px 25px
            rgba(15, 23, 42, .05);
    }


    .paket-icon {
        width: 55px;
        height: 55px;

        min-width: 55px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 15px;

        background: #dbeafe;

        color: #2563eb;

        font-size: 23px;
    }


    .paket-content {
        flex: 1;
    }


    .paket-name {
        margin: 0;

        color: #172554;

        font-size: 17px;

        font-weight: 800;
    }


    .paket-description {
        margin: 4px 0 10px;

        color: #64748b;

        font-size: 13px;
    }


    .paket-meta {
        display: flex;

        flex-wrap: wrap;

        gap: 7px;
    }


    .meta-item {
        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 5px 9px;

        border-radius: 8px;

        background: #f1f5f9;

        color: #475569;

        font-size: 11px;

        font-weight: 700;
    }


    .meta-item.active {
        background: #f0fdf4;

        color: #15803d;
    }


    .paket-actions {
        display: flex;

        gap: 8px;
    }


    .btn-edit,
    .btn-delete {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 6px;

        padding: 9px 12px;

        border-radius: 9px;

        font-size: 12px;

        font-weight: 700;

        text-decoration: none;

        cursor: pointer;
    }


    .btn-edit {
        border: 1px solid #bfdbfe;

        background: #eff6ff;

        color: #2563eb;
    }


    .btn-delete {
        border: 1px solid #fecaca;

        background: #fef2f2;

        color: #dc2626;
    }


    .btn-edit:hover {
        background: #dbeafe;
    }


    .btn-delete:hover {
        background: #fee2e2;
    }


    .empty-state {
        padding: 50px 25px;

        text-align: center;

        background: #ffffff;

        border: 1px dashed #bfdbfe;

        border-radius: 18px;
    }


    .empty-icon {
        width: 65px;
        height: 65px;

        margin: 0 auto 15px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 18px;

        background: #eff6ff;

        color: #2563eb;

        font-size: 27px;
    }


    .empty-state h3 {
        margin: 0;

        color: #334155;

        font-size: 18px;

        font-weight: 800;
    }


    .empty-state p {
        margin: 7px 0 0;

        color: #94a3b8;

        font-size: 13px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 850px) {

        .kecermatan-page {
            padding: 25px 16px 45px;
        }


        .generator-card {
            padding: 22px;
        }


        .form-grid {
            grid-template-columns: 1fr;
        }


        .form-group.full,
        .type-section,
        .info-box {
            grid-column: auto;
        }


        .type-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }


        .paket-card {
            align-items: flex-start;

            flex-wrap: wrap;
        }


        .paket-actions {
            width: 100%;
        }
    }


    @media (max-width: 500px) {

        .page-title {
            font-size: 27px;
        }


        .type-grid {
            grid-template-columns: 1fr;
        }


        .form-actions {
            justify-content: stretch;
        }


        .btn-generate {
            width: 100%;
        }


        .paket-actions {
            flex-direction: column;
        }


        .btn-edit,
        .btn-delete {
            width: 100%;
        }
    }

</style>


<div class="kecermatan-page">

    <div class="kecermatan-container">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="page-header">

            <div>

                <span class="page-label">
                    KECERMATAN
                </span>

                <h1 class="page-title">
                    Generate Paket Soal
                </h1>

                <p class="page-subtitle">
                    Buat paket ujian kecermatan dengan angka,
                    huruf, simbol, campuran, emoji, atau gambar.
                </p>

            </div>

        </div>


        {{-- =====================================================
             SUCCESS
        ====================================================== --}}

        @if(session('success'))

            <div class="alert-success">

                <i class="bi bi-check-circle-fill"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        {{-- =====================================================
             ERROR
        ====================================================== --}}

        @if($errors->any())

            <div class="alert-error">

                <strong>
                    Data belum benar:
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =====================================================
             GENERATOR
        ====================================================== --}}

        <div class="generator-card">


            <div class="generator-heading">

                <div class="generator-icon">

                    <i class="bi bi-magic"></i>

                </div>

                <div>

                    <h2>
                        Generate Paket Soal Kecermatan
                    </h2>

                    <p>
                        Sistem membuat 10 kolom soal secara otomatis.
                    </p>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('admin.paket-soal.generate') }}"
            >

                @csrf


                <div class="form-grid">


                    {{-- NAMA --}}

                    <div class="form-group">

                        <label class="form-label">
                            Nama Paket
                        </label>

                        <input
                            type="text"
                            name="nama_paket"
                            class="form-control"
                            value="{{ old('nama_paket') }}"
                            placeholder="Contoh: Kecermatan Angka Paket 01"
                            required
                        >

                    </div>


                    {{-- JUMLAH --}}

                    <div class="form-group">

                        <label class="form-label">
                            Jumlah Soal per Kolom
                        </label>

                        <input
                            type="number"
                            name="jumlah_soal"
                            id="jumlah_soal"
                            class="form-control"
                            value="{{ old('jumlah_soal', 20) }}"
                            min="1"
                            max="100"
                            required
                        >

                        <div class="total-preview">

                            Total:
                            <span id="totalSoal">
                                200
                            </span>
                            soal
                            (10 kolom)

                        </div>

                    </div>


                    {{-- TINGKAT --}}

                    <div class="form-group">

                        <label class="form-label">
                            Tingkat Kesulitan
                        </label>

                        <select
                            name="tingkat"
                            class="form-control"
                            required
                        >

                            <option value="">
                                -- Pilih Tingkat --
                            </option>

                            <option
                                value="Mudah"
                                {{ old('tingkat') === 'Mudah' ? 'selected' : '' }}
                            >
                                Mudah
                            </option>

                            <option
                                value="Sedang"
                                {{ old('tingkat', 'Sedang') === 'Sedang' ? 'selected' : '' }}
                            >
                                Sedang
                            </option>

                            <option
                                value="Sulit"
                                {{ old('tingkat') === 'Sulit' ? 'selected' : '' }}
                            >
                                Sulit
                            </option>

                        </select>

                    </div>


                    {{-- KETERANGAN --}}

                    <div class="form-group">

                        <label class="form-label">
                            Keterangan
                        </label>

                        <input
                            type="text"
                            name="keterangan"
                            class="form-control"
                            value="{{ old('keterangan') }}"
                            placeholder="Keterangan paket (opsional)"
                        >

                    </div>


                    {{-- TIPE --}}

                    <div class="type-section">

                        <div class="type-title">
                            Jenis Soal
                        </div>


                        <div class="type-grid">


                            {{-- ANGKA --}}

                            <div class="type-option">

                                <input
                                    type="radio"
                                    name="tipe_soal"
                                    id="angka"
                                    value="Angka"
                                    {{ old('tipe_soal', 'Angka') === 'Angka' ? 'checked' : '' }}
                                    required
                                >

                                <label for="angka">

                                    <div class="type-icon">
                                        <i class="bi bi-123"></i>
                                    </div>

                                    <div class="type-name">
                                        Angka
                                    </div>

                                    <div class="type-desc">
                                        0 1 2 3 4
                                    </div>

                                </label>

                            </div>


                            {{-- HURUF --}}

                            <div class="type-option">

                                <input
                                    type="radio"
                                    name="tipe_soal"
                                    id="huruf"
                                    value="Huruf"
                                    {{ old('tipe_soal') === 'Huruf' ? 'checked' : '' }}
                                >

                                <label for="huruf">

                                    <div class="type-icon">
                                        <i class="bi bi-fonts"></i>
                                    </div>

                                    <div class="type-name">
                                        Huruf
                                    </div>

                                    <div class="type-desc">
                                        A B C D E
                                    </div>

                                </label>

                            </div>


                            {{-- SIMBOL --}}

                            <div class="type-option">

                                <input
                                    type="radio"
                                    name="tipe_soal"
                                    id="simbol"
                                    value="Simbol"
                                    {{ old('tipe_soal') === 'Simbol' ? 'checked' : '' }}
                                >

                                <label for="simbol">

                                    <div class="type-icon">
                                        <i class="bi bi-asterisk"></i>
                                    </div>

                                    <div class="type-name">
                                        Simbol
                                    </div>

                                    <div class="type-desc">
                                        ! @ # $ %
                                    </div>

                                </label>

                            </div>


                            {{-- CAMPURAN --}}

                            <div class="type-option">

                                <input
                                    type="radio"
                                    name="tipe_soal"
                                    id="campuran"
                                    value="Campuran"
                                    {{ old('tipe_soal') === 'Campuran' ? 'checked' : '' }}
                                >

                                <label for="campuran">

                                    <div class="type-icon">
                                        <i class="bi bi-shuffle"></i>
                                    </div>

                                    <div class="type-name">
                                        Campuran
                                    </div>

                                    <div class="type-desc">
                                        Huruf + angka + simbol
                                    </div>

                                </label>

                            </div>


                            {{-- EMOJI --}}

                            <div class="type-option">

                                <input
                                    type="radio"
                                    name="tipe_soal"
                                    id="emoji"
                                    value="Emoji"
                                    {{ old('tipe_soal') === 'Emoji' ? 'checked' : '' }}
                                >

                                <label for="emoji">

                                    <div class="type-icon">
                                        😀
                                    </div>

                                    <div class="type-name">
                                        Emoji
                                    </div>

                                    <div class="type-desc">
                                        Karakter emoji
                                    </div>

                                </label>

                            </div>


                            {{-- GAMBAR --}}

                            <div class="type-option">

                                <input
                                    type="radio"
                                    name="tipe_soal"
                                    id="gambar"
                                    value="Gambar"
                                    {{ old('tipe_soal') === 'Gambar' ? 'checked' : '' }}
                                >

                                <label for="gambar">

                                    <div class="type-icon">
                                        <i class="bi bi-image"></i>
                                    </div>

                                    <div class="type-name">
                                        Gambar
                                    </div>

                                    <div class="type-desc">
                                        Visual / gambar
                                    </div>

                                </label>

                            </div>


                        </div>

                    </div>


                    {{-- INFO --}}

                    <div class="info-box">

                        <strong>
                            Cara kerja:
                        </strong>

                        Sistem membuat

                        <strong>
                            10 kolom
                        </strong>

                        dan setiap kolom mempunyai waktu

                        <strong>
                            60 detik
                        </strong>.

                        Jika jumlah soal per kolom adalah

                        <strong>
                            20
                        </strong>,

                        maka total paket adalah

                        <strong>
                            200 soal
                        </strong>.

                    </div>


                </div>


                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn-generate"
                    >

                        <i class="bi bi-magic"></i>

                        Generate Paket Soal

                    </button>

                </div>


            </form>

        </div>


        {{-- =====================================================
             HASIL PAKET
        ====================================================== --}}

        <div>


            <div class="result-header">

                <div>

                    <h2 class="result-title">
                        Paket Soal yang Sudah Digenerate
                    </h2>

                    <p class="result-subtitle">
                        Semua paket di bawah ini khusus untuk sistem kecermatan.
                    </p>

                </div>

            </div>


            @if($pakets->count())


                <div class="paket-list">


                    @foreach($pakets as $paket)

                        <div class="paket-card">


                            <div class="paket-icon">

                                @if($paket->tipe_soal === 'Angka')

                                    <i class="bi bi-123"></i>

                                @elseif($paket->tipe_soal === 'Huruf')

                                    <i class="bi bi-fonts"></i>

                                @elseif($paket->tipe_soal === 'Simbol')

                                    <i class="bi bi-asterisk"></i>

                                @elseif($paket->tipe_soal === 'Campuran')

                                    <i class="bi bi-shuffle"></i>

                                @elseif($paket->tipe_soal === 'Emoji')

                                    😀

                                @else

                                    <i class="bi bi-image"></i>

                                @endif

                            </div>


                            <div class="paket-content">

                                <h3 class="paket-name">

                                    {{ $paket->nama_paket }}

                                </h3>


                                <p class="paket-description">

                                    {{ $paket->keterangan ?: 'Paket soal kecermatan' }}

                                </p>


                                <div class="paket-meta">


                                    <span class="meta-item">

                                        <i class="bi bi-grid-3x3-gap"></i>

                                        {{ $paket->kolom_ujians_count }} Kolom

                                    </span>


                                    <span class="meta-item">

                                        <i class="bi bi-list-ol"></i>

                                        {{ $paket->jumlah_soal }} soal/kolom

                                    </span>


                                    <span class="meta-item">

                                        <i class="bi bi-clock"></i>

                                        {{ $paket->durasi }} menit

                                    </span>


                                    <span class="meta-item">

                                        <i class="bi bi-bar-chart"></i>

                                        {{ $paket->tingkat }}

                                    </span>


                                    <span class="meta-item">

                                        <i class="bi bi-stars"></i>

                                        {{ $paket->tipe_soal }}

                                    </span>


                                    @if($paket->status)

                                        <span class="meta-item active">

                                            <i class="bi bi-check-circle"></i>

                                            Aktif

                                        </span>

                                    @else

                                        <span class="meta-item">

                                            Tidak Aktif

                                        </span>

                                    @endif


                                </div>

                            </div>


                            <div class="paket-actions">


                                <a
                                    href="{{ route('admin.paket-soal.edit', $paket) }}"
                                    class="btn-edit"
                                >

                                    <i class="bi bi-pencil"></i>

                                    Edit

                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('admin.paket-soal.destroy', $paket) }}"
                                    onsubmit="return confirm('Hapus paket ini beserta seluruh soal di dalamnya?')"
                                >

                                    @csrf

                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="btn-delete"
                                    >

                                        <i class="bi bi-trash"></i>

                                        Hapus

                                    </button>

                                </form>


                            </div>


                        </div>

                    @endforeach


                </div>


            @else


                <div class="empty-state">

                    <div class="empty-icon">

                        <i class="bi bi-folder2-open"></i>

                    </div>


                    <h3>
                        Belum Ada Paket Soal
                    </h3>


                    <p>
                        Silakan isi form di atas untuk membuat
                        paket soal kecermatan pertama.
                    </p>

                </div>


            @endif


        </div>


    </div>

</div>


<script>

    const jumlahSoal =
        document.getElementById('jumlah_soal');

    const totalSoal =
        document.getElementById('totalSoal');


    function updateTotalSoal() {

        const jumlah =
            parseInt(
                jumlahSoal.value
            ) || 0;

        totalSoal.textContent =
            jumlah * 10;
    }


    jumlahSoal.addEventListener(
        'input',
        updateTotalSoal
    );


    updateTotalSoal();

</script>

@endsection