@extends('layouts.navbar-murid')

@section('content')

<div class="container py-5">

    <div class="mb-4">

        <span class="badge bg-primary mb-2">
            <i class="bi bi-lightbulb-fill me-1"></i>
            Tes Kecerdasan
        </span>

        <h2 class="fw-bold">
            Pilih Paket Ujian
        </h2>

        <p class="text-muted">
            Pilih paket soal kecerdasan yang ingin kamu kerjakan.
        </p>

    </div>


    @if(session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    <div class="row g-4">

        @forelse($pakets as $paket)

            <div class="col-md-6 col-lg-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-4">

                        <div
                            class="rounded-4 bg-primary bg-opacity-10
                                   d-flex align-items-center justify-content-center mb-3"
                            style="width:55px;height:55px;"
                        >
                            <i
                                class="bi bi-lightbulb-fill text-primary fs-4"
                            ></i>
                        </div>


                        <h5 class="fw-bold">
                            {{ $paket->nama_paket }}
                        </h5>


                        <div class="text-muted small mb-3">

                            <div class="mb-1">

                                <i class="bi bi-list-ol me-1"></i>

                                {{ $paket->soals_count }}
                                Soal

                            </div>


                            <div class="mb-1">

                                <i class="bi bi-clock me-1"></i>

                                {{ $paket->durasi }}
                                Menit

                            </div>


                            <div>

                                <i class="bi bi-bar-chart me-1"></i>

                                Tingkat:
                                {{ ucfirst($paket->tingkat) }}

                            </div>

                        </div>


                        <a
                            href="{{ route(
                                'murid.kecerdasan.mulai',
                                $paket
                            ) }}"
                            class="btn btn-primary w-100"
                        >

                            <i class="bi bi-play-fill me-1"></i>

                            Mulai Ujian

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="text-center py-5">

                    <i
                        class="bi bi-inbox text-muted"
                        style="font-size:60px;"
                    ></i>

                    <h5 class="fw-bold mt-3">
                        Belum ada paket kecerdasan
                    </h5>

                    <p class="text-muted">
                        Paket ujian belum tersedia.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection