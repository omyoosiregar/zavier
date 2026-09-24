@extends('layouts.admin-zavier')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">

        <a href="{{ route('admin.soal-kecerdasan.index') }}"
           class="text-decoration-none">

            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke Bank Soal

        </a>

        <h3 class="fw-bold mt-3 mb-1">
            Tambah Soal Kecerdasan
        </h3>

        <p class="text-muted mb-0">
            Buat soal baru untuk bank soal kecerdasan.
        </p>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Periksa kembali data berikut:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.soal-kecerdasan.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- INFORMASI SOAL --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="fw-bold mb-0">
                    <i class="bi bi-question-circle me-2 text-primary"></i>
                    Pertanyaan
                </h5>

            </div>


            <div class="card-body">

                {{-- PERTANYAAN --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Pertanyaan
                        <span class="text-danger">*</span>
                    </label>

                    <textarea
                        name="pertanyaan"
                        rows="4"
                        class="form-control @error('pertanyaan') is-invalid @enderror"
                        placeholder="Masukkan pertanyaan..."
                        required
                    >{{ old('pertanyaan') }}</textarea>

                    @error('pertanyaan')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- GAMBAR SOAL --}}
                <div>

                    <label class="form-label fw-semibold">
                        Gambar Soal
                        <span class="text-muted fw-normal">
                            (opsional)
                        </span>
                    </label>

                    <input
                        type="file"
                        name="gambar_soal"
                        class="form-control"
                        accept="image/png,image/jpeg,image/webp"
                        onchange="previewImage(this, 'previewSoal')"
                    >

                    <small class="text-muted">
                        Format JPG, PNG, WEBP. Maksimal 2 MB.
                    </small>


                    <div class="mt-3">

                        <img
                            id="previewSoal"
                            src=""
                            style="
                                display:none;
                                max-width:400px;
                                max-height:250px;
                                object-fit:contain;
                            "
                            class="rounded border p-1"
                        >

                    </div>

                </div>

            </div>

        </div>


        {{-- PILIHAN JAWABAN --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="fw-bold mb-0">
                    <i class="bi bi-list-check me-2 text-primary"></i>
                    Pilihan Jawaban
                </h5>

                <small class="text-muted">
                    Bisa menggunakan teks, gambar, atau kombinasi keduanya.
                </small>

            </div>


            <div class="card-body">


                {{-- A --}}
                <div class="choice-box mb-4">

                    <div class="choice-title">
                        A
                    </div>

                    <div class="row g-3">

                        <div class="col-md-7">

                            <label class="form-label fw-semibold">
                                Jawaban A
                            </label>

                            <textarea
                                name="pilihan_a"
                                rows="2"
                                class="form-control"
                                placeholder="Teks pilihan A..."
                            >{{ old('pilihan_a') }}</textarea>

                        </div>


                        <div class="col-md-5">

                            <label class="form-label fw-semibold">
                                Gambar A
                            </label>

                            <input
                                type="file"
                                name="gambar_a"
                                class="form-control"
                                accept="image/png,image/jpeg,image/webp"
                                onchange="previewImage(this, 'previewA')"
                            >

                            <img
                                id="previewA"
                                src=""
                                style="
                                    display:none;
                                    max-width:180px;
                                    max-height:120px;
                                    object-fit:contain;
                                "
                                class="rounded border mt-2 p-1"
                            >

                        </div>

                    </div>

                </div>


                {{-- B --}}
                <div class="choice-box mb-4">

                    <div class="choice-title">
                        B
                    </div>

                    <div class="row g-3">

                        <div class="col-md-7">

                            <label class="form-label fw-semibold">
                                Jawaban B
                            </label>

                            <textarea
                                name="pilihan_b"
                                rows="2"
                                class="form-control"
                                placeholder="Teks pilihan B..."
                            >{{ old('pilihan_b') }}</textarea>

                        </div>

                        <div class="col-md-5">

                            <label class="form-label fw-semibold">
                                Gambar B
                            </label>

                            <input
                                type="file"
                                name="gambar_b"
                                class="form-control"
                                accept="image/png,image/jpeg,image/webp"
                                onchange="previewImage(this, 'previewB')"
                            >

                            <img
                                id="previewB"
                                src=""
                                style="display:none; max-width:180px; max-height:120px; object-fit:contain;"
                                class="rounded border mt-2 p-1"
                            >

                        </div>

                    </div>

                </div>


                {{-- C --}}
                <div class="choice-box mb-4">

                    <div class="choice-title">
                        C
                    </div>

                    <div class="row g-3">

                        <div class="col-md-7">

                            <label class="form-label fw-semibold">
                                Jawaban C
                            </label>

                            <textarea
                                name="pilihan_c"
                                rows="2"
                                class="form-control"
                                placeholder="Teks pilihan C..."
                            >{{ old('pilihan_c') }}</textarea>

                        </div>

                        <div class="col-md-5">

                            <label class="form-label fw-semibold">
                                Gambar C
                            </label>

                            <input
                                type="file"
                                name="gambar_c"
                                class="form-control"
                                accept="image/png,image/jpeg,image/webp"
                                onchange="previewImage(this, 'previewC')"
                            >

                            <img
                                id="previewC"
                                src=""
                                style="display:none; max-width:180px; max-height:120px; object-fit:contain;"
                                class="rounded border mt-2 p-1"
                            >

                        </div>

                    </div>

                </div>


                {{-- D --}}
                <div class="choice-box mb-4">

                    <div class="choice-title">
                        D
                    </div>

                    <div class="row g-3">

                        <div class="col-md-7">

                            <label class="form-label fw-semibold">
                                Jawaban D
                            </label>

                            <textarea
                                name="pilihan_d"
                                rows="2"
                                class="form-control"
                                placeholder="Teks pilihan D..."
                            >{{ old('pilihan_d') }}</textarea>

                        </div>

                        <div class="col-md-5">

                            <label class="form-label fw-semibold">
                                Gambar D
                            </label>

                            <input
                                type="file"
                                name="gambar_d"
                                class="form-control"
                                accept="image/png,image/jpeg,image/webp"
                                onchange="previewImage(this, 'previewD')"
                            >

                            <img
                                id="previewD"
                                src=""
                                style="display:none; max-width:180px; max-height:120px; object-fit:contain;"
                                class="rounded border mt-2 p-1"
                            >

                        </div>

                    </div>

                </div>


                {{-- E --}}
                <div class="choice-box mb-2">

                    <div class="choice-title">
                        E
                    </div>

                    <div class="row g-3">

                        <div class="col-md-7">

                            <label class="form-label fw-semibold">
                                Jawaban E
                            </label>

                            <textarea
                                name="pilihan_e"
                                rows="2"
                                class="form-control"
                                placeholder="Teks pilihan E..."
                            >{{ old('pilihan_e') }}</textarea>

                        </div>

                        <div class="col-md-5">

                            <label class="form-label fw-semibold">
                                Gambar E
                            </label>

                            <input
                                type="file"
                                name="gambar_e"
                                class="form-control"
                                accept="image/png,image/jpeg,image/webp"
                                onchange="previewImage(this, 'previewE')"
                            >

                            <img
                                id="previewE"
                                src=""
                                style="display:none; max-width:180px; max-height:120px; object-fit:contain;"
                                class="rounded border mt-2 p-1"
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PENGATURAN --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h5 class="fw-bold mb-0">
                    <i class="bi bi-gear me-2 text-primary"></i>
                    Pengaturan Soal
                </h5>

            </div>


            <div class="card-body">

                <div class="row g-4">

                    {{-- JAWABAN --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Jawaban Benar
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="jawaban_benar"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Jawaban --
                            </option>

                            @foreach(['A', 'B', 'C', 'D', 'E'] as $huruf)

                                <option
                                    value="{{ $huruf }}"
                                    @selected(old('jawaban_benar') === $huruf)
                                >
                                    {{ $huruf }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- KATEGORI --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Kategori
                        </label>

                        <select
                            name="kategori"
                            class="form-select"
                        >

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            <option value="Analogi"
                                @selected(old('kategori') === 'Analogi')>
                                Analogi
                            </option>

                            <option value="Sinonim"
                                @selected(old('kategori') === 'Sinonim')>
                                Sinonim
                            </option>

                            <option value="Antonim"
                                @selected(old('kategori') === 'Antonim')>
                                Antonim
                            </option>

                            <option value="Deret Angka"
                                @selected(old('kategori') === 'Deret Angka')>
                                Deret Angka
                            </option>

                            <option value="Deret Huruf"
                                @selected(old('kategori') === 'Deret Huruf')>
                                Deret Huruf
                            </option>

                            <option value="Aritmatika"
                                @selected(old('kategori') === 'Aritmatika')>
                                Aritmatika
                            </option>

                            <option value="Logika"
                                @selected(old('kategori') === 'Logika')>
                                Logika
                            </option>

                            <option value="Silogisme"
                                @selected(old('kategori') === 'Silogisme')>
                                Silogisme
                            </option>

                            <option value="Analogi Gambar"
                                @selected(old('kategori') === 'Analogi Gambar')>
                                Analogi Gambar
                            </option>

                            <option value="Pola Gambar"
                                @selected(old('kategori') === 'Pola Gambar')>
                                Pola Gambar
                            </option>

                            <option value="Matriks Gambar"
                                @selected(old('kategori') === 'Matriks Gambar')>
                                Matriks Gambar
                            </option>

                            <option value="Rotasi"
                                @selected(old('kategori') === 'Rotasi')>
                                Rotasi
                            </option>

                            <option value="Cermin"
                                @selected(old('kategori') === 'Cermin')>
                                Cermin
                            </option>

                            <option value="Klasifikasi Gambar"
                                @selected(old('kategori') === 'Klasifikasi Gambar')>
                                Klasifikasi Gambar
                            </option>

                            <option value="Lainnya"
                                @selected(old('kategori') === 'Lainnya')>
                                Lainnya
                            </option>

                        </select>

                    </div>


                    {{-- TINGKAT --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Tingkat Kesulitan
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="tingkat"
                            class="form-select"
                            required
                        >

                            <option value="mudah"
                                @selected(old('tingkat', 'sedang') === 'mudah')>
                                Mudah
                            </option>

                            <option value="sedang"
                                @selected(old('tingkat', 'sedang') === 'sedang')>
                                Sedang
                            </option>

                            <option value="sulit"
                                @selected(old('tingkat') === 'sulit')>
                                Sulit
                            </option>

                        </select>

                    </div>


                    {{-- PEMBAHASAN --}}
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Pembahasan
                            <span class="text-muted fw-normal">
                                (opsional)
                            </span>
                        </label>

                        <textarea
                            name="pembahasan"
                            rows="4"
                            class="form-control"
                            placeholder="Masukkan pembahasan atau penjelasan jawaban..."
                        >{{ old('pembahasan') }}</textarea>

                    </div>


                    {{-- STATUS --}}
                    <div class="col-12">

                        <div class="form-check form-switch">

                            <input
                                type="hidden"
                                name="status"
                                value="0"
                            >

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="status"
                                value="1"
                                id="status"
                                checked
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="status"
                            >
                                Aktifkan soal
                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="d-flex justify-content-end gap-2 mb-5">

            <a
                href="{{ route('admin.soal-kecerdasan.index') }}"
                class="btn btn-light border"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-primary px-4"
            >

                <i class="bi bi-save me-1"></i>

                Simpan Soal

            </button>

        </div>

    </form>

</div>


<style>

.choice-box {
    position: relative;
    padding: 20px;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    background: #fafbfc;
}

.choice-title {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #0d6efd;
    color: white;
    font-weight: 700;
    margin-bottom: 15px;
}

</style>


<script>

function previewImage(input, previewId)
{
    const preview = document.getElementById(previewId);

    if (!preview) {
        return;
    }

    if (input.files && input.files[0]) {

        const reader = new FileReader();

        reader.onload = function(e) {

            preview.src = e.target.result;
            preview.style.display = 'block';

        };

        reader.readAsDataURL(input.files[0]);

    } else {

        preview.src = '';
        preview.style.display = 'none';

    }
}

</script>

@endsection