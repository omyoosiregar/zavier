@extends('layouts.admin-zavier')

@section('title', 'Paket Kepribadian')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">
            Paket Soal Kepribadian
        </h2>

        <p class="text-secondary mb-0">
            Buat paket ujian dari Bank Soal Kepribadian.
        </p>
    </div>

    <a
        href="{{ route('admin.paket-kepribadian.create') }}"
        class="btn btn-primary"
    >
        <i class="bi bi-plus-lg me-1"></i>
        Buat Paket
    </a>

</div>


{{-- =========================================================
     PESAN BERHASIL
========================================================= --}}

@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">

        <i class="bi bi-check-circle-fill me-2"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>

@endif


{{-- =========================================================
     PESAN ERROR
========================================================= --}}

@if(session('error'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

        <i class="bi bi-exclamation-triangle-fill me-2"></i>

        {{ session('error') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>

@endif


{{-- =========================================================
     TABEL PAKET
========================================================= --}}

<div class="card border-0 shadow-sm">

    <div class="table-responsive">

        <table class="table align-middle mb-0">

            <thead>

                <tr>

                    <th class="px-3">
                        Paket
                    </th>

                    <th>
                        Soal
                    </th>

                    <th>
                        Durasi
                    </th>

                    <th>
                        Tingkat
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($pakets as $p)

                    <tr>

                        {{-- =================================================
                             NAMA PAKET
                        ================================================== --}}

                        <td class="px-3">

                            <b>
                                {{ $p->nama_paket }}
                            </b>

                            <div class="small text-secondary">

                                {{ $p->keterangan }}

                            </div>

                        </td>


                        {{-- =================================================
                             JUMLAH SOAL
                        ================================================== --}}

                        <td>

                            {{ $p->jumlah_soal }}

                        </td>


                        {{-- =================================================
                             DURASI
                        ================================================== --}}

                        <td>

                            {{ $p->durasi }} menit

                        </td>


                        {{-- =================================================
                             TINGKAT
                        ================================================== --}}

                        <td>

                            <span class="badge text-bg-light">

                                {{ $p->tingkat }}

                            </span>

                        </td>


                        {{-- =================================================
                             STATUS
                        ================================================== --}}

                        <td>

                            <span
                                class="badge
                                {{ $p->status
                                    ? 'text-bg-success'
                                    : 'text-bg-secondary'
                                }}"
                            >

                                {{ $p->status
                                    ? 'Aktif'
                                    : 'Nonaktif'
                                }}

                            </span>

                        </td>


                        {{-- =================================================
                             AKSI
                        ================================================== --}}

                        <td>

                            <div class="d-flex align-items-center gap-2">

                                {{-- KELOLA --}}

                                <a
                                    class="btn btn-sm btn-outline-primary"
                                    href="{{ route(
                                        'admin.paket-kepribadian.edit',
                                        $p
                                    ) }}"
                                >

                                    <i class="bi bi-pencil-square me-1"></i>

                                    Kelola

                                </a>


                                {{-- HAPUS --}}

                                <form
                                    action="{{ route(
                                        'admin.paket-kepribadian.destroy',
                                        $p
                                    ) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm(
                                        'Yakin ingin menghapus paket {{ $p->nama_paket }}? Semua soal yang terkait dengan paket ini juga akan dihapus.'
                                    );"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                    >

                                        <i class="bi bi-trash3 me-1"></i>

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5 text-secondary"
                        >

                            <div class="mb-2">

                                <i
                                    class="bi bi-inbox"
                                    style="font-size: 35px;"
                                ></i>

                            </div>

                            Belum ada paket kepribadian.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection