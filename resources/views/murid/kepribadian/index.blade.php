@extends('layouts.navbar-murid')
@section('content')
<div class="container py-5">
  <div class="mb-4"><h2 class="fw-bold">Tes Kepribadian</h2><p class="text-muted">Pilih paket ujian yang tersedia.</p></div>
  @if(session('error'))<div class="alert alert-danger rounded-4">{{ session('error') }}</div>@endif
  @if(session('success'))<div class="alert alert-success rounded-4">{{ session('success') }}</div>@endif
  <div class="row g-4">
    @forelse($pakets as $paket)
      <div class="col-lg-4 col-md-6"><div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden"><div style="height:7px;background:linear-gradient(90deg,#2563eb,#06b6d4)"></div><div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-start mb-3"><span class="badge text-bg-primary">{{ $paket->tingkat }}</span><span class="badge text-bg-light">{{ $paket->durasi }} menit</span></div>
        <h4 class="fw-bold">{{ $paket->nama_paket }}</h4><p class="text-muted">{{ $paket->keterangan ?: 'Paket latihan tes kepribadian.' }}</p>
        <div class="small text-secondary mb-4"><i class="bi bi-list-check me-1"></i>{{ $paket->soal_kepribadian_count }} soal</div>
        <a href="{{ route('murid.kepribadian.mulai', $paket->id) }}" class="btn btn-primary w-100 rounded-3 fw-semibold"><i class="bi bi-play-circle-fill me-2"></i>Mulai Ujian</a>
      </div></div></div>
    @empty
      <div class="col-12"><div class="text-center py-5 bg-white shadow-sm rounded-4"><i class="bi bi-clipboard-x fs-1 text-secondary"></i><h5 class="fw-bold mt-3">Belum Ada Paket Ujian</h5><p class="text-muted mb-0">Admin belum menerbitkan paket kepribadian aktif.</p></div></div>
    @endforelse
  </div>
</div>
@endsection
