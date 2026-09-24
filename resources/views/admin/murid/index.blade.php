@extends('layouts.admin-zavier')

@section('title', 'Data Murid - Super Admin ZAVIER')

@section('content')
<style>
    .card-murid {
        background: #ffffff;
        border: 1px solid #e7edf6;
        border-radius: 20px;
        box-shadow: 0 4px 16px rgba(19, 42, 74, 0.04);
        padding: 24px 28px;
    }

    .badge-role {
        background-color: #dbeafe;
        color: #1d4ed8;
        font-weight: 700;
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 20px;
        letter-spacing: 0.5px;
    }

    .btn-action-edit {
        background-color: #fff7ed;
        color: #ea580c;
        border: 1px solid #ffedd5;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        padding: 6px 14px;
        text-decoration: none;
        transition: .2s ease;
    }

    .btn-action-edit:hover {
        background-color: #ea580c;
        color: #ffffff;
    }

    .btn-action-delete {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
        padding: 6px 14px;
        transition: .2s ease;
    }

    .btn-action-delete:hover {
        background-color: #dc2626;
        color: #ffffff;
    }
</style>

<div class="container-fluid py-2">

    <!-- Header Section -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                👨‍🎓 Data Murid
            </h3>
            <p class="text-muted small mb-0">
                Kelola data peserta latihan soal kecermatan POLRI & ujian ZAVIER
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-3 fw-semibold">
                &larr; Dashboard
            </a>
            <!-- TOMBOL TAMBAH MURID (SELALU MUNCUL & MEMICU MODAL) -->
            <button type="button" class="btn btn-primary rounded-pill px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahMurid">
                <i class="bi bi-plus-lg me-1"></i> Tambah Murid
            </button>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">
            <div class="fw-bold small mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Terjadi kesalahan saat input data:</div>
            <ul class="mb-0 small ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Tabel Murid -->
    <div class="card-murid">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="text-muted small">
                    <tr class="border-bottom">
                        <th style="width: 50px;">No</th>
                        <th>Nama Murid</th>
                        <th>Email</th>
                        <th class="text-center">Role</th>
                        <th>Terdaftar</th>
                        <th class="text-center" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($murids ?? $users as $idx => $m)
                        <tr>
                            <td class="text-muted fw-bold">
                                {{ method_exists($murids ?? $users, 'firstItem') ? ($murids ?? $users)->firstItem() + $idx : $idx + 1 }}
                            </td>
                            <td>
                                <strong class="text-dark">{{ $m->name }}</strong>
                            </td>
                            <td class="text-muted">
                                {{ $m->email }}
                            </td>
                            <td class="text-center">
                                <span class="badge-role">
                                    {{ strtoupper($m->role ?? 'MURID') }}
                                </span>
                            </td>
                            <td class="text-muted small">
                                {{ $m->created_at ? $m->created_at->format('d M Y') : '-' }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.murid.edit', $m->id) }}" class="btn-action-edit">
                                        <i class="bi bi-pencil-fill me-1"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.murid.destroy', $m->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data murid ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete">
                                            <i class="bi bi-trash-fill me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-person-x fs-2 d-block mb-2"></i>
                                Belum ada data murid yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($murids) && method_exists($murids, 'links'))
            <div class="mt-4">
                {{ $murids->links() }}
            </div>
        @elseif(isset($users) && method_exists($users, 'links'))
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>

<!-- MODAL TAMBAH MURID -->
<div class="modal fade" id="modalTambahMurid" tabindex="-1" aria-labelledby="modalTambahMuridLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="modalTambahMuridLabel">
                    <i class="bi bi-person-plus-fill text-primary me-2"></i>Tambah Murid Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('admin.murid.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold small text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-3 py-2" id="name" name="name" required placeholder="Contoh: Muhammad Ikram">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold small text-dark">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control rounded-3 py-2" id="email" name="email" required placeholder="contoh@gmail.com">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold small text-dark">Password Akun <span class="text-danger">*</span></label>
                        <input type="password" class="form-control rounded-3 py-2" id="password" name="password" required placeholder="Minimal 6 atau 8 karakter">
                    </div>

                    <input type="hidden" name="role" value="murid">
                </div>

                <div class="modal-footer border-top-0 pt-0 px-4 pb-4">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Simpan Murid</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection