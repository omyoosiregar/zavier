@extends('layouts.admin-zavier')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">
                Bank Soal Kecerdasan
            </h3>

            <p class="text-muted mb-0">
                Kelola soal kecerdasan untuk digunakan dalam ujian murid.
            </p>
        </div>

        <a href="{{ route('admin.soal-kecerdasan.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Soal
        </a>
    </div>


    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- CARD --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="mb-0 fw-bold">
                        Daftar Soal
                    </h5>

                    <small class="text-muted">
                        Total {{ $soal->total() }} soal
                    </small>
                </div>

            </div>

        </div>


        <div class="card-body p-0">

            @if($soal->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th width="60" class="text-center">
                                    No
                                </th>

                                <th>
                                    Soal
                                </th>

                                <th width="150">
                                    Kategori
                                </th>

                                <th width="120">
                                    Tingkat
                                </th>

                                <th width="100">
                                    Jawaban
                                </th>

                                <th width="100">
                                    Status
                                </th>

                                <th width="160" class="text-center">
                                    Aksi
                                </th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($soal as $item)

                                <tr>

                                    {{-- NOMOR --}}
                                    <td class="text-center">
                                        {{ $soal->firstItem() + $loop->index }}
                                    </td>


                                    {{-- SOAL --}}
                                    <td>

                                        <div class="d-flex gap-3">

                                            {{-- GAMBAR SOAL --}}
                                            @if($item->gambar_soal)

                                                <div>
                                                    <img
                                                        src="{{ asset('storage/' . $item->gambar_soal) }}"
                                                        alt="Gambar soal"
                                                        class="rounded border"
                                                        style="
                                                            width:80px;
                                                            height:60px;
                                                            object-fit:cover;
                                                        "
                                                    >
                                                </div>

                                            @endif


                                            {{-- TEKS --}}
                                            <div>

                                                <div class="fw-semibold"
                                                     style="max-width:500px;">

                                                    {{ Str::limit($item->pertanyaan, 120) }}

                                                </div>

                                                @if(
                                                    $item->gambar_a ||
                                                    $item->gambar_b ||
                                                    $item->gambar_c ||
                                                    $item->gambar_d ||
                                                    $item->gambar_e
                                                )

                                                    <small class="text-muted">

                                                        <i class="bi bi-image me-1"></i>

                                                        Memiliki gambar pilihan

                                                    </small>

                                                @endif

                                            </div>

                                        </div>

                                    </td>


                                    {{-- KATEGORI --}}
                                    <td>

                                        @if($item->kategori)

                                            <span class="badge bg-info-subtle text-info">
                                                {{ $item->kategori }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- TINGKAT --}}
                                    <td>

                                        @if($item->tingkat === 'mudah')

                                            <span class="badge bg-success">
                                                Mudah
                                            </span>

                                        @elseif($item->tingkat === 'sulit')

                                            <span class="badge bg-danger">
                                                Sulit
                                            </span>

                                        @else

                                            <span class="badge bg-warning text-dark">
                                                Sedang
                                            </span>

                                        @endif

                                    </td>


                                    {{-- JAWABAN --}}
                                    <td>

                                        <span class="badge bg-primary rounded-pill"
                                              style="font-size:14px;">

                                            {{ strtoupper($item->jawaban_benar) }}

                                        </span>

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if($item->status)

                                            <span class="badge bg-success">
                                                Aktif
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Nonaktif
                                            </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}
                                    <td>

                                        <div class="d-flex justify-content-center gap-1">

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.soal-kecerdasan.edit', $item) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Edit">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- HAPUS --}}
                                            <form
                                                action="{{ route('admin.soal-kecerdasan.destroy', $item) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus soal ini?')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus"
                                                >

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- PAGINATION --}}
                <div class="p-3">

                    {{ $soal->links() }}

                </div>

            @else

                {{-- EMPTY --}}
                <div class="text-center py-5">

                    <div class="mb-3">

                        <i class="bi bi-lightbulb"
                           style="font-size:60px; color:#adb5bd;">
                        </i>

                    </div>

                    <h5 class="fw-bold">
                        Belum Ada Soal
                    </h5>

                    <p class="text-muted">
                        Bank soal kecerdasan masih kosong.
                    </p>

                    <a href="{{ route('admin.soal-kecerdasan.create') }}"
                       class="btn btn-primary">

                        <i class="bi bi-plus-lg me-1"></i>

                        Tambah Soal Pertama

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection