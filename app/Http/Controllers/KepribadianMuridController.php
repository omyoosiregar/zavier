<?php

namespace App\Http\Controllers;

use App\Models\PaketSoal;
use App\Models\HasilKepribadian;
use App\Models\JawabanKepribadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KepribadianMuridController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DAFTAR PAKET KEPRIBADIAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pakets = PaketSoal::query()
            ->where('jenis_tes', 'Kepribadian')
            ->where('status', true)
            ->whereHas('soalKepribadian', function ($q) {
                $q->where('soal_kepribadian.status', true);
            })
            ->withCount('soalKepribadian')
            ->latest('id')
            ->get();

        return view(
            'murid.kepribadian.index',
            compact('pakets')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | MULAI UJIAN
    |--------------------------------------------------------------------------
    */

    public function mulai($paket)
    {
        $paket = PaketSoal::query()
            ->where('id', $paket)
            ->where('jenis_tes', 'Kepribadian')
            ->where('status', true)
            ->with([
                'soalKepribadian' => function ($q) {

                    $q->where(
                        'soal_kepribadian.status',
                        true
                    )
                    ->orderBy(
                        'paket_kepribadian_soal.nomor_urut'
                    );
                }
            ])
            ->firstOrFail();


        $soal = $paket
            ->soalKepribadian
            ->values();


        /*
        |--------------------------------------------------------------------------
        | CEK SOAL
        |--------------------------------------------------------------------------
        */

        if ($soal->isEmpty()) {

            return redirect()
                ->route('murid.kepribadian.index')
                ->with(
                    'error',
                    'Paket ini belum memiliki soal aktif.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | BERSIHKAN SESSION UJIAN LAMA
        |--------------------------------------------------------------------------
        */

        session()->forget([
            'kepribadian_paket_id',
            'kepribadian_bank_id',
            'kepribadian_soal_ids',
            'kepribadian_jawaban',
            'kepribadian_mulai',
            'kepribadian_hasil',
        ]);


        /*
        |--------------------------------------------------------------------------
        | WAKTU MULAI
        |--------------------------------------------------------------------------
        */

        $startedAt = now();


        /*
        |--------------------------------------------------------------------------
        | SIMPAN SESSION
        |--------------------------------------------------------------------------
        */

        session([
            'kepribadian_paket_id' =>
                $paket->id,

            'kepribadian_bank_id' =>
                optional(
                    $soal->first()
                )->bank_kepribadian_id,

            'kepribadian_soal_ids' =>
                $soal
                    ->pluck('id')
                    ->all(),

            'kepribadian_mulai' =>
                $startedAt->timestamp,
        ]);


        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN UJIAN
        |--------------------------------------------------------------------------
        */

        return view(
            'murid.kepribadian.ujian',
            [
                'paket' =>
                    $paket,

                'soal' =>
                    $soal,

                'durasiMenit' =>
                    (int) $paket->durasi,

                'startedAt' =>
                    $startedAt->timestamp,
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SELESAI UJIAN
    |--------------------------------------------------------------------------
    */

    public function selesai(
        Request $request,
        $paket
    ) {

        /*
        |--------------------------------------------------------------------------
        | AMBIL PAKET
        |--------------------------------------------------------------------------
        */

        $paket = PaketSoal::query()
            ->where('id', $paket)
            ->where(
                'jenis_tes',
                'Kepribadian'
            )
            ->with([
                'soalKepribadian' => function ($q) {

                    $q->where(
                        'soal_kepribadian.status',
                        true
                    )
                    ->orderBy(
                        'paket_kepribadian_soal.nomor_urut'
                    );
                }
            ])
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | VALIDASI SESSION
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) session(
                'kepribadian_paket_id'
            ) === (int) $paket->id,
            403,
            'Sesi paket ujian tidak cocok.'
        );


        /*
        |--------------------------------------------------------------------------
        | AMBIL SOAL PAKET
        |--------------------------------------------------------------------------
        */

        $soal = $paket
            ->soalKepribadian
            ->values();


        $soalIds = session(
            'kepribadian_soal_ids',
            []
        );


        $allowedIds = collect($soalIds)
            ->map(function ($id) {
                return (int) $id;
            })
            ->all();


        $soal = $soal
            ->filter(function ($item) use ($allowedIds) {

                return in_array(
                    (int) $item->id,
                    $allowedIds,
                    true
                );
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | SOAL KOSONG
        |--------------------------------------------------------------------------
        */

        if ($soal->isEmpty()) {

            return redirect()
                ->route(
                    'murid.kepribadian.index'
                )
                ->with(
                    'error',
                    'Soal paket tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEGAH SUBMIT ULANG
        |--------------------------------------------------------------------------
        */

        if (session('kepribadian_hasil')) {

            return redirect()
                ->route(
                    'murid.kepribadian.hasil',
                    session('kepribadian_hasil')
                );
        }


        /*
        |--------------------------------------------------------------------------
        | JAWABAN
        |--------------------------------------------------------------------------
        */

        $jawaban =
            $request->input(
                'jawaban',
                []
            );


        if (!is_array($jawaban)) {

            $jawaban = [];
        }


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI DATABASE
        |--------------------------------------------------------------------------
        */

        $hasil = DB::transaction(
            function () use (
                $soal,
                $jawaban,
                $paket
            ) {

                /*
                |--------------------------------------------------------------------------
                | BANK
                |--------------------------------------------------------------------------
                */

                $bankId =
                    optional(
                        $soal->first()
                    )->bank_kepribadian_id;


                /*
                |--------------------------------------------------------------------------
                | BUAT HASIL
                |--------------------------------------------------------------------------
                */

                $jumlahSoal =
                    $soal->count();


                $maksimal =
                    $jumlahSoal * 5;


                $hasil =
                    HasilKepribadian::create([
                        'user_id' =>
                            Auth::id(),

                        'bank_kepribadian_id' =>
                            $bankId,

                        'paket_soal_id' =>
                            $paket->id,

                        'total_soal' =>
                            $jumlahSoal,

                        'jumlah_dijawab' =>
                            0,

                        'jumlah_tidak_dijawab' =>
                            $jumlahSoal,

                        'total_skor' =>
                            0,

                        'skor_maksimal' =>
                            $maksimal,

                        'persentase' =>
                            0,
                    ]);


                /*
                |--------------------------------------------------------------------------
                | HITUNG JAWABAN
                |--------------------------------------------------------------------------
                */

                $dijawab = 0;

                $totalSkor = 0;


                foreach ($soal as $item) {

                    /*
                    |--------------------------------------------------------------------------
                    | PILIHAN USER
                    |--------------------------------------------------------------------------
                    */

                    $selected =
                        strtoupper(
                            trim(
                                (string) (
                                    $jawaban[
                                        $item->id
                                    ] ?? ''
                                )
                            )
                        );


                    if (
                        !in_array(
                            $selected,
                            [
                                'A',
                                'B',
                                'C',
                                'D',
                                'E'
                            ],
                            true
                        )
                    ) {

                        $selected = null;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | TEKS PILIHAN
                    |--------------------------------------------------------------------------
                    */

                    $texts = [

                        'A' =>
                            $item->pilihan_a,

                        'B' =>
                            $item->pilihan_b,

                        'C' =>
                            $item->pilihan_c,

                        'D' =>
                            $item->pilihan_d,

                        'E' =>
                            $item->pilihan_e,
                    ];


                    $text =
                        $selected
                            ? ($texts[$selected] ?? null)
                            : null;


                    /*
                    |--------------------------------------------------------------------------
                    | KUNCI
                    |--------------------------------------------------------------------------
                    */

                    $key =
                        strtoupper(
                            trim(
                                (string)
                                $item->kunci_jawaban
                            )
                        );


                    $score = 0;


                    /*
                    |--------------------------------------------------------------------------
                    | JIKA DIJAWAB
                    |--------------------------------------------------------------------------
                    */

                    if ($selected !== null) {

                        $dijawab++;


                        /*
                        |--------------------------------------------------------------------------
                        | NORMALISASI TEKS
                        |--------------------------------------------------------------------------
                        */

                        $normal =
                            function ($value) {

                                $value =
                                    strtolower(
                                        trim(
                                            (string)
                                            $value
                                        )
                                    );


                                $value =
                                    preg_replace(
                                        '/^[a-e]\s*[\.\)]\s*/i',
                                        '',
                                        $value
                                    );


                                return trim(
                                    preg_replace(
                                        '/\s+/u',
                                        ' ',
                                        $value
                                    )
                                );
                            };


                        $answerNormal =
                            $normal($text);


                        /*
                        |--------------------------------------------------------------------------
                        | TEKS KUNCI
                        |--------------------------------------------------------------------------
                        */

                        $keyText =
                            $texts[$key]
                            ?? $key;


                        $keyNormal =
                            $normal(
                                $keyText
                            );


                        /*
                        |--------------------------------------------------------------------------
                        | SKOR POSITIF
                        |--------------------------------------------------------------------------
                        */

                        $positive = [

                            'sangat setuju' =>
                                5,

                            'setuju' =>
                                4,

                            'ragu-ragu' =>
                                3,

                            'ragu ragu' =>
                                3,

                            'ragu' =>
                                3,

                            'tidak setuju' =>
                                2,

                            'sangat tidak setuju' =>
                                1,
                        ];


                        /*
                        |--------------------------------------------------------------------------
                        | SKOR NEGATIF
                        |--------------------------------------------------------------------------
                        */

                        $negative = [

                            'sangat setuju' =>
                                1,

                            'setuju' =>
                                2,

                            'ragu-ragu' =>
                                3,

                            'ragu ragu' =>
                                3,

                            'ragu' =>
                                3,

                            'tidak setuju' =>
                                4,

                            'sangat tidak setuju' =>
                                5,
                        ];


                        /*
                        |--------------------------------------------------------------------------
                        | HITUNG SKOR
                        |--------------------------------------------------------------------------
                        */

                        if (
                            $keyNormal ===
                            'sangat setuju'
                        ) {

                            $score =
                                $positive[
                                    $answerNormal
                                ] ?? 0;

                        } elseif (
                            $keyNormal ===
                            'sangat tidak setuju'
                        ) {

                            $score =
                                $negative[
                                    $answerNormal
                                ] ?? 0;

                        } else {

                            $score =
                                ($selected === $key)
                                    ? 5
                                    : 0;
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | TOTAL SKOR
                    |--------------------------------------------------------------------------
                    */

                    $totalSkor +=
                        $score;


                    /*
                    |--------------------------------------------------------------------------
                    | SIMPAN JAWABAN
                    |--------------------------------------------------------------------------
                    */

                    JawabanKepribadian::create([

                        'hasil_kepribadian_id' =>
                            $hasil->id,

                        'soal_kepribadian_id' =>
                            $item->id,

                        'jawaban' =>
                            $selected,

                        'teks_jawaban' =>
                            $text,

                        'nilai' =>
                            $score,
                    ]);
                }


                /*
                |--------------------------------------------------------------------------
                | UPDATE HASIL
                |--------------------------------------------------------------------------
                */

                $tidakDijawab =
                    $jumlahSoal -
                    $dijawab;


                $persentase =
                    $maksimal > 0
                        ? round(
                            (
                                $totalSkor /
                                $maksimal
                            ) * 100,
                            2
                        )
                        : 0;


                $hasil->update([

                    'jumlah_dijawab' =>
                        $dijawab,

                    'jumlah_tidak_dijawab' =>
                        $tidakDijawab,

                    'total_skor' =>
                        $totalSkor,

                    'skor_maksimal' =>
                        $maksimal,

                    'persentase' =>
                        $persentase,
                ]);


                return $hasil;
            }
        );


        /*
        |--------------------------------------------------------------------------
        | BERSIHKAN SESSION
        |--------------------------------------------------------------------------
        */

        session()->forget([

            'kepribadian_paket_id',

            'kepribadian_bank_id',

            'kepribadian_soal_ids',

            'kepribadian_jawaban',

            'kepribadian_mulai',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ID HASIL
        |--------------------------------------------------------------------------
        */

        session([
            'kepribadian_hasil' =>
                $hasil->id
        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT HASIL
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'murid.kepribadian.hasil',
                $hasil->id
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN HASIL
    |--------------------------------------------------------------------------
    */

    public function hasil($hasil)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL HASIL + RELASI
        |--------------------------------------------------------------------------
        */

        $data =
            HasilKepribadian::with([
                'bank',
                'paket',
                'jawaban.soal'
            ])
            ->where(
                'id',
                $hasil
            )
            ->where(
                'user_id',
                Auth::id()
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | DATA DASAR
        |--------------------------------------------------------------------------
        */

        $totalSoal =
            (int) $data->total_soal;


        $dijawab =
            (int) $data->jumlah_dijawab;


        $tidakDijawab =
            (int) $data->jumlah_tidak_dijawab;


        $totalSkor =
            (float) $data->total_skor;


        $skorMaksimal =
            (float) $data->skor_maksimal;


        $persentase =
            (float) $data->persentase;


        $rataRata =
            $totalSoal > 0
                ? round(
                    $totalSkor /
                    $totalSoal,
                    2
                )
                : 0;


        /*
        |--------------------------------------------------------------------------
        | KATEGORI NILAI
        |--------------------------------------------------------------------------
        */

        if ($persentase >= 80) {

            $kategori = [

                'label' =>
                    'Sangat Baik',

                'icon' =>
                    'bi-emoji-laughing-fill',

                'description' =>
                    'Hasil menunjukkan tingkat pencapaian yang sangat baik.',
            ];

        } elseif ($persentase >= 70) {

            $kategori = [

                'label' =>
                    'Baik',

                'icon' =>
                    'bi-emoji-smile-fill',

                'description' =>
                    'Hasil menunjukkan tingkat pencapaian yang baik.',
            ];

        } elseif ($persentase >= 60) {

            $kategori = [

                'label' =>
                    'Cukup',

                'icon' =>
                    'bi-emoji-neutral-fill',

                'description' =>
                    'Hasil menunjukkan tingkat pencapaian yang cukup.',
            ];

        } else {

            $kategori = [

                'label' =>
                    'Perlu Latihan',

                'icon' =>
                    'bi-emoji-frown-fill',

                'description' =>
                    'Masih diperlukan latihan untuk meningkatkan hasil.',
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | RINGKASAN JAWABAN
        |--------------------------------------------------------------------------
        |
        | Jawaban Sesuai      = nilai 4 - 5
        | Jawaban Kurang      = nilai 1 - 3
        | Tidak Terjawab      = tidak ada jawaban
        |
        |--------------------------------------------------------------------------
        */

        $jawabanSesuai =
            $data->jawaban
                ->filter(function ($jawaban) {

                    return
                        $jawaban->jawaban !== null
                        &&
                        (float)
                        $jawaban->nilai >= 4;
                })
                ->count();


        $jawabanKurangSesuai =
            $data->jawaban
                ->filter(function ($jawaban) {

                    return
                        $jawaban->jawaban !== null
                        &&
                        (float)
                        $jawaban->nilai > 0
                        &&
                        (float)
                        $jawaban->nilai < 4;
                })
                ->count();


        /*
        |--------------------------------------------------------------------------
        | HITUNG TIDAK TERJAWAB DARI DATA JAWABAN
        |--------------------------------------------------------------------------
        */

        $jumlahJawabanTersimpan =
            $data->jawaban
                ->filter(function ($jawaban) {

                    return
                        $jawaban->jawaban !== null;
                })
                ->count();


        $tidakDijawab =
            max(
                0,
                $totalSoal -
                $jumlahJawabanTersimpan
            );


        /*
        |--------------------------------------------------------------------------
        | PROFIL KEPRIBADIAN
        |--------------------------------------------------------------------------
        |
        | Karena tabel soal saat ini belum memiliki kolom "aspek",
        | soal dibagi menjadi 8 kelompok secara berurutan.
        |
        | Jika paket berisi 120 soal:
        |
        | 1 - 15   Integritas
        | 16 - 30  Tanggung Jawab
        | 31 - 45  Disiplin
        | 46 - 60  Pengendalian Emosi
        | 61 - 75  Kerja Sama
        | 76 - 90  Kepercayaan Diri
        | 91 - 105 Ketahanan Tekanan
        | 106 -120 Adaptasi
        |
        |--------------------------------------------------------------------------
        */

        $daftarAspek = [

            'Integritas',

            'Tanggung Jawab',

            'Disiplin',

            'Pengendalian Emosi',

            'Kerja Sama',

            'Kepercayaan Diri',

            'Ketahanan Tekanan',

            'Adaptasi',
        ];


        $aspekKepribadian = [];


        /*
        |--------------------------------------------------------------------------
        | AMBIL JAWABAN TERURUT
        |--------------------------------------------------------------------------
        */

        $semuaJawaban =
            $data->jawaban
                ->sortBy(function ($jawaban) {

                    return
                        optional(
                            $jawaban->soal
                        )->nomor_soal
                        ?? $jawaban->soal_kepribadian_id;
                })
                ->values();


        /*
        |--------------------------------------------------------------------------
        | BAGI SOAL MENJADI 8 ASPEK
        |--------------------------------------------------------------------------
        */

        $jumlahAspek =
            count($daftarAspek);


        $jumlahData =
            $semuaJawaban->count();


        if ($jumlahData > 0) {

            $ukuranDasar =
                intdiv(
                    $jumlahData,
                    $jumlahAspek
                );


            $sisa =
                $jumlahData %
                $jumlahAspek;


            $offset = 0;


            foreach (
                $daftarAspek
                as $index => $namaAspek
            ) {

                /*
                |--------------------------------------------------------------------------
                | Beberapa kelompok bisa mendapat 1 soal tambahan
                |--------------------------------------------------------------------------
                */

                $jumlahKelompok =
                    $ukuranDasar
                    +
                    (
                        $index < $sisa
                            ? 1
                            : 0
                    );


                $kelompok =
                    $semuaJawaban->slice(
                        $offset,
                        $jumlahKelompok
                    );


                $offset +=
                    $jumlahKelompok;


                /*
                |--------------------------------------------------------------------------
                | HANYA JAWABAN YANG DIISI
                |--------------------------------------------------------------------------
                */

                $kelompokDijawab =
                    $kelompok
                        ->filter(function ($jawaban) {

                            return
                                $jawaban->jawaban !== null
                                &&
                                is_numeric(
                                    $jawaban->nilai
                                );
                        });


                /*
                |--------------------------------------------------------------------------
                | HITUNG NILAI ASPEK
                |--------------------------------------------------------------------------
                */

                if (
                    $kelompokDijawab->count() > 0
                ) {

                    $totalNilai =
                        $kelompokDijawab
                            ->sum(function ($jawaban) {

                                return
                                    (float)
                                    $jawaban->nilai;
                            });


                    $rata =
                        $totalNilai /
                        $kelompokDijawab->count();


                    /*
                    | Nilai soal 1-5
                    | dikonversi menjadi 0-100
                    */

                    $nilaiAspek =
                        round(
                            (
                                $rata / 5
                            ) * 100,
                            2
                        );


                    $nilaiAspek =
                        max(
                            0,
                            min(
                                100,
                                $nilaiAspek
                            )
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | KATEGORI ASPEK
                    |--------------------------------------------------------------------------
                    */

                    if ($nilaiAspek >= 80) {

                        $kategoriAspek =
                            'Sangat Baik';

                    } elseif ($nilaiAspek >= 70) {

                        $kategoriAspek =
                            'Baik';

                    } elseif ($nilaiAspek >= 60) {

                        $kategoriAspek =
                            'Cukup';

                    } else {

                        $kategoriAspek =
                            'Kurang';
                    }


                    $aspekKepribadian[
                        $namaAspek
                    ] = [

                        'nilai' =>
                            $nilaiAspek,

                        'kategori' =>
                            $kategoriAspek,
                    ];

                } else {

                    /*
                    |--------------------------------------------------------------------------
                    | BELUM ADA JAWABAN
                    |--------------------------------------------------------------------------
                    */

                    $aspekKepribadian[
                        $namaAspek
                    ] = [

                        'nilai' =>
                            null,

                        'kategori' =>
                            'Belum Dinilai',
                    ];
                }
            }

        } else {

            /*
            |--------------------------------------------------------------------------
            | JIKA TIDAK ADA DATA
            |--------------------------------------------------------------------------
            */

            foreach (
                $daftarAspek
                as $namaAspek
            ) {

                $aspekKepribadian[
                    $namaAspek
                ] = [

                    'nilai' =>
                        null,

                    'kategori' =>
                        'Belum Dinilai',
                ];
            }
        }


        /*
        |--------------------------------------------------------------------------
        | PENTING:
        | VIEW LAMA MENGGUNAKAN $hasil
        |--------------------------------------------------------------------------
        */

        $hasil =
            $data;


        /*
        |--------------------------------------------------------------------------
        | KIRIM SEMUA DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'murid.kepribadian.hasil',
            compact(

                'data',

                'hasil',

                'persentase',

                'totalSoal',

                'jawabanSesuai',

                'jawabanKurangSesuai',

                'totalSkor',

                'skorMaksimal',

                'dijawab',

                'tidakDijawab',

                'rataRata',

                'kategori',

                'aspekKepribadian'
            )
        );
    }
}