@extends('layouts.admin-zavier')

@section('title', 'Edit Data Murid - Super Admin ZAVIER')

@section('content')
<style>
    .card-edit-murid {
        background: #ffffff;
        border: 1px solid #e7edf6;
        border-radius: 20px;
        box-shadow: 0 4px 18px rgba(19, 42, 74, 0.05);
        overflow: hidden;
    }

    .card-header-gradient {
        background: linear-gradient(135deg, #0d6efd 0%, #1555b7 60%, #06b6d4 100%);
        padding: 24px 28px;
        color: #ffffff;
    }

    .form-control-custom {
        border: 1.5px solid #d9e3f0;
        border-radius: 12px;
        padding: 11px 16px;
        font-size: 14px;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .form-control-custom:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.12);
    }
</style>

<div class="container-fluid py-2">

    <!-- Tombol Kembali -->
    <div class="mb-3">
        <a href="{{ route('admin.murid') }}" class="btn btn-outline-secondary rounded-pill px-3 fw-semibold">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Murid
        </a>
    </div>

    <!-- Alert Error Validasi -->
    @if($errors->any())
        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">
            <div class="fw-bold small mb-1">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> Periksa kembali isian berikut:
            </div>
            <ul class="mb-0 small ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-edit-murid">

                <!-- Header Card -->
                <div class="card-header-gradient">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 20px;">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0 text-white">Edit Data Murid</h4>
                            <small class="text-white-50">Perbarui profil dan keamanan akun peserta didik</small>
                        </div>
                    </div>
                </div>

                <!-- Form Isi -->
                <div class="p-4 p-md-5">
                    @php
                        $targetUser = $user ?? $murid;
                    @endphp

                    <form action="{{ route('admin.murid.update', $targetUser->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama Murid -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold text-dark small">
                                Nama Murid <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   class="form-control form-control-custom @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $targetUser->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Murid -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold text-dark small">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email"
                                   class="form-control form-control-custom @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $targetUser->email) }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Baru -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold text-dark small">
                                Password Baru
                            </label>
                            <input type="password"
                                   class="form-control form-control-custom @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password"
                                   placeholder="Kosongkan jika tidak ingin mengubah password">
                            <div class="form-text text-muted small mt-1">
                                Minimal 6 karakter.
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex align-items-center gap-2 pt-3 border-top">
                            <a href="{{ route('admin.murid') }}" class="btn btn-secondary rounded-3 px-4 py-2 fw-semibold">
                                &larr; Kembali
                            </a>
                            <button type="submit" class="btn btn-primary rounded-3 px-4 py-2 fw-bold">
                                💾 Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection