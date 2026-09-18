<?php

namespace App\Http\Controllers;

use App\Models\PaketSoal;
use App\Models\HasilUjian;
use App\Models\HasilKepribadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MuridController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $user = Auth::user();

        $totalUjian = HasilUjian::where(
            'user_id',
            $user->id
        )->count();

        $rataRata = HasilUjian::where(
            'user_id',
            $user->id
        )->avg('nilai');

        $nilaiTertinggi = HasilUjian::where(
            'user_id',
            $user->id
        )->max('nilai');

        $ujianTerakhir = HasilUjian::with(
            'paketSoal'
        )
            ->where(
                'user_id',
                $user->id
            )
            ->latest('selesai_pada')
            ->first();

        $grafikHasil = HasilUjian::where(
            'user_id',
            $user->id
        )
            ->orderBy(
                'selesai_pada',
                'asc'
            )
            ->get()
            ->map(function ($hasil) {

                return [
                    'tanggal' =>
                        $hasil->selesai_pada
                            ? $hasil->selesai_pada->format('d M')
                            : '-',

                    'nilai' =>
                        (float) $hasil->nilai,
                ];
            });

        $kategoriHasil = HasilUjian::where(
            'user_id',
            $user->id
        )
            ->whereNotNull('kategori')
            ->selectRaw(
                'kategori, COUNT(*) as jumlah'
            )
            ->groupBy('kategori')
            ->orderByDesc('jumlah')
            ->get();

        return view(
            'murid.dashboard',
            compact(
                'totalUjian',
                'rataRata',
                'nilaiTertinggi',
                'ujianTerakhir',
                'grafikHasil',
                'kategoriHasil'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAKET SOAL
    |--------------------------------------------------------------------------
    */

    public function paketSoal()
    {
        $pakets = PaketSoal::latest()->get();

        return view(
            'murid.paket-soal',
            compact('pakets')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | MULAI UJIAN KECERMATAN
    |--------------------------------------------------------------------------
    */

    public function mulaiUjian(
        PaketSoal $paketSoal
    ) {
        $paketSoal->load([
            'kolomUjians.soalKecermatan'
        ]);

        $kolomUjians =
            $paketSoal->kolomUjians;

        if ($kolomUjians->isEmpty()) {

            return redirect()
                ->route('murid.paket-soal')
                ->with(
                    'error',
                    'Paket soal belum memiliki kolom ujian.'
                );
        }

        $totalSoal =
            $kolomUjians->sum(
                function ($kolom) {

                    return $kolom
                        ->soalKecermatan
                        ->count();
                }
            );

        if ($totalSoal <= 0) {

            return redirect()
                ->route('murid.paket-soal')
                ->with(
                    'error',
                    'Paket soal belum memiliki soal.'
                );
        }

        session([
            'ujian_paket_id' =>
                $paketSoal->id,

            'ujian_mulai' =>
                now()->toDateTimeString(),

            'ujian_kolom_aktif' =>
                0,

            'ujian_jawaban' =>
                [],

            'ujian_statistik' =>
                [],
        ]);

        return view(
            'murid.ujian',
            compact(
                'paketSoal',
                'kolomUjians'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN JAWABAN KOLOM
    |--------------------------------------------------------------------------
    */

    public function simpanKolom(
        Request $request
    ) {
        $request->validate([
            'paket_soal_id' =>
                'required|integer',

            'kolom_id' =>
                'required|integer',

            'jawaban' =>
                'nullable|array',
        ]);

        $paketSoal =
            PaketSoal::with([
                'kolomUjians.soalKecermatan'
            ])
                ->findOrFail(
                    $request->paket_soal_id
                );

        $kolom =
            $paketSoal->kolomUjians
                ->firstWhere(
                    'id',
                    $request->kolom_id
                );

        if (!$kolom) {

            return response()->json([
                'success' =>
                    false,

                'message' =>
                    'Kolom ujian tidak ditemukan.'
            ], 404);
        }

        $jawaban =
            $request->jawaban ?? [];

        $jawabanNormal = [];

        foreach (
            $jawaban as $nomor => $nilai
        ) {

            $jawabanNormal[
                (string) $nomor
            ] =
                strtoupper(
                    trim(
                        (string) $nilai
                    )
                );
        }

        $semuaJawaban =
            session(
                'ujian_jawaban',
                []
            );

        $semuaJawaban[
            $kolom->nomor_kolom
        ] =
            $jawabanNormal;

        session([
            'ujian_jawaban' =>
                $semuaJawaban
        ]);

        $statistik =
            $this->hitungStatistikKolom(
                $kolom,
                $jawabanNormal
            );

        $semuaStatistik =
            session(
                'ujian_statistik',
                []
            );

        $semuaStatistik[
            $kolom->nomor_kolom
        ] =
            $statistik;

        session([
            'ujian_statistik' =>
                $semuaStatistik
        ]);

        return response()->json([
            'success' =>
                true,

            'message' =>
                'Jawaban berhasil disimpan.',

            'stats' =>
                $statistik,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | SELESAI UJIAN KECERMATAN
    |--------------------------------------------------------------------------
    */

    public function selesaiUjian(
        Request $request
    ) {
        $paketSoalId =
            session(
                'ujian_paket_id'
            );

        if (!$paketSoalId) {

            return redirect()
                ->route('murid.paket-soal')
                ->with(
                    'error',
                    'Sesi ujian tidak ditemukan.'
                );
        }

        $paketSoal =
            PaketSoal::with([
                'kolomUjians.soalKecermatan'
            ])
                ->findOrFail(
                    $paketSoalId
                );

        $semuaJawaban =
            session(
                'ujian_jawaban',
                []
            );

        $totalSoal = 0;

        $totalBenar = 0;

        $nilaiKolom = [];

        $jumlahDijawab = [];

        foreach (
            $paketSoal->kolomUjians
            as $kolom
        ) {

            $jawabanKolom =
                $semuaJawaban[
                    $kolom->nomor_kolom
                ] ?? [];

            $statistik =
                $this->hitungStatistikKolom(
                    $kolom,
                    $jawabanKolom
                );

            $nomorKolom =
                $kolom->nomor_kolom;

            $nilaiKolom[
                $nomorKolom
            ] =
                $statistik['nilai'];

            $jumlahDijawab[
                $nomorKolom
            ] =
                $statistik['dijawab'];

            $totalSoal +=
                $statistik['total_soal'];

            $totalBenar +=
                $statistik['benar'];
        }

        $nilai =
            $totalSoal > 0
                ? round(
                    (
                        $totalBenar /
                        $totalSoal
                    ) * 100,
                    2
                )
                : 0;

        $analisis =
            $this->analisisPerforma(
                $nilai
            );

        $hasil =
            HasilUjian::create([

                'user_id' =>
                    Auth::id(),

                'paket_soal_id' =>
                    $paketSoal->id,

                'nilai_kolom' =>
                    $nilaiKolom,

                'jumlah_dijawab' =>
                    $jumlahDijawab,

                'jawaban' =>
                    $semuaJawaban,

                'total_benar' =>
                    $totalBenar,

                'total_soal' =>
                    $totalSoal,

                'nilai' =>
                    $nilai,

                'kategori' =>
                    $analisis['kategori'],

                'keterangan' =>
                    $analisis['keterangan'],

                'mulai_pada' =>
                    session(
                        'ujian_mulai'
                    ) ?? now(),

                'selesai_pada' =>
                    now(),
            ]);

        session()->forget([
            'ujian_paket_id',
            'ujian_mulai',
            'ujian_kolom_aktif',
            'ujian_jawaban',
            'ujian_statistik',
        ]);

        return redirect()
            ->route(
                'murid.hasil',
                $hasil->id
            )
            ->with(
                'success',
                'Ujian berhasil diselesaikan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HASIL TERAKHIR KECERMATAN
    |--------------------------------------------------------------------------
    */

    public function hasilTerakhir()
    {
        $hasil =
            HasilUjian::where(
                'user_id',
                Auth::id()
            )
                ->latest('selesai_pada')
                ->first();

        if (!$hasil) {

            return redirect()
                ->route('murid.riwayat')
                ->with(
                    'info',
                    'Belum ada hasil ujian.'
                );
        }

        return redirect()->route(
            'murid.hasil',
            $hasil->id
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RIWAYAT SEMUA UJIAN
    |--------------------------------------------------------------------------
    |
    | KECERMATAN
    |   -> HasilUjian
    |
    | KEPRIBADIAN
    |   -> HasilKepribadian
    |
    | Keduanya digabung untuk halaman Riwayat.
    |--------------------------------------------------------------------------
    */

    public function hasilIndex(
        Request $request
    ) {
        $userId =
            Auth::id();


        /*
        |--------------------------------------------------------------------------
        | AMBIL HASIL KECERMATAN
        |--------------------------------------------------------------------------
        */

        $hasilKecermatan =
            HasilUjian::with(
                'paketSoal'
            )
                ->where(
                    'user_id',
                    $userId
                )
                ->get()
                ->map(
                    function ($hasil) {

                        $namaPaket =
                            $hasil->paketSoal->nama_paket
                            ?? 'Paket Kecermatan';

                        return (object) [

                            'id' =>
                                $hasil->id,

                            'tipe' =>
                                'kecermatan',

                            'nama_paket' =>
                                $namaPaket,

                            'nilai' =>
                                (float) (
                                    $hasil->nilai ?? 0
                                ),

                            'kategori' =>
                                $hasil->kategori
                                ?? 'Belum Ada Kategori',

                            'total_soal' =>
                                (int) (
                                    $hasil->total_soal ?? 0
                                ),

                            'jumlah_dijawab' =>
                                $this->totalDijawabKecermatan(
                                    $hasil->jumlah_dijawab
                                ),

                            'tanggal' =>
                                $hasil->selesai_pada,

                            'url' =>
                                route(
                                    'murid.hasil',
                                    $hasil->id
                                ),

                            'icon' =>
                                'bi-bullseye',

                            'warna' =>
                                'kecermatan',

                            'asli' =>
                                $hasil,
                        ];
                    }
                );


        /*
        |--------------------------------------------------------------------------
        | AMBIL HASIL KEPRIBADIAN
        |--------------------------------------------------------------------------
        */

        $hasilKepribadian =
            HasilKepribadian::with(
                'bank'
            )
                ->where(
                    'user_id',
                    $userId
                )
                ->get()
                ->map(
                    function ($hasil) {

                        $persentase =
                            (float) (
                                $hasil->persentase ?? 0
                            );


                        /*
                        |----------------------------------------------------------
                        | KATEGORI KEPRIBADIAN
                        |----------------------------------------------------------
                        */

                        if ($persentase >= 80) {

                            $kategori =
                                'Sangat Baik';

                        } elseif ($persentase >= 70) {

                            $kategori =
                                'Baik';

                        } elseif ($persentase >= 60) {

                            $kategori =
                                'Cukup';

                        } else {

                            $kategori =
                                'Perlu Latihan';
                        }


                        $namaBank =
                            $hasil->bank->nama_bank
                            ?? 'Paket Kepribadian';


                        return (object) [

                            'id' =>
                                $hasil->id,

                            'tipe' =>
                                'kepribadian',

                            'nama_paket' =>
                                $namaBank,

                            'nilai' =>
                                $persentase,

                            'kategori' =>
                                $kategori,

                            'total_soal' =>
                                (int) (
                                    $hasil->total_soal ?? 0
                                ),

                            'jumlah_dijawab' =>
                                (int) (
                                    $hasil->jumlah_dijawab ?? 0
                                ),

                            'tanggal' =>
                                $hasil->created_at,

                            'url' =>
                                route(
                                    'murid.kepribadian.hasil',
                                    $hasil->id
                                ),

                            'icon' =>
                                'bi-person-badge-fill',

                            'warna' =>
                                'kepribadian',

                            'asli' =>
                                $hasil,
                        ];
                    }
                );


        /*
        |--------------------------------------------------------------------------
        | GABUNGKAN
        |--------------------------------------------------------------------------
        */

        $semuaHasil =
            $hasilKecermatan
                ->concat(
                    $hasilKepribadian
                )
                ->sortByDesc(
                    function ($hasil) {

                        return $hasil->tanggal
                            ? $hasil->tanggal->timestamp
                            : 0;
                    }
                )
                ->values();


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('search')
        ) {

            $search =
                strtolower(
                    trim(
                        $request->search
                    )
                );

            $semuaHasil =
                $semuaHasil
                    ->filter(
                        function ($hasil) use (
                            $search
                        ) {

                            return str_contains(
                                strtolower(
                                    $hasil->nama_paket
                                ),
                                $search
                            )
                            ||
                            str_contains(
                                strtolower(
                                    $hasil->tipe
                                ),
                                $search
                            )
                            ||
                            str_contains(
                                strtolower(
                                    $hasil->kategori
                                ),
                                $search
                            );
                        }
                    )
                    ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER KATEGORI
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('kategori')
        ) {

            $kategori =
                strtolower(
                    trim(
                        $request->kategori
                    )
                );

            $semuaHasil =
                $semuaHasil
                    ->filter(
                        function ($hasil) use (
                            $kategori
                        ) {

                            return strtolower(
                                $hasil->kategori
                            ) === $kategori;
                        }
                    )
                    ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalUjian =
            $semuaHasil->count();


        $rataRata =
            $totalUjian > 0
                ? $semuaHasil->avg(
                    'nilai'
                )
                : 0;


        $nilaiTertinggi =
            $totalUjian > 0
                ? $semuaHasil->max(
                    'nilai'
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | UJIAN TERAKHIR
        |--------------------------------------------------------------------------
        */

        $ujianTerakhir =
            $semuaHasil->first();


        /*
        |--------------------------------------------------------------------------
        | LIST KATEGORI
        |--------------------------------------------------------------------------
        */

        $kategoriList =
            $semuaHasil
                ->pluck('kategori')
                ->filter()
                ->unique()
                ->values();


        /*
        |--------------------------------------------------------------------------
        | DATA UNTUK GRAFIK
        |--------------------------------------------------------------------------
        */

        $grafikHasil =
            $semuaHasil
                ->sortBy(
                    function ($hasil) {

                        return $hasil->tanggal
                            ? $hasil->tanggal->timestamp
                            : 0;
                    }
                )
                ->values()
                ->map(
                    function ($hasil) {

                        return [

                            'tanggal' =>
                                $hasil->tanggal
                                    ? $hasil->tanggal
                                        ->format('d M')
                                    : '-',

                            'nilai' =>
                                (float) $hasil->nilai,

                            'tipe' =>
                                $hasil->tipe,

                            'nama' =>
                                $hasil->nama_paket,
                        ];
                    }
                )
                ->values();


        /*
        |--------------------------------------------------------------------------
        | KIRIM KE VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'murid.hasil-index',
            [

                /*
                | Koleksi gabungan.
                */
                'hasilUjians' =>
                    $semuaHasil,

                /*
                | Alias agar mudah dipakai.
                */
                'semuaHasil' =>
                    $semuaHasil,

                /*
                | Statistik.
                */
                'totalUjian' =>
                    $totalUjian,

                'rataRata' =>
                    $rataRata,

                'nilaiTertinggi' =>
                    $nilaiTertinggi,

                'ujianTerakhir' =>
                    $ujianTerakhir,

                'kategoriList' =>
                    $kategoriList,

                'grafikHasil' =>
                    $grafikHasil,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL HASIL UJIAN KECERMATAN
    |--------------------------------------------------------------------------
    */

    public function hasil(
        HasilUjian $hasil
    ) {
        if (
            $hasil->user_id !==
            Auth::id()
        ) {

            abort(
                403,
                'Anda tidak memiliki akses ke hasil ujian ini.'
            );
        }

        $hasil->load([
            'paketSoal.kolomUjians.soalKecermatan'
        ]);

        $statistikKolom = [];

        foreach (
            $hasil->paketSoal->kolomUjians
            as $kolom
        ) {

            $jawabanKolom =
                $hasil->jawaban[
                    $kolom->nomor_kolom
                ] ?? [];

            $statistikKolom[
                $kolom->nomor_kolom
            ] =
                $this->hitungStatistikKolom(
                    $kolom,
                    $jawabanKolom
                );
        }


        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK
        |--------------------------------------------------------------------------
        */

        $grafikLabel = [];

        $grafikNilai = [];

        $grafikBenar = [];

        $grafikSalah = [];

        $grafikTidakDijawab = [];

        foreach (
            $statistikKolom
            as $nomor =>
            $statistik
        ) {

            $grafikLabel[] =
                'Kolom ' . $nomor;

            $grafikNilai[] =
                $statistik['nilai'];

            $grafikBenar[] =
                $statistik['benar'];

            $grafikSalah[] =
                $statistik['salah'];

            $grafikTidakDijawab[] =
                $statistik['tidak_dijawab'];
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $totalBenar =
            (int) (
                $hasil->total_benar
                ?? 0
            );

        $totalSoal =
            (int) (
                $hasil->total_soal
                ?? 0
            );


        /*
        |--------------------------------------------------------------------------
        | TOTAL DIJAWAB
        |--------------------------------------------------------------------------
        */

        $jumlahDijawab =
            $hasil->jumlah_dijawab;

        $totalDijawab =
            $this->totalDijawabKecermatan(
                $jumlahDijawab
            );


        /*
        |--------------------------------------------------------------------------
        | TOTAL SALAH
        |--------------------------------------------------------------------------
        */

        $totalSalah =
            max(
                0,
                $totalDijawab -
                $totalBenar
            );


        /*
        |--------------------------------------------------------------------------
        | TOTAL TIDAK DIJAWAB
        |--------------------------------------------------------------------------
        */

        $totalTidakDijawab =
            max(
                0,
                $totalSoal -
                $totalDijawab
            );


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'murid.hasil',
            compact(
                'hasil',
                'statistikKolom',
                'grafikLabel',
                'grafikNilai',
                'grafikBenar',
                'grafikSalah',
                'grafikTidakDijawab',
                'totalBenar',
                'totalSoal',
                'totalDijawab',
                'totalSalah',
                'totalTidakDijawab'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG TOTAL DIJAWAB KECERMATAN
    |--------------------------------------------------------------------------
    */

    private function totalDijawabKecermatan(
        $jumlahDijawab
    ) {
        /*
        | Data bisa berupa ARRAY.
        */

        if (
            is_array(
                $jumlahDijawab
            )
        ) {

            return array_sum(
                array_map(
                    'intval',
                    $jumlahDijawab
                )
            );
        }


        /*
        | Data bisa berupa angka.
        */

        if (
            is_numeric(
                $jumlahDijawab
            )
        ) {

            return (int) $jumlahDijawab;
        }


        /*
        | Data bisa berupa JSON string.
        */

        if (
            is_string(
                $jumlahDijawab
            )
        ) {

            $decoded =
                json_decode(
                    $jumlahDijawab,
                    true
                );

            if (
                is_array(
                    $decoded
                )
            ) {

                return array_sum(
                    array_map(
                        'intval',
                        $decoded
                    )
                );
            }

            if (
                is_numeric(
                    $jumlahDijawab
                )
            ) {

                return (int) $jumlahDijawab;
            }
        }


        return 0;
    }


    /*
    |--------------------------------------------------------------------------
    | HITUNG STATISTIK KOLOM
    |--------------------------------------------------------------------------
    */

    private function hitungStatistikKolom(
        $kolom,
        $jawaban
    ) {
        $soals =
            $kolom->soalKecermatan;

        $totalSoal =
            $soals->count();

        $dijawab = 0;

        $benar = 0;

        $salah = 0;

        foreach (
            $soals as $soal
        ) {

            $nomor =
                (string)
                $soal->nomor_soal;

            $jawabanUser =
                $jawaban[
                    $nomor
                ] ?? null;

            if (
                $jawabanUser !== null &&
                $jawabanUser !== ''
            ) {

                $dijawab++;

                $jawabanUser =
                    strtoupper(
                        trim(
                            (string)
                            $jawabanUser
                        )
                    );

                $kunci =
                    strtoupper(
                        trim(
                            (string)
                            $soal->jawaban_benar
                        )
                    );

                if (
                    $jawabanUser ===
                    $kunci
                ) {

                    $benar++;

                } else {

                    $salah++;
                }
            }
        }

        $tidakDijawab =
            $totalSoal -
            $dijawab;

        $nilai =
            $totalSoal > 0
                ? round(
                    (
                        $benar /
                        $totalSoal
                    ) * 100,
                    2
                )
                : 0;

        return [

            'total_soal' =>
                $totalSoal,

            'dijawab' =>
                $dijawab,

            'benar' =>
                $benar,

            'salah' =>
                $salah,

            'tidak_dijawab' =>
                $tidakDijawab,

            'nilai' =>
                $nilai,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | ANALISIS PERFORMA
    |--------------------------------------------------------------------------
    */

    private function analisisPerforma(
        $nilai
    ) {

        if ($nilai >= 90) {

            return [

                'kategori' =>
                    'Sangat Baik',

                'keterangan' =>
                    'Performa sangat baik. Pertahankan ketelitian dan kecepatan Anda.',
            ];
        }


        if ($nilai >= 80) {

            return [

                'kategori' =>
                    'Baik',

                'keterangan' =>
                    'Performa baik. Tingkatkan lagi ketelitian dan konsistensi.',
            ];
        }


        if ($nilai >= 70) {

            return [

                'kategori' =>
                    'Cukup',

                'keterangan' =>
                    'Performa cukup baik. Masih perlu meningkatkan ketelitian.',
            ];
        }


        if ($nilai >= 60) {

            return [

                'kategori' =>
                    'Perlu Latihan',

                'keterangan' =>
                    'Perbanyak latihan agar kecepatan dan ketelitian semakin baik.',
            ];
        }


        return [

            'kategori' =>
                'Perlu Banyak Latihan',

            'keterangan' =>
                'Hasil masih perlu ditingkatkan. Fokus pada latihan kecermatan secara rutin.',
        ];
    }
}