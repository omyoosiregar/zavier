cat > resources/views/admin/soal-kecerdasan/edit.blade.php <<'EOF'
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
            Edit Soal Kecerdasan
        </h3>

        <p class="text-muted mb-0">
            Perbarui soal kecerdasan yang sudah tersimpan.
        </p>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Periksa kembali data berikut:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.soal-kecerdasan.update', $soalKecerdasan) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


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
                    >{{ old('pertanyaan', $soalKecerdasan->pertanyaan) }}</textarea>

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

                    @if($soalKecerdasan->gambar_soal)

                        <div class="mb-3">

                            <div class="small text-muted mb-2">
                                Gambar saat ini:
                            </div>

                            <img
                                src="{{ asset('storage/' . $soalKecerdasan->gambar_soal) }}"
                                class="rounded border p-1"
                                style="max-width:400px; max-height:250px; object-fit:contain;"
                            >

                        </div>

                    @endif


                    <input
                        type="file"
                        name="gambar_soal"
                        class="form-control"
                        accept="image/png,image/jpeg,image/webp"
                        onchange="previewImage(this, 'previewSoal')"
                    >

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti gambar.
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

                @foreach(['a','b','c','d','e'] as $huruf)

                    @php
                        $fieldPilihan = 'pilihan_' . $huruf;
                        $fieldGambar = 'gambar_' . $huruf;
                        $previewId = 'preview' . strtoupper($huruf);
                    @endphp


                    <div class="choice-box mb-4">

                        <div class="choice-title">
                            {{ strtoupper($huruf) }}
                        </div>


                        <div class="row g-3">

                            {{-- TEKS --}}
                            <div class="col-md-7">

                                <label class="form-label fw-semibold">
                                    Jawaban {{ strtoupper($huruf) }}
                                </label>

                                <textarea
                                    name="{{ $fieldPilihan }}"
                                    rows="2"
                                    class="form-control"
                                    placeholder="Teks pilihan {{ strtoupper($huruf) }}..."
                                >{{ old($fieldPilihan, $soalKecerdasan->{$fieldPilihan}) }}</textarea>

                            </div>


                            {{-- GAMBAR --}}
                            <div class="col-md-5">

                                <label class="form-label fw-semibold">
                                    Gambar {{ strtoupper($huruf) }}
                                </label>


                                @if($soalKecerdasan->{$fieldGambar})

                                    <div class="mb-2">

                                        <div class="small text-muted mb-1">
                                            Gambar saat ini:
                                        </div>

                                        <img
                                            src="{{ asset('storage/' . $soalKecerdasan->{$fieldGambar}) }}"
                                            class="rounded border p-1"
                                            style="
                                                max-width:180px;
                                                max-height:120px;
                                                object-fit:contain;
                                            "
                                        >

                                    </div>

                                @endif


                                <input
                                    type="file"
                                    name="{{ $fieldGambar }}"
                                    class="form-control"
                                    accept="image/png,image/jpeg,image/webp"
                                    onchange="previewImage(this, '{{ $previewId }}')"
                                >


                                <small class="text-muted">
                                    Kosongkan jika tidak ingin mengganti gambar.
                                </small>


                                <img
                                    id="{{ $previewId }}"
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

                @endforeach

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

                    {{-- JAWABAN BENAR --}}
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

                            @foreach(['A','B','C','D','E'] as $huruf)

                                <option
                                    value="{{ $huruf }}"
                                    @selected(old('jawaban_benar', $soalKecerdasan->jawaban_benar) === $huruf)
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

                            @foreach([
                                'Analogi',
                                'Sinonim',
                                'Antonim',
                                'Deret Angka',
                                'Deret Huruf',
                                'Aritmatika',
                                'Logika',
                                'Silogisme',
                                'Analogi Gambar',
                                'Pola Gambar',
                                'Matriks Gambar',
                                'Rotasi',
                                'Cermin',
                                'Klasifikasi Gambar',
                                'Lainnya'
                            ] as $kategori)

                                <option
                                    value="{{ $kategori }}"
                                    @selected(old('kategori', $soalKecerdasan->kategori) === $kategori)
                                >
                                    {{ $kategori }}
                                </option>

                            @endforeach

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

                            <option
                                value="mudah"
                                @selected(old('tingkat', $soalKecerdasan->tingkat) === 'mudah')
                            >
                                Mudah
                            </option>

                            <option
                                value="sedang"
                                @selected(old('tingkat', $soalKecerdasan->tingkat) === 'sedang')
                            >
                                Sedang
                            </option>

                            <option
                                value="sulit"
                                @selected(old('tingkat', $soalKecerdasan->tingkat) === 'sulit')
                            >
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
                        >{{ old('pembahasan', $soalKecerdasan->pembahasan) }}</textarea>

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
                                @checked(old('status', $soalKecerdasan->status))
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

                Simpan Perubahan

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
EOF