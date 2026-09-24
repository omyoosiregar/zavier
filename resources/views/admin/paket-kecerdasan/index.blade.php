@extends('layouts.admin-zavier')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Paket Soal Kecerdasan
            </h3>

            <p class="text-muted mb-0">
                Kelola paket soal kecerdasan dan kemampuan berpikir.
            </p>
        </div>

        <a href="{{ route('admin.paket-kecerdasan.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg me-1"></i>

            Buat Paket

        </a>

    </div>


    {{-- TABLE --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            @if($pakets->count())

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>

                                <th style="width: 60px;">
                                    No
                                </th>

                                <th>
                                    Nama Paket
                                </th>

                                <th>
                                    Kategori
                                </th>

                                <th>
                                    Jumlah Soal
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

                                <th style="width: 120px;">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($pakets as $item)

                                <tr>

                                    {{-- NO --}}
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- NAMA PAKET --}}
                                    <td>

                                        <strong>
                                            {{ $item->nama_paket }}
                                        </strong>

                                        @if($item->keterangan)

                                            <div class="small text-muted mt-1">
                                                {{ $item->keterangan }}
                                            </div>

                                        @endif

                                    </td>


                                    {{-- KATEGORI --}}
                                    <td>

                                        {{ $item->kategori ?: '-' }}

                                    </td>


                                    {{-- JUMLAH SOAL --}}
                                    <td>

                                        <span class="fw-semibold">
                                            {{ $item->jumlah_soal }}
                                        </span>

                                        soal

                                    </td>


                                    {{-- DURASI --}}
                                    <td>

                                        {{ $item->durasi }}

                                        menit

                                    </td>


                                    {{-- TINGKAT --}}
                                    <td>

                                        {{ ucfirst($item->tingkat ?? '-') }}

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

                                        <div class="d-flex gap-1">

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.paket-kecerdasan.edit', $item->id) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Edit Paket">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- HAPUS --}}
                                            <form
                                                action="{{ route('admin.paket-kecerdasan.destroy', $item->id) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus paket ini?')"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus Paket"
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


            @else

                {{-- DATA KOSONG --}}
                <div class="text-center py-5">

                    <i
                        class="bi bi-lightbulb"
                        style="font-size:50px;"
                    ></i>


                    <h5 class="fw-bold mt-3">

                        Belum Ada Paket Soal

                    </h5>


                    <p class="text-muted mb-4">

                        Belum ada paket soal kecerdasan yang dibuat.

                    </p>


                    <a
                        href="{{ route('admin.paket-kecerdasan.create') }}"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Buat Paket Pertama

                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection