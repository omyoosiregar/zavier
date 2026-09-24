@include('layouts.navbar-murid')

<div class="container py-5">

    <div class="mb-4">

        <h2 class="fw-bold">
            Riwayat Ujian Kecerdasan
        </h2>

        <p class="text-muted">
            Daftar hasil ujian kecerdasan yang sudah kamu kerjakan.
        </p>

    </div>


    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-body p-0">

            @forelse($hasil as $item)

                <div
                    class="p-4 border-bottom"
                >

                    <div
                        class="d-flex
                               justify-content-between
                               align-items-center
                               flex-wrap gap-3"
                    >

                        <div>

                            <h5 class="fw-bold mb-1">

                                {{ $item->paket->nama_paket }}

                            </h5>

                            <div class="text-muted small">

                                {{ $item->finished_at
                                    ? $item->finished_at->format(
                                        'd/m/Y H:i'
                                    )
                                    : '-' }}

                                ·

                                {{ $item->jumlah_soal }}
                                soal

                            </div>

                        </div>


                        <div class="text-end">

                            <div
                                class="fw-bold text-primary fs-4"
                            >

                                {{ number_format(
                                    $item->nilai,
                                    2
                                ) }}

                            </div>

                            <small class="text-muted">
                                Nilai
                            </small>

                        </div>


                        <div>

                            <a
                                href="{{ route(
                                    'murid.kecerdasan.hasil',
                                    $item
                                ) }}"
                                class="btn btn-outline-primary btn-sm"
                            >

                                Lihat Hasil

                                <i
                                    class="bi bi-arrow-right"
                                ></i>

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-5">

                    <i
                        class="bi bi-clock-history text-muted"
                        style="font-size:50px;"
                    ></i>

                    <h5 class="fw-bold mt-3">
                        Belum Ada Riwayat
                    </h5>

                    <p class="text-muted">
                        Kamu belum menyelesaikan ujian kecerdasan.
                    </p>

                </div>

            @endforelse

        </div>

    </div>


    <div class="mt-4">

        {{ $hasil->links() }}

    </div>

</div>