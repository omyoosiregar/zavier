@extends('layouts.admin-zavier')

@section('title', 'Materi & Pembahasan Soal - ZAVIER Admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-book-half text-primary me-2"></i>Materi & Pembahasan Soal
            </h4>
            <p class="text-muted small mb-0">Kelola dokumen materi pembelajaran dan pembahasan soal untuk murid.</p>
        </div>
        <div>
            <a href="{{ route('admin.pembahasan.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                <i class="bi bi-cloud-arrow-up-fill me-1"></i> Upload File Pembahasan
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Tabel -->
    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-secondary small text-uppercase" style="font-size: 11.5px; letter-spacing: 0.5px;">
                            <th class="ps-4 py-3">No</th>
                            <th class="py-3">Judul Materi Pembahasan</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3">Format</th>
                            <th class="py-3">Nama Berkas</th>
                            <th class="pe-4 py-3 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materis as $idx => $m)
                            <tr>
                                <td class="ps-4 fw-semibold text-secondary">{{ $materis->firstItem() + $idx }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $m->judul }}</div>
                                    @if($m->deskripsi)
                                        <div class="text-muted small text-truncate" style="max-width: 320px;">{{ $m->deskripsi }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1">
                                        {{ $m->kategori }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-dark-subtle text-dark text-uppercase fw-bold px-2 py-1">
                                        .{{ $m->file_extension }}
                                    </span>
                                </td>
                                <td class="text-secondary small text-truncate" style="max-width: 200px;">
                                    <i class="bi bi-paperclip me-1"></i>{{ $m->file_name }}
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-1 align-items-center">
                                        <!-- Pratinjau File -->
                                        <a href="{{ asset('storage/' . $m->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill px-3" title="Pratinjau Berkas">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.pembahasan.edit', $m->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3" title="Edit Materi">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.pembahasan.destroy', $m->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi \'{{ addslashes($m->judul) }}\'? File ini akan dihapus permanen.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Hapus Materi">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                    Belum ada file materi pembahasan yang diunggah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($materis->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $materis->links() }}
            </div>
        @endif
    </div>
</div>
@endsection