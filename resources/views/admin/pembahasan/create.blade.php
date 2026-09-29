@extends('layouts.admin-zavier')

@section('title', 'Upload Materi Pembahasan - ZAVIER Admin')

@section('content')
<div class="container-fluid px-4 py-4" style="max-width: 900px;">
    <div class="mb-4">
        <a href="{{ route('admin.pembahasan.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill mb-2">
            &larr; Kembali ke Daftar
        </a>
        <h4 class="fw-bold text-dark mb-1">Upload File Materi / Pembahasan Baru</h4>
        <p class="text-muted small mb-0">Materi yang diunggah akan langsung muncul di panel bacaan murid.</p>
    </div>

    <div class="card border-0 rounded-4 shadow-sm p-4">
        <form action="{{ route('admin.pembahasan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold small text-secondary">JUDUL PEMBAHASAN / MATERI <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control rounded-3 py-2" placeholder="Contoh: Pembahasan 1: Ringkasan Figural & Logika Matematika" value="{{ old('judul') }}" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-secondary">KATEGORI <span class="text-danger">*</span></label>
                    <!-- Input Kategori Ketik Manual -->
                    <input type="text" name="kategori" class="form-control rounded-3 py-2" placeholder="Contoh: Kecerdasan, Figural, Sinonim, Antonim, dll" value="{{ old('kategori') }}" required>
                    <small class="text-muted" style="font-size: 11px;">Ketik nama kategori materi secara bebas.</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-secondary">PILIH BERKAS FILE <span class="text-danger">*</span></label>
                    <input type="file" name="file_materi" class="form-control rounded-3 py-2" accept=".pdf,.doc,.docx,.txt,.png,.jpg,.jpeg,.webp" required>
                    <small class="text-muted" style="font-size: 11px;">Mendukung PDF, Word (DOC/DOCX), TXT, atau Gambar (Maks 50MB)</small>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold small text-secondary">DESKRIPSI / CATATAN MATERI</label>
                <textarea name="deskripsi" rows="4" class="form-control rounded-3" placeholder="Tuliskan petunjuk atau catatan penting bagi murid...">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                <a href="{{ route('admin.pembahasan.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
                <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                    <i class="bi bi-cloud-arrow-up-fill me-1"></i> Terbitkan Materi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection