@extends('layouts.admin-zavier')

@section('title', 'Master Paket Tryout Psikologi POLRI - Super Admin')

@section('content')
<style>
    .card-tryout-table {
        background: #ffffff;
        border: 1px solid #e7edf6;
        border-radius: 20px;
        box-shadow: 0 4px 18px rgba(19, 42, 74, 0.04);
        padding: 24px 28px;
    }

    .badge-subtes {
        font-size: 11px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 10px;
        display: inline-block;
        white-space: nowrap;
    }
</style>

<div class="container-fluid py-2">

    <!-- Header Section -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                🎯 Paket Tryout Psikologi POLRI
            </h3>
            <p class="text-muted small mb-0">
                Simulasi terpadu 3 subtes berurutan: Kecerdasan &rarr; Jeda &rarr; Kepribadian &rarr; Jeda &rarr; Kecermatan
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-3 fw-semibold">
                &larr; Dashboard
            </a>
            <a href="{{ route('admin.tryout.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold">
                <i class="bi bi-plus-lg me-1"></i> Buat Paket Tryout
            </a>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Card Tabel Tryout -->
    <div class="card-tryout-table">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="text-muted small">
                    <tr class="border-bottom">
                        <th style="width: 50px;">No</th>
                        <th>Nama Tryout</th>
                        <th>1. Subtes Kecerdasan</th>
                        <th>2. Subtes Kepribadian</th>
                        <th>3. Subtes Kecermatan</th>
                        <th class="text-center">Jeda Istirahat</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tryouts as $idx => $t)
                        @php
                            // Ambil nama paket kepribadian secara aman dari accessor
                            $kep = $t->kepribadian;
                            $namaKepribadian = $kep->nama_bank 
                                            ?? $kep->nama_paket 
                                            ?? $kep->judul 
                                            ?? $kep->nama 
                                            ?? '-';

                            // Ambil nama paket kecermatan secara aman
                            $namaKecermatan = optional($t->paketKecermatan)->nama_paket
                                           ?? optional($t->paketKecermatan)->judul
                                           ?? '-';
                        @endphp
                        <tr>
                            <td class="text-muted fw-bold">
                                {{ method_exists($tryouts, 'firstItem') ? $tryouts->firstItem() + $idx : $idx + 1 }}
                            </td>
                            <td>
                                <strong class="text-dark fs-6">{{ $t->judul_tryout }}</strong>
                                <small class="text-muted d-block mt-1">
                                    {{ $t->deskripsi ?: 'Simulasi CAT Terpadu ZAVIER' }}
                                </small>
                            </td>
                            <td>
                                <span class="badge-subtes bg-primary-subtle text-primary border border-primary-subtle">
                                    <i class="bi bi-lightbulb-fill me-1"></i> {{ optional($t->paketKecerdasan)->nama_paket ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-subtes bg-success-subtle text-success border border-success-subtle">
                                    <i class="bi bi-person-heart me-1"></i> {{ $namaKepribadian }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-subtes bg-info-subtle text-info border border-info-subtle">
                                    <i class="bi bi-grid-3x3-gap-fill me-1"></i> {{ $namaKecermatan }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-bold">
                                    <i class="bi bi-clock-history me-1 text-warning"></i> {{ $t->jeda_menit ?? 5 }} Menit
                                </span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.tryout.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket tryout ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold">
                                        <i class="bi bi-trash-fill me-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-award fs-1 d-block mb-2 text-secondary"></i>
                                Belum ada paket Tryout Psikologi. Klik tombol <strong>+ Buat Paket Tryout</strong> di atas untuk membuat paket baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($tryouts, 'links'))
            <div class="mt-4">
                {{ $tryouts->links() }}
            </div>
        @endif
    </div>

</div>
@endsection