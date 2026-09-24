<?php

namespace App\Http\Controllers;

use App\Models\PaketSoal;
use App\Models\PaketKecerdasan;
use App\Models\HasilUjian;
use App\Models\HasilKepribadian;
use App\Models\HasilKecerdasan;
use App\Models\JawabanKecerdasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    | PAKET SOAL MURID
    |--------------------------------------------------------------------------
    |
    | Kecermatan:
    |   PaketSoal
    |
    | Kepribadian:
    |   tetap menggunakan sistem yang sudah ada
    |
    | Kecerdasan:
    |   PaketKecerdasan
    |
    | Kecerdasan digabung ke koleksi $pakets supaya halaman
    | murid/paket-soal dapat menampilkannya bersama paket lainnya.
    |--------------------------------------------------------------------------
    */

    public function paketSoal()
    {
        /*
        |--------------------------------------------------------------------------
        | PAKET KECERMATAN
        |--------------------------------------------------------------------------
        */

        $paketsKecermatan = PaketSoal::latest()
            ->get()
            ->map(function ($paket) {

                /*
                | Tandai bahwa data berasal dari PaketSoal.
                */

                $paket->source_type = 'kecermatan';

                $paket->source_id = $paket->id;

                /*
                | Jika jenis tes belum tersedia/berbeda,
                | tetap beri label yang mudah digunakan di view.
                */

                $paket->jenis_tes =
                    $paket->jenis_tes
                    ?? 'Kecermatan';

                return $paket;
            });


        /*
        |--------------------------------------------------------------------------
        | PAKET KECERDASAN
        |--------------------------------------------------------------------------
        */

        $paketsKecerdasan = PaketKecerdasan::where(
            'status',
            true
        )
            ->latest()
            ->get()
            ->map(function ($paket) {

                /*
                | Tambahkan properti agar bentuk datanya
                | mudah dibedakan oleh view.
                */

                $paket->source_type =
                    'kecerdasan';

                $paket->source_id =
                    $paket->id;

                $paket->jenis_tes =
                    'Kecerdasan';

                /*
                | Nama kategori jika view membutuhkan.
                */

                $paket->kategori =
                    $paket->kategori
                    ?? 'Kecerdasan';

                /*
                | Hitung jumlah soal langsung dari relasi.
                */

                try {

                    $paket->jumlah_soal =
                        $paket->soals()->count();

                } catch (\Throwable $e) {

                    /*
                    | Jangan membuat halaman paket soal
                    | mati apabila relasi belum tersedia.
                    */

                    $paket->jumlah_soal =
                        $paket->jumlah_soal
                        ?? 0;
                }

                return $paket;
            });


        /*
        |--------------------------------------------------------------------------
        | GABUNGKAN
        |--------------------------------------------------------------------------
        */

        $pakets =
            $paketsKecermatan
                ->concat($paketsKecerdasan)
                ->sortByDesc(function ($paket) {

                    return $paket->created_at
                        ? $paket->created_at->timestamp
                        : 0;
                })
                ->values();


        /*
        |--------------------------------------------------------------------------
        | DATA TAMBAHAN UNTUK VIEW
        |--------------------------------------------------------------------------
        |
        | Variabel terpisah juga dikirim supaya view yang sudah ada
        | dapat menggunakan salah satunya tanpa merusak sistem lama.
        |--------------------------------------------------------------------------
        */

        return view(
            'murid.paket-soal',
            compact(
                'pakets',
                'paketsKecermatan',
                'paketsKecerdasan'
            )
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
    | SIMPAN JAWABAN KOLOM KECERMATAN
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
    | MULAI UJIAN KECERDASAN
    |--------------------------------------------------------------------------
    |
    | Alur:
    |
    | Paket Kecerdasan
    |       ↓
    | Bank Soal
    |       ↓
    | Soal pilihan
    |       ↓
    | Mulai Ujian
    |       ↓
    | Jawaban
    |       ↓
    | Selesai
    |       ↓
    | Penilaian
    |--------------------------------------------------------------------------
    */

    public function mulaiKecerdasan(
        PaketKecerdasan $paketKecerdasan
    ) {
        /*
        |--------------------------------------------------------------------------
        | Ambil soal paket
        |--------------------------------------------------------------------------
        */

        $paketKecerdasan->load([
            'soals'
        ]);

        $soals =
            $paketKecerdasan->soals;

        /*
        |--------------------------------------------------------------------------
        | Pastikan paket mempunyai soal
        |--------------------------------------------------------------------------
        */

        if ($soals->isEmpty()) {

            return redirect()
                ->route('murid.paket-soal')
                ->with(
                    'error',
                    'Paket kecerdasan belum memiliki soal.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil durasi
        |--------------------------------------------------------------------------
        */

        $durasi =
            (int) (
                $paketKecerdasan->durasi
                ?? 0
            );

        /*
        | Jika durasi kosong, gunakan 60 menit
        | agar ujian tetap dapat dimulai.
        */

        if ($durasi <= 0) {

            $durasi = 60;
        }


        /*
        |--------------------------------------------------------------------------
        | Bersihkan session ujian kecerdasan sebelumnya
        |--------------------------------------------------------------------------
        */

        session()->forget([
            'kecerdasan_paket_id',
            'kecerdasan_hasil_id',
            'kecerdasan_mulai',
            'kecerdasan_jawaban',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Buat waktu mulai
        |--------------------------------------------------------------------------
        */

        $mulai =
            now();


        $selesai =
            $mulai->copy()
                ->addMinutes(
                    $durasi
                );


        /*
        |--------------------------------------------------------------------------
        | Simpan session
        |--------------------------------------------------------------------------
        */

        session([
            'kecerdasan_paket_id' =>
                $paketKecerdasan->id,

            'kecerdasan_mulai' =>
                $mulai->toDateTimeString(),

            'kecerdasan_selesai' =>
                $selesai->toDateTimeString(),

            'kecerdasan_jawaban' =>
                [],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Tampilkan halaman ujian
        |--------------------------------------------------------------------------
        */

        return view(
            'murid.kecerdasan.ujian',
            [
                'paketKecerdasan' =>
                    $paketKecerdasan,

                'soals' =>
                    $soals,

                'durasi' =>
                    $durasi,

                'waktuMulai' =>
                    $mulai,

                'waktuSelesai' =>
                    $selesai,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN JAWABAN KECERDASAN
    |--------------------------------------------------------------------------
    */

    public function simpanJawabanKecerdasan(
        Request $request
    ) {
        $request->validate([
            'paket_kecerdasan_id' =>
                'required|integer',

            'soal_id' =>
                'required|integer',

            'jawaban' =>
                'nullable|string|max:10',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Pastikan paket benar
        |--------------------------------------------------------------------------
        */

        $paket =
            PaketKecerdasan::findOrFail(
                $request->paket_kecerdasan_id
            );


        /*
        |--------------------------------------------------------------------------
        | Pastikan soal memang milik paket
        |--------------------------------------------------------------------------
        */

        $paket->load('soals');

        $soal =
            $paket->soals
                ->firstWhere(
                    'id',
                    $request->soal_id
                );


        if (!$soal) {

            return response()->json([
                'success' =>
                    false,

                'message' =>
                    'Soal tidak ditemukan dalam paket ini.'
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | Normalisasi jawaban
        |--------------------------------------------------------------------------
        */

        $jawaban =
            strtoupper(
                trim(
                    (string)
                    (
                        $request->jawaban
                        ?? ''
                    )
                )
            );


        /*
        |--------------------------------------------------------------------------
        | Simpan sementara ke session
        |--------------------------------------------------------------------------
        */

        $jawabanSession =
            session(
                'kecerdasan_jawaban',
                []
            );


        $jawabanSession[
            (string) $soal->id
        ] =
            $jawaban;


        session([
            'kecerdasan_jawaban' =>
                $jawabanSession
        ]);


        /*
        |--------------------------------------------------------------------------
        | Cek apakah jawaban benar
        |--------------------------------------------------------------------------
        */

        $kunci =
            strtoupper(
                trim(
                    (string)
                    (
                        $soal->jawaban_benar
                        ?? ''
                    )
                )
            );


        $benar =
            $jawaban !== ''
            &&
            $kunci !== ''
            &&
            $jawaban === $kunci;


        return response()->json([
            'success' =>
                true,

            'message' =>
                'Jawaban berhasil disimpan.',

            'soal_id' =>
                $soal->id,

            'jawaban' =>
                $jawaban,

            'benar' =>
                $benar,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | SELESAI UJIAN KECERDASAN
    |--------------------------------------------------------------------------
    */

    public function selesaiKecerdasan(
        Request $request
    ) {
        $paketId =
            session(
                'kecerdasan_paket_id'
            );


        if (!$paketId) {

            return redirect()
                ->route('murid.paket-soal')
                ->with(
                    'error',
                    'Sesi ujian kecerdasan tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil paket beserta soal
        |--------------------------------------------------------------------------
        */

        $paket =
            PaketKecerdasan::with([
                'soals'
            ])
                ->findOrFail(
                    $paketId
                );


        /*
        |--------------------------------------------------------------------------
        | Jawaban dari session
        |--------------------------------------------------------------------------
        */

        $jawabanUser =
            session(
                'kecerdasan_jawaban',
                []
            );


        $totalSoal =
            $paket->soals->count();


        $jumlahDijawab = 0;

        $jumlahBenar = 0;

        $jumlahSalah = 0;


        /*
        |--------------------------------------------------------------------------
        | Hasil per soal
        |--------------------------------------------------------------------------
        */

        $detailJawaban = [];


        foreach (
            $paket->soals as $soal
        ) {

            $soalId =
                (string)
                $soal->id;


            $jawaban =
                $jawabanUser[
                    $soalId
                ] ?? '';


            $jawaban =
                strtoupper(
                    trim(
                        (string)
                        $jawaban
                    )
                );


            $kunci =
                strtoupper(
                    trim(
                        (string)
                        (
                            $soal->jawaban_benar
                            ?? ''
                        )
                    )
                );


            $dijawab =
                $jawaban !== '';


            $benar =
                $dijawab
                &&
                $kunci !== ''
                &&
                $jawaban === $kunci;


            if ($dijawab) {

                $jumlahDijawab++;
            }


            if ($benar) {

                $jumlahBenar++;

            } elseif ($dijawab) {

                $jumlahSalah++;
            }


            $detailJawaban[] = [
                'soal_id' =>
                    $soal->id,

                'jawaban' =>
                    $jawaban,

                'benar' =>
                    $benar,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | NILAI
        |--------------------------------------------------------------------------
        |
        | Nilai 100 jika semua benar.
        | Jawaban salah tidak mendapatkan nilai.
        | Soal kosong juga tidak mendapatkan nilai.
        |--------------------------------------------------------------------------
        */

        $nilai =
            $totalSoal > 0
                ? round(
                    (
                        $jumlahBenar /
                        $totalSoal
                    ) * 100,
                    2
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | Tentukan kategori
        |--------------------------------------------------------------------------
        */

        if ($nilai >= 90) {

            $kategori =
                'Sangat Baik';

        } elseif ($nilai >= 80) {

            $kategori =
                'Baik';

        } elseif ($nilai >= 70) {

            $kategori =
                'Cukup';

        } elseif ($nilai >= 60) {

            $kategori =
                'Perlu Latihan';

        } else {

            $kategori =
                'Perlu Banyak Latihan';
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan hasil + jawaban dalam transaksi
        |--------------------------------------------------------------------------
        */

        $hasil = DB::transaction(
            function () use (
                $paket,
                $totalSoal,
                $jumlahDijawab,
                $jumlahBenar,
                $jumlahSalah,
                $nilai,
                $kategori,
                $detailJawaban
            ) {

                /*
                |--------------------------------------------------------------------------
                | Buat hasil ujian
                |--------------------------------------------------------------------------
                */

                $hasil =
                    HasilKecerdasan::create([

                        'user_id' =>
                            Auth::id(),

                        'paket_kecerdasan_id' =>
                            $paket->id,

                        'started_at' =>
                            session(
                                'kecerdasan_mulai'
                            ) ?? now(),

                        'finished_at' =>
                            now(),

                        'jumlah_soal' =>
                            $totalSoal,

                        'jumlah_dijawab' =>
                            $jumlahDijawab,

                        'jumlah_benar' =>
                            $jumlahBenar,

                        'jumlah_salah' =>
                            $jumlahSalah,

                        'nilai' =>
                            $nilai,

                        'status' =>
                            'finished',
                    ]);


                /*
                |--------------------------------------------------------------------------
                | Simpan setiap jawaban
                |--------------------------------------------------------------------------
                */

                foreach (
                    $detailJawaban as $detail
                ) {

                    JawabanKecerdasan::create([

                        'hasil_kecerdasan_id' =>
                            $hasil->id,

                        'soal_kecerdasan_id' =>
                            $detail['soal_id'],

                        'jawaban' =>
                            $detail['jawaban'],

                        'benar' =>
                            $detail['benar'],
                    ]);
                }


                return $hasil;
            }
        );


        /*
        |--------------------------------------------------------------------------
        | Bersihkan session
        |--------------------------------------------------------------------------
        */

        session()->forget([
            'kecerdasan_paket_id',
            'kecerdasan_hasil_id',
            'kecerdasan_mulai',
            'kecerdasan_selesai',
            'kecerdasan_jawaban',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Masuk ke halaman hasil
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'murid.kecerdasan.hasil',
                $hasil->id
            )
            ->with(
                'success',
                'Ujian kecerdasan berhasil diselesaikan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HASIL UJIAN KECERDASAN
    |--------------------------------------------------------------------------
    */

    public function hasilKecerdasan(
        HasilKecerdasan $hasil
    ) {
        /*
        |--------------------------------------------------------------------------
        | Keamanan
        |--------------------------------------------------------------------------
        */

        if (
            $hasil->user_id !==
            Auth::id()
        ) {

            abort(
                403,
                'Anda tidak memiliki akses ke hasil ujian ini.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Load relasi
        |--------------------------------------------------------------------------
        */

        $hasil->load([
            'paket',
            'jawaban.soal',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalSoal =
            (int) (
                $hasil->jumlah_soal
                ?? 0
            );


        $jumlahDijawab =
            (int) (
                $hasil->jumlah_dijawab
                ?? 0
            );


        $jumlahBenar =
            (int) (
                $hasil->jumlah_benar
                ?? 0
            );


        $jumlahSalah =
            (int) (
                $hasil->jumlah_salah
                ?? 0
            );


        $tidakDijawab =
            max(
                0,
                $totalSoal -
                $jumlahDijawab
            );


        $nilai =
            (float) (
                $hasil->nilai
                ?? 0
            );


        /*
        |--------------------------------------------------------------------------
        | Kategori
        |--------------------------------------------------------------------------
        */

        if ($nilai >= 90) {

            $kategori =
                'Sangat Baik';

        } elseif ($nilai >= 80) {

            $kategori =
                'Baik';

        } elseif ($nilai >= 70) {

            $kategori =
                'Cukup';

        } elseif ($nilai >= 60) {

            $kategori =
                'Perlu Latihan';

        } else {

            $kategori =
                'Perlu Banyak Latihan';
        }


        return view(
            'murid.kecerdasan.hasil',
            compact(
                'hasil',
                'totalSoal',
                'jumlahDijawab',
                'jumlahBenar',
                'jumlahSalah',
                'tidakDijawab',
                'nilai',
                'kategori'
            )
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
    | KECERDASAN
    |   -> HasilKecerdasan
    |
    | Ketiganya digabung.
    |--------------------------------------------------------------------------
    */

    public function hasilIndex(
        Request $request
    ) {
        $userId =
            Auth::id();


        /*
        |--------------------------------------------------------------------------
        | HASIL KECERMATAN
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
        | HASIL KEPRIBADIAN
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
        | HASIL KECERDASAN
        |--------------------------------------------------------------------------
        */

        $hasilKecerdasan =
            HasilKecerdasan::with(
                'paket'
            )
                ->where(
                    'user_id',
                    $userId
                )
                ->get()
                ->map(
                    function ($hasil) {

                        $namaPaket =
                            $hasil->paket->nama_paket
                            ?? 'Paket Kecerdasan';


                        $nilai =
                            (float) (
                                $hasil->nilai ?? 0
                            );


                        if ($nilai >= 90) {

                            $kategori =
                                'Sangat Baik';

                        } elseif ($nilai >= 80) {

                            $kategori =
                                'Baik';

                        } elseif ($nilai >= 70) {

                            $kategori =
                                'Cukup';

                        } elseif ($nilai >= 60) {

                            $kategori =
                                'Perlu Latihan';

                        } else {

                            $kategori =
                                'Perlu Banyak Latihan';
                        }


                        return (object) [

                            'id' =>
                                $hasil->id,

                            'tipe' =>
                                'kecerdasan',

                            'nama_paket' =>
                                $namaPaket,

                            'nilai' =>
                                $nilai,

                            'kategori' =>
                                $kategori,

                            'total_soal' =>
                                (int) (
                                    $hasil->jumlah_soal ?? 0
                                ),

                            'jumlah_dijawab' =>
                                (int) (
                                    $hasil->jumlah_dijawab ?? 0
                                ),

                            'tanggal' =>
                                $hasil->finished_at
                                ?? $hasil->created_at,

                            'url' =>
                                route(
                                    'murid.kecerdasan.hasil',
                                    $hasil->id
                                ),

                            'icon' =>
                                'bi-lightbulb-fill',

                            'warna' =>
                                'kecerdasan',

                            'asli' =>
                                $hasil,
                        ];
                    }
                );


        /*
        |--------------------------------------------------------------------------
        | GABUNGKAN SEMUA
        |--------------------------------------------------------------------------
        */

        $semuaHasil =
            $hasilKecermatan
                ->concat(
                    $hasilKepribadian
                )
                ->concat(
                    $hasilKecerdasan
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
        | DATA GRAFIK
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

                'hasilUjians' =>
                    $semuaHasil,

                'semuaHasil' =>
                    $semuaHasil,

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


        $jumlahDijawab =
            $hasil->jumlah_dijawab;


        $totalDijawab =
            $this->totalDijawabKecermatan(
                $jumlahDijawab
            );


        $totalSalah =
            max(
                0,
                $totalDijawab -
                $totalBenar
            );


        $totalTidakDijawab =
            max(
                0,
                $totalSoal -
                $totalDijawab
            );


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


        if (
            is_numeric(
                $jumlahDijawab
            )
        ) {

            return (int) $jumlahDijawab;
        }


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
    | HITUNG STATISTIK KOLOM KECERMATAN
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
    | ANALISIS PERFORMA KECERMATAN
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