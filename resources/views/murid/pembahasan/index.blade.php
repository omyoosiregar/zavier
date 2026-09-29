@extends(view()->exists('layouts.murid') ? 'layouts.murid' : (view()->exists('layouts.app') ? 'layouts.app' : 'layouts.navigation'))

@section('title', 'Materi & Pembahasan Soal - ZAVIER')

@section('content')
<div class="container py-4" style="max-width: 1140px;">

    <!-- Top Banner & Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill fw-bold mb-2">
                <i class="bi bi-shield-lock-fill me-1"></i> RUANG BELAJAR EKSKLUSIF
            </span>
            <h3 class="fw-bold text-dark mb-1">
                <i class="bi bi-book-half text-primary me-2"></i>Materi & Pembahasan Soal
            </h3>
            <p class="text-muted small mb-0">Pelajari dokumen materi resmi dan modul pembahasan langsung dari instruktur ZAVIER.</p>
        </div>
        <div>
            <div class="bg-white border rounded-4 px-3 py-2 shadow-sm d-flex align-items-center gap-2">
                <i class="bi bi-lock-fill text-danger fs-5"></i>
                <div style="font-size: 11.5px; line-height: 1.3;" class="text-secondary">
                    <strong class="text-dark d-block">Dokumen Terproteksi</strong>
                    Anti-Screenshot & Anti-Download
                </div>
            </div>
        </div>
    </div>

    <!-- Grid Kartu Materi Pembahasan -->
    <div class="row g-4">
        @forelse($materis as $m)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 rounded-4 shadow-sm hover-card transition" style="border: 1px solid #e2e8f0 !important; background: #ffffff;">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <!-- Header Kartu: Kategori & Format Berkas -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 fw-bold" style="font-size: 11.5px;">
                                    {{ $m->kategori }}
                                </span>
                                <span class="badge bg-light text-secondary border text-uppercase fw-bold" style="font-size: 11px;">
                                    <i class="bi bi-file-earmark-lock-fill text-danger me-1"></i>.{{ $m->file_extension }}
                                </span>
                            </div>

                            <!-- Judul Materi -->
                            <h5 class="fw-bold text-dark mb-2" style="font-size: 17px; line-height: 1.45;">
                                {{ $m->judul }}
                            </h5>

                            <!-- Deskripsi / Catatan Mentor -->
                            <p class="text-muted small mb-3" style="line-height: 1.6;">
                                {{ $m->deskripsi ?? 'Dokumen materi pembahasan lengkap siap dipelajari langsung di aplikasi.' }}
                            </p>
                        </div>

                        <!-- Tombol Buka Materi -->
                        <div class="pt-3 border-top mt-auto">
                            <a href="{{ route('murid.pembahasan.show', $m->id) }}" class="btn btn-primary rounded-pill w-100 fw-bold py-2 shadow-sm">
                                <i class="bi bi-eye-fill me-1"></i> Buka Pembahasan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="card border-0 rounded-4 shadow-sm p-5 bg-white">
                    <i class="bi bi-folder-x text-muted opacity-50" style="font-size: 64px;"></i>
                    <h5 class="fw-bold mt-3 text-dark">Belum Ada Materi Pembahasan</h5>
                    <p class="text-muted small mb-0">Instruktur belum merilis materi atau dokumen pembahasan baru untuk akun Anda.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination Aman -->
    @if(method_exists($materis, 'hasPages') && $materis->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $materis->links() }}
        </div>
    @endif
</div>

<style>
    .hover-card:hover {
        transform: translateY(-4px);
        border-color: #2563eb !important;
        box-shadow: 0 14px 28px rgba(37, 99, 235, 0.09) !important;
    }
    .transition {
        transition: all 0.2s ease-in-out;
    }
</style>
@endsection