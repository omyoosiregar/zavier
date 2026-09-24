@extends('layouts.admin-zavier')

@section('title', 'Riwayat & Rekap Ujian Murid - Super Admin ZAVIER')

@section('content')
<style>
    .header-banner {
        background: linear-gradient(135deg, #0d6efd 0%, #1555b7 55%, #0dcaf0 100%);
        border-radius: 20px;
        padding: 28px 32px;
        color: #ffffff;
        margin-bottom: 24px;
    }

    .card-custom {
        background: #ffffff;
        border: 1px solid #e2eaf5;
        border-radius: 18px;
        box-shadow: 0 4px 16px rgba(19, 42, 74, 0.04);
        padding: 24px;
    }

    .user-avatar-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #eff6ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 16px;
        border: 1.5px solid #bfdbfe;
    }
</style>

<div class="container-fluid py-2">

    <!-- Banner Header -->
    <div class="header-banner d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none small fw-bold opacity-75 mb-2 d-inline-block">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
            <h3 class="fw-bold mb-1">Riwayat & Rekap Ujian Murid</h3>
            <p class="mb-0 text-white-50 small">Pilih murid untuk melihat rekap komprehensif ujian Kecerdasan, Kecermatan, dan Kepribadian.</p>
        </div>
        <div>
            <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold fs-6">
                <i class="bi bi-people-fill me-1"></i> {{ $murids->total() }} Total Murid
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Card Tabel Rekap -->
    <div class="card-custom">

        <!-- Form Pencarian Murid -->
        <form method="GET" action="{{ route('admin.riwayat-kecerdasan.index') }}" id="formSearchMurid" class="row g-2 mb-4">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" 
                           name="q" 
                           id="searchInput"
                           class="form-control bg-light border-start-0" 
                           placeholder="Cari nama atau email murid..." 
                           value="{{ request('q') }}"
                           autocomplete="off">
                </div>
            </div>
            <div class="col-md-2 col-6">
                <button type="submit" class="btn btn-primary rounded-3 w-100 fw-bold">
                    <i class="bi bi-search me-1"></i> Cari Murid
                </button>
            </div>
            @if(request()->filled('q'))
                <div class="col-md-2 col-6">
                    <a href="{{ route('admin.riwayat-kecerdasan.index') }}" class="btn btn-outline-secondary rounded-3 w-100 fw-semibold">
                        <i class="bi bi-x-circle me-1"></i> Reset
                    </a>
                </div>
            @endif
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-muted">
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Data Murid</th>
                        <th class="text-center">Riwayat Kecerdasan</th>
                        <th class="text-center">Riwayat Kecermatan</th>
                        <th class="text-center">Riwayat Kepribadian</th>
                        <th class="text-center" style="width: 170px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($murids as $idx => $m)
                        @php
                            $countKecerdasan = \App\Models\HasilKecerdasan::where('user_id', $m->id)->count();
                            $countKecermatan = class_exists(\App\Models\Hasil::class) ? \App\Models\Hasil::where('user_id', $m->id)->count() : 0;
                            $countKepribadian = class_exists(\App\Models\HasilKepribadian::class) ? \App\Models\HasilKepribadian::where('user_id', $m->id)->count() : 0;
                        @endphp
                        <tr>
                            <td class="text-center fw-bold text-muted">{{ $murids->firstItem() + $idx }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar-circle">
                                        {{ strtoupper(substr($m->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark fs-6">{{ $m->name }}</div>
                                        <small class="text-muted">{{ $m->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $countKecerdasan > 0 ? 'bg-primary-subtle text-primary border border-primary-subtle' : 'bg-light text-muted border' }} px-3 py-2 rounded-pill">
                                    {{ $countKecerdasan }} Ujian
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $countKecermatan > 0 ? 'bg-info-subtle text-info border border-info-subtle' : 'bg-light text-muted border' }} px-3 py-2 rounded-pill">
                                    {{ $countKecermatan }} Ujian
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $countKepribadian > 0 ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-light text-muted border' }} px-3 py-2 rounded-pill">
                                    {{ $countKepribadian }} Ujian
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.riwayat-kecerdasan.show', $m->id) }}" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold">
                                    <i class="bi bi-folder2-open me-1"></i> Lihat Rekap
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-person-x fs-2 d-block mb-2"></i>
                                Tidak ada data murid ditemukan @if(request('q')) dengan kata kunci "<strong>{{ request('q') }}</strong>" @endif.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $murids->links() }}
        </div>

    </div>

</div>
@endsection