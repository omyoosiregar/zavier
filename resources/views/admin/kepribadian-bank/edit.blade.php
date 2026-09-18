@extends('layouts.admin-zavier')

@section('title', 'Edit Bank Soal Kepribadian')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Bank Soal Kepribadian
            </h3>

            <p class="text-muted mb-0">
                Kelola informasi bank soal dan import pertanyaan dari Word.
            </p>
        </div>

        <a href="{{ route('admin.kepribadian-bank.index') }}"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Kembali

        </a>

    </div>


    {{-- =========================================================
        FLASH MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show shadow-sm">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show shadow-sm">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================================================
        VALIDATION ERROR
    ========================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger shadow-sm">

            <strong>
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Terjadi kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif



    {{-- =========================================================
        INFORMASI BANK
    ========================================================== --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white border-0 py-3">

            <h5 class="fw-bold mb-0">

                <i class="bi bi-database me-2"></i>

                Informasi Bank Soal

            </h5>

        </div>


        <div class="card-body">

            <form action="{{ route('admin.kepribadian-bank.update', $bank) }}"
                  method="POST">

                @csrf
                @method('PUT')


                <div class="row g-3">

                    {{-- NAMA BANK --}}

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Nama Bank
                        </label>

                        <input type="text"
                               name="nama_bank"
                               class="form-control"
                               value="{{ old('nama_bank', $bank->nama_bank) }}"
                               required>

                    </div>


                    {{-- STATUS --}}

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select name="status"
                                class="form-select">

                            <option value="1"
                                {{ old('status', $bank->status) ? 'selected' : '' }}>

                                Aktif

                            </option>

                            <option value="0"
                                {{ !old('status', $bank->status) ? 'selected' : '' }}>

                                Tidak Aktif

                            </option>

                        </select>

                    </div>


                    {{-- DESKRIPSI --}}

                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  rows="3"
                                  class="form-control"
                                  placeholder="Deskripsi bank soal...">{{ old('deskripsi', $bank->deskripsi) }}</textarea>

                    </div>

                </div>


                <div class="mt-3">

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-save me-1"></i>

                        Simpan Informasi Bank

                    </button>

                </div>

            </form>

        </div>

    </div>



    {{-- =========================================================
        SISTEM PENILAIAN
    ========================================================== --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white border-0 py-3">

            <h5 class="fw-bold mb-1">

                <i class="bi bi-bar-chart-fill me-2"></i>

                Sistem Penilaian Kepribadian

            </h5>

            <small class="text-muted">

                Bobot ditentukan berdasarkan posisi jawaban dan kunci
                yang ditandai warna pada file Word.

            </small>

        </div>


        <div class="card-body">


            <div class="alert alert-info mb-4">

                <div class="fw-bold mb-2">

                    <i class="bi bi-info-circle-fill me-2"></i>

                    Cara kerja sistem

                </div>


                <ul class="mb-0">

                    <li>
                        Jawaban
                        <strong>berwarna selain hitam</strong>
                        pada file Word dianggap sebagai kunci jawaban.
                    </li>

                    <li>
                        Jika kunci adalah
                        <strong>Sangat Setuju</strong>,
                        maka nilai bergerak dari
                        <strong>5 → 1</strong>.
                    </li>

                    <li>
                        Jika kunci adalah
                        <strong>Sangat Tidak Setuju</strong>,
                        maka nilai bergerak dari
                        <strong>1 → 5</strong>.
                    </li>

                    <li>
                        Nilai tengah
                        <strong>Ragu-Ragu</strong>
                        tetap berada di tengah.
                    </li>

                </ul>

            </div>



            <div class="row g-3">

                {{-- A --}}

                <div class="col-md">

                    <div class="border rounded-3 p-3 text-center h-100">

                        <div class="fw-bold fs-4">
                            A
                        </div>

                        <div class="text-muted">
                            Sangat Setuju
                        </div>

                        <span class="badge bg-primary mt-2">
                            Nilai 5
                        </span>

                    </div>

                </div>


                {{-- B --}}

                <div class="col-md">

                    <div class="border rounded-3 p-3 text-center h-100">

                        <div class="fw-bold fs-4">
                            B
                        </div>

                        <div class="text-muted">
                            Setuju
                        </div>

                        <span class="badge bg-primary mt-2">
                            Nilai 4
                        </span>

                    </div>

                </div>


                {{-- C --}}

                <div class="col-md">

                    <div class="border rounded-3 p-3 text-center h-100">

                        <div class="fw-bold fs-4">
                            C
                        </div>

                        <div class="text-muted">
                            Ragu-Ragu
                        </div>

                        <span class="badge bg-secondary mt-2">
                            Nilai 3
                        </span>

                    </div>

                </div>


                {{-- D --}}

                <div class="col-md">

                    <div class="border rounded-3 p-3 text-center h-100">

                        <div class="fw-bold fs-4">
                            D
                        </div>

                        <div class="text-muted">
                            Tidak Setuju
                        </div>

                        <span class="badge bg-warning text-dark mt-2">
                            Nilai 2
                        </span>

                    </div>

                </div>


                {{-- E --}}

                <div class="col-md">

                    <div class="border rounded-3 p-3 text-center h-100">

                        <div class="fw-bold fs-4">
                            E
                        </div>

                        <div class="text-muted">
                            Sangat Tidak Setuju
                        </div>

                        <span class="badge bg-danger mt-2">
                            Nilai 1
                        </span>

                    </div>

                </div>

            </div>


            <div class="alert alert-warning mt-4 mb-0">

                <i class="bi bi-lightbulb-fill me-2"></i>

                <strong>Penting:</strong>

                Bobot di atas merupakan nilai dasar berdasarkan arah
                pernyataan. Sistem akan membalik nilai apabila kunci
                jawaban pada Word menunjukkan arah negatif.

            </div>

        </div>

    </div>



    {{-- =========================================================
        UPLOAD WORD
    ========================================================== --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white border-0 py-3">

            <h5 class="fw-bold mb-1">

                <i class="bi bi-file-earmark-word me-2"></i>

                Import Soal dari Word

            </h5>

            <small class="text-muted">

                Upload file Word untuk menambahkan soal secara otomatis.

            </small>

        </div>


        <div class="card-body">


            <div class="alert alert-primary">

                <div class="fw-bold mb-2">

                    <i class="bi bi-stars me-2"></i>

                    Format File Word

                </div>


                <div class="small">

                    Setiap soal harus memiliki pilihan:

                    <strong>
                        A. Sangat Setuju
                    </strong>

                    sampai

                    <strong>
                        E. Sangat Tidak Setuju
                    </strong>.

                    <br>

                    Pilihan jawaban yang benar harus diberi

                    <strong>
                        warna font selain hitam
                    </strong>.

                    <br>

                    Sistem akan membaca warna tersebut secara otomatis
                    sebagai <strong>kunci jawaban</strong>.

                </div>

            </div>



            <form action="{{ route('admin.kepribadian-bank.upload', $bank) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf


                <div class="row align-items-end g-3">

                    <div class="col-md-9">

                        <label class="form-label fw-semibold">

                            File Word (.docx)

                        </label>


                        <input type="file"
                               name="word"
                               class="form-control"
                               accept=".docx,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                               required>


                        <small class="text-muted">

                            Hanya file
                            <strong>.docx</strong>
                            yang didukung.

                        </small>

                    </div>


                    <div class="col-md-3">

                        <button type="submit"
                                class="btn btn-success w-100">

                            <i class="bi bi-upload me-1"></i>

                            Upload & Import

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>



    {{-- =========================================================
        DAFTAR SOAL
    ========================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="fw-bold mb-1">

                        <i class="bi bi-list-ol me-2"></i>

                        Daftar Pertanyaan

                    </h5>

                    <small class="text-muted">

                        Total

                        <strong>
                            {{ $bank->soal->count() }}
                        </strong>

                        soal

                    </small>

                </div>

            </div>

        </div>


        <div class="card-body p-0">

            @if($bank->soal->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="text-center"
                                    style="width:70px;">
                                    No
                                </th>

                                <th style="min-width:350px;">
                                    Pertanyaan
                                </th>

                                <th style="min-width:380px;">
                                    Pilihan Jawaban
                                </th>

                                <th class="text-center"
                                    style="width:160px;">
                                    Kunci
                                </th>

                                <th class="text-center"
                                    style="width:150px;">
                                    Status
                                </th>

                                <th class="text-center"
                                    style="width:180px;">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($bank->soal as $soal)

                                <tr>

                                    {{-- NOMOR --}}

                                    <td class="text-center fw-bold">

                                        {{ $soal->nomor_soal }}

                                    </td>


                                    {{-- PERTANYAAN --}}

                                    <td>

                                        <div class="fw-semibold">

                                            {{ $soal->pertanyaan }}

                                        </div>

                                    </td>


                                    {{-- PILIHAN --}}

                                    <td>

                                        <div class="small">

                                            {{-- A --}}

                                            <div class="mb-2">

                                                <span class="badge bg-primary me-1">
                                                    A
                                                </span>

                                                {{ $soal->pilihan_a }}

                                            </div>


                                            {{-- B --}}

                                            <div class="mb-2">

                                                <span class="badge bg-primary me-1">
                                                    B
                                                </span>

                                                {{ $soal->pilihan_b }}

                                            </div>


                                            {{-- C --}}

                                            <div class="mb-2">

                                                <span class="badge bg-secondary me-1">
                                                    C
                                                </span>

                                                {{ $soal->pilihan_c }}

                                            </div>


                                            {{-- D --}}

                                            <div class="mb-2">

                                                <span class="badge bg-warning text-dark me-1">
                                                    D
                                                </span>

                                                {{ $soal->pilihan_d }}

                                            </div>


                                            {{-- E --}}

                                            <div>

                                                <span class="badge bg-danger me-1">
                                                    E
                                                </span>

                                                {{ $soal->pilihan_e }}

                                            </div>

                                        </div>

                                    </td>


                                    {{-- KUNCI --}}

                                    <td class="text-center">

                                        @if($soal->kunci_jawaban)

                                            @php

                                                $kunci = strtoupper(
                                                    trim($soal->kunci_jawaban)
                                                );

                                                $namaKunci = [

                                                    'A' => 'Sangat Setuju',

                                                    'B' => 'Setuju',

                                                    'C' => 'Ragu-Ragu',

                                                    'D' => 'Tidak Setuju',

                                                    'E' => 'Sangat Tidak Setuju',

                                                ];

                                            @endphp


                                            <span class="badge bg-success fs-6">

                                                {{ $kunci }}

                                            </span>


                                            <div class="small text-muted mt-1">

                                                {{ $namaKunci[$kunci] ?? 'Tidak diketahui' }}

                                            </div>

                                        @else

                                            <span class="badge bg-secondary">

                                                Belum Ditentukan

                                            </span>


                                            <div class="small text-danger mt-1">

                                                Periksa warna di Word

                                            </div>

                                        @endif

                                    </td>


                                    {{-- STATUS --}}

                                    <td class="text-center">

                                        @if($soal->status)

                                            <span class="badge bg-success">

                                                <i class="bi bi-check-circle me-1"></i>

                                                Aktif

                                            </span>

                                        @else

                                            <span class="badge bg-secondary">

                                                Tidak Aktif

                                            </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}

                                    <td class="text-center">

                                        <button type="button"
                                                class="btn btn-sm btn-warning mb-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editSoal{{ $soal->id }}">

                                            <i class="bi bi-pencil-square me-1"></i>

                                            Edit

                                        </button>


                                        <button type="button"
                                                class="btn btn-sm btn-danger mb-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapusSoal{{ $soal->id }}">

                                            <i class="bi bi-trash me-1"></i>

                                            Hapus

                                        </button>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                    MODAL EDIT & HAPUS
                ================================================== --}}

                @foreach($bank->soal as $soal)

                    {{-- =================================================
                        MODAL EDIT SOAL
                    ================================================== --}}

                    <div class="modal fade"
                         id="editSoal{{ $soal->id }}"
                         tabindex="-1"
                         aria-hidden="true">

                        <div class="modal-dialog modal-xl modal-dialog-scrollable">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title fw-bold">

                                        <i class="bi bi-pencil-square me-2"></i>

                                        Edit Soal
                                        #{{ $soal->nomor_soal }}

                                    </h5>


                                    <button type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal">
                                    </button>

                                </div>


                                {{-- FORM EDIT --}}

                                <form action="{{ route('admin.kepribadian-bank.soal.update', $soal) }}"
                                      method="POST">

                                    @csrf
                                    @method('PUT')


                                    <div class="modal-body">

                                        {{-- PERTANYAAN --}}

                                        <div class="mb-4">

                                            <label class="form-label fw-bold">

                                                Pertanyaan

                                            </label>


                                            <textarea name="pertanyaan"
                                                      class="form-control"
                                                      rows="4"
                                                      required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>

                                        </div>


                                        {{-- PILIHAN A --}}

                                        <div class="mb-3">

                                            <label class="form-label fw-bold">

                                                <span class="badge bg-primary me-1">
                                                    A
                                                </span>

                                                Pilihan A

                                            </label>


                                            <textarea name="pilihan_a"
                                                      class="form-control"
                                                      rows="2"
                                                      required>{{ old('pilihan_a', $soal->pilihan_a) }}</textarea>

                                        </div>


                                        {{-- PILIHAN B --}}

                                        <div class="mb-3">

                                            <label class="form-label fw-bold">

                                                <span class="badge bg-primary me-1">
                                                    B
                                                </span>

                                                Pilihan B

                                            </label>


                                            <textarea name="pilihan_b"
                                                      class="form-control"
                                                      rows="2"
                                                      required>{{ old('pilihan_b', $soal->pilihan_b) }}</textarea>

                                        </div>


                                        {{-- PILIHAN C --}}

                                        <div class="mb-3">

                                            <label class="form-label fw-bold">

                                                <span class="badge bg-secondary me-1">
                                                    C
                                                </span>

                                                Pilihan C

                                            </label>


                                            <textarea name="pilihan_c"
                                                      class="form-control"
                                                      rows="2"
                                                      required>{{ old('pilihan_c', $soal->pilihan_c) }}</textarea>

                                        </div>


                                        {{-- PILIHAN D --}}

                                        <div class="mb-3">

                                            <label class="form-label fw-bold">

                                                <span class="badge bg-warning text-dark me-1">
                                                    D
                                                </span>

                                                Pilihan D

                                            </label>


                                            <textarea name="pilihan_d"
                                                      class="form-control"
                                                      rows="2"
                                                      required>{{ old('pilihan_d', $soal->pilihan_d) }}</textarea>

                                        </div>


                                        {{-- PILIHAN E --}}

                                        <div class="mb-3">

                                            <label class="form-label fw-bold">

                                                <span class="badge bg-danger me-1">
                                                    E
                                                </span>

                                                Pilihan E

                                            </label>


                                            <textarea name="pilihan_e"
                                                      class="form-control"
                                                      rows="2"
                                                      required>{{ old('pilihan_e', $soal->pilihan_e) }}</textarea>

                                        </div>


                                        {{-- KUNCI JAWABAN --}}

                                        <div class="mb-3">

                                            <label class="form-label fw-bold">

                                                <i class="bi bi-key-fill me-1"></i>

                                                Kunci Jawaban

                                            </label>


                                            @if($soal->kunci_jawaban)

                                                @php

                                                    $kunci = strtoupper(
                                                        trim($soal->kunci_jawaban)
                                                    );

                                                    $namaKunci = [

                                                        'A' => 'Sangat Setuju',

                                                        'B' => 'Setuju',

                                                        'C' => 'Ragu-Ragu',

                                                        'D' => 'Tidak Setuju',

                                                        'E' => 'Sangat Tidak Setuju',

                                                    ];

                                                @endphp


                                                <div class="alert alert-success mb-0">

                                                    <strong>

                                                        {{ $kunci }}

                                                        —

                                                        {{ $namaKunci[$kunci] ?? '' }}

                                                    </strong>


                                                    <br>


                                                    <small>

                                                        Kunci ini diperoleh dari
                                                        warna font pada file Word.

                                                    </small>

                                                </div>

                                            @else

                                                <div class="alert alert-warning mb-0">

                                                    Kunci jawaban belum terdeteksi.

                                                    Silakan upload ulang file Word
                                                    dengan jawaban benar diberi
                                                    warna selain hitam.

                                                </div>

                                            @endif

                                        </div>


                                        {{-- STATUS --}}

                                        <div class="mb-3">

                                            <label class="form-label fw-bold">

                                                Status Soal

                                            </label>


                                            <select name="status"
                                                    class="form-select">

                                                <option value="1"
                                                    {{ $soal->status ? 'selected' : '' }}>

                                                    Aktif

                                                </option>

                                                <option value="0"
                                                    {{ !$soal->status ? 'selected' : '' }}>

                                                    Tidak Aktif

                                                </option>

                                            </select>

                                        </div>


                                        {{-- INFO --}}

                                        <div class="alert alert-info">

                                            <div class="fw-bold mb-2">

                                                <i class="bi bi-info-circle me-1"></i>

                                                Informasi

                                            </div>


                                            <ul class="mb-0">

                                                <li>
                                                    Pilihan jawaban tetap A sampai E.
                                                </li>

                                                <li>
                                                    Kunci jawaban berasal dari warna
                                                    font pada file Word.
                                                </li>

                                                <li>
                                                    Sistem penilaian mengikuti arah
                                                    kunci jawaban.
                                                </li>

                                                <li>
                                                    Tidak perlu menentukan jawaban
                                                    benar/salah secara manual.
                                                </li>

                                            </ul>

                                        </div>

                                    </div>


                                    {{-- FOOTER --}}

                                    <div class="modal-footer">

                                        <button type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal">

                                            <i class="bi bi-x-lg me-1"></i>

                                            Batal

                                        </button>


                                        <button type="submit"
                                                class="btn btn-primary">

                                            <i class="bi bi-save me-1"></i>

                                            Simpan Perubahan

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>



                    {{-- =================================================
                        MODAL HAPUS SOAL
                    ================================================== --}}

                    <div class="modal fade"
                         id="hapusSoal{{ $soal->id }}"
                         tabindex="-1"
                         aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title fw-bold text-danger">

                                        <i class="bi bi-trash me-2"></i>

                                        Hapus Soal

                                    </h5>


                                    <button type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal">
                                    </button>

                                </div>


                                <div class="modal-body">

                                    <p class="mb-2">

                                        Apakah Anda yakin ingin menghapus soal?

                                    </p>


                                    <div class="alert alert-warning">

                                        <strong>

                                            Soal #{{ $soal->nomor_soal }}

                                        </strong>

                                        <br>

                                        {{ Str::limit($soal->pertanyaan, 150) }}

                                    </div>


                                    <small class="text-danger">

                                        Data soal yang dihapus tidak dapat
                                        dikembalikan.

                                    </small>

                                </div>


                                <div class="modal-footer">

                                    <button type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal">

                                        Batal

                                    </button>


                                    <form action="{{ route('admin.kepribadian-bank.soal.destroy', $soal) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')


                                        <button type="submit"
                                                class="btn btn-danger">

                                            <i class="bi bi-trash me-1"></i>

                                            Ya, Hapus

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            @else

                <div class="text-center py-5">

                    <i class="bi bi-inbox fs-1 text-muted"></i>


                    <h5 class="mt-3">

                        Belum ada soal

                    </h5>


                    <p class="text-muted mb-0">

                        Silakan upload file Word
                        untuk menambahkan soal.

                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection