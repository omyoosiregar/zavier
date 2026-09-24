@extends('layouts.admin-zavier')

@section('title', 'Rekap Riwayat Ujian: ' . $murid->name . ' - Super Admin')

@section('content')
<style>
    .card-custom {
        background: #ffffff;
        border: 1px solid #e2eaf5;
        border-radius: 18px;
        box-shadow: 0 4px 16px rgba(19, 42, 74, 0.04);
        padding: 28px;
    }

    .nav-pills .nav-link {
        border-radius: 12px;
        padding: 10px 22px;
        font-weight: 700;
        color: #64748b;
        background: #f8fafc;
        border: 1px solid #e2eaf5;
    }

    .nav-pills .nav-link.active {
        background-color: #0d6efd !important;
        color: #ffffff !important;
        border-color: #0d6efd !important;
    }

    .badge-predikat {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }
</style>

<div class="container-fluid py-2">

    <!-- Navigasi Kembali -->
    <div class="mb-3">
        <a href="{{ route('admin.riwayat-kecerdasan.index') }}" class="btn btn-outline-secondary rounded-pill px-3 fw-semibold">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Murid
        </a>
    </div>

    <!-- Banner Info Profil Murid -->
    <div class="card-custom mb-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <span class="badge bg-primary-subtle text-primary border rounded-pill px-3 py-1 mb-2 fw-bold">Profil Rapor Hasil Ujian</span>
                <h3 class="fw-bold text-dark mb-1">{{ $murid->name }}</h3>
                <p class="text-muted small mb-0">
                    <i class="bi bi-envelope me-1"></i> {{ $murid->email }} &middot; ID Murid: #{{ $murid->id }}
                </p>
            </div>
            <div class="d-flex gap-2">
                <div class="text-center px-4 py-3 bg-light rounded-4 border">
                    <small class="text-muted d-block fw-bold" style="font-size: 11px;">TOTAL KECERDASAN</small>
                    <span class="fs-4 fw-bold text-primary">{{ $riwayatKecerdasan->count() }} Sesi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Kategori Ujian: Kecerdasan, Kecermatan, Kepribadian -->
    <div class="card-custom">
        <ul class="nav nav-pills mb-4 gap-2 border-bottom pb-3" id="rekapTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="tab-kecerdasan" data-bs-toggle="pill" data-bs-target="#content-kecerdasan" type="button">
                    <i class="bi bi-lightbulb-fill me-1"></i> Tes Kecerdasan ({{ $riwayatKecerdasan->count() }})
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-kecermatan" data-bs-toggle="pill" data-bs-target="#content-kecermatan" type="button">
                    <i class="bi bi-grid-3x3-gap-fill me-1"></i> Tes Kecermatan ({{ $riwayatKecermatan->count() }})
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-kepribadian" data-bs-toggle="pill" data-bs-target="#content-kepribadian" type="button">
                    <i class="bi bi-person-heart me-1"></i> Tes Kepribadian ({{ $riwayatKepribadian->count() }})
                </button>
            </li>
        </ul>

        <div class="tab-content" id="rekapTabsContent">

            <!-- 1. TAB KECERDASAN -->
            <div class="tab-pane fade show active" id="content-kecerdasan" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-muted">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Paket Kecerdasan</th>
                                <th class="text-center">Benar / Salah</th>
                                <th class="text-center">Skor (100)</th>
                                <th class="text-center">Predikat</th>
                                <th>Waktu Ujian</th>
                                <th class="text-center" style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayatKecerdasan as $idx => $rk)
                                @php
                                    $skor = $rk->nilai;
                                    $predikat = $skor >= 80 ? 'Sangat Baik' : ($skor >= 65 ? 'Baik' : ($skor >= 50 ? 'Cukup' : 'Perlu Latihan'));
                                    $predikatColor = $skor >= 65 ? 'bg-success-subtle text-success border border-success-subtle' : ($skor >= 50 ? 'bg-warning-subtle text-warning border border-warning-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle');
                                @endphp
                                <tr>
                                    <td class="fw-bold text-muted">{{ $idx + 1 }}</td>
                                    <td class="fw-bold text-primary">{{ $rk->paket->nama_paket ?? 'Paket Dihapus' }}</td>
                                    <td class="text-center">
                                        <span class="text-success fw-bold">{{ $rk->jumlah_benar }}</span> /
                                        <span class="text-danger fw-bold">{{ $rk->jumlah_salah }}</span>
                                    </td>
                                    <td class="text-center fw-bold fs-5">{{ round($rk->nilai) }}</td>
                                    <td class="text-center">
                                        <span class="badge-predikat {{ $predikatColor }}">{{ $predikat }}</span>
                                    </td>
                                    <td class="small text-muted">{{ $rk->updated_at->format('d M Y, H:i') }} WIB</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.riwayat-kecerdasan.destroy', $rk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus hasil ujian sesi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2" title="Hapus Riwayat Sesi Ini">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">Belum ada riwayat tes kecerdasan untuk murid ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 2. TAB KECERMATAN -->
            <div class="tab-pane fade" id="content-kecermatan" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-muted">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Paket Kecermatan</th>
                                <th class="text-center">Nilai / Skor</th>
                                <th>Tanggal Pengerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayatKecermatan as $idx => $rc)
                                <tr>
                                    <td class="fw-bold text-muted">{{ $idx + 1 }}</td>
                                    <td class="fw-bold text-dark">{{ $rc->paketSoal->nama_paket ?? ($rc->nama_paket ?? 'Paket Kecermatan') }}</td>
                                    <td class="text-center fw-bold text-primary fs-5">{{ $rc->nilai ?? ($rc->skor ?? '-') }}</td>
                                    <td class="small text-muted">{{ $rc->created_at ? $rc->created_at->format('d M Y, H:i') : '-' }} WIB</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada riwayat tes kecermatan untuk murid ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 3. TAB KEPRIBADIAN -->
            <div class="tab-pane fade" id="content-kepribadian" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-muted">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Paket Kepribadian</th>
                                <th class="text-center">Skor / Hasil</th>
                                <th>Tanggal Pengerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayatKepribadian as $idx => $rp)
                                <tr>
                                    <td class="fw-bold text-muted">{{ $idx + 1 }}</td>
                                    <td class="fw-bold text-dark">{{ $rp->paket->nama_paket ?? 'Paket Kepribadian' }}</td>
                                    <td class="text-center fw-bold text-success fs-5">{{ $rp->nilai ?? ($rp->skor ?? 'Selesai') }}</td>
                                    <td class="small text-muted">{{ $rp->created_at ? $rp->created_at->format('d M Y, H:i') : '-' }} WIB</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada riwayat tes kepribadian untuk murid ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection