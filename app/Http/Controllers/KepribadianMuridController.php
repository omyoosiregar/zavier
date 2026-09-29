<?php

namespace App\Http\Controllers;

use App\Models\PaketSoal;
use App\Models\HasilKepribadian;
use App\Models\JawabanKepribadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

    public function mulai($paketId)
    {
        // 1. Coba cari di PaketSoal dulu
        $paket = PaketSoal::query()
            ->where('id', $paketId)
            ->where('jenis_tes', 'Kepribadian')
            ->first();

        $soal = collect();
        $bankId = null;

        if ($paket && method_exists($paket, 'soalKepribadian')) {
            $soal = $paket->soalKepribadian()
                ->where('soal_kepribadian.status', true)
                ->get();
            $bankId = optional($soal->first())->bank_kepribadian_id;
        }

        // 2. Jika tidak ditemukan atau soalnya kosong, cari sebagai Bank Kepribadian langsung
        if ($soal->isEmpty()) {
            $bank = null;
            if (Schema::hasTable('bank_kepribadian')) {
                $bank = DB::table('bank_kepribadian')->where('id', $paketId)->first();
            }

            if ($bank) {
                $bankId = $bank->id;

                // Cari soal di berbagai tabel relasi yang umum digunakan
                if (Schema::hasTable('soal_kepribadian')) {
                    $soal = DB::table('soal_kepribadian')
                        ->where('bank_kepribadian_id', $bankId)
                        ->orWhere('bank_id', $bankId)
                        ->get();
                } elseif (Schema::hasTable('soal_kepribadians')) {
                    $soal = DB::table('soal_kepribadians')
                        ->where('bank_kepribadian_id', $bankId)
                        ->orWhere('bank_id', $bankId)
                        ->orWhere('paket_id', $bankId)
                        ->get();
                }

                // Buat mock objek paket agar view tidak error
                $paket = (object) [
                    'id'          => $bank->id,
                    'nama_paket'  => $bank->nama_bank ?? $bank->nama_paket ?? 'Paket Kepribadian',
                    'durasi'      => $bank->durasi ?? 60,
                    'keterangan'  => $bank->deskripsi ?? '',
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | CEK SOAL
        |--------------------------------------------------------------------------
        */

        if ($soal->isEmpty()) {
            return redirect()
                ->route('murid.paket-soal', ['tab' => 'kepribadian'])
                ->with(
                    'error',
                    'Paket atau Bank Kepribadian ini belum memiliki butir soal aktif.'
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
        | WAKTU MULAI & SIMPAN SESSION
        |--------------------------------------------------------------------------
        */

        $startedAt = now();

        session([
            'kepribadian_paket_id' => $paket->id,
            'kepribadian_bank_id'  => $bankId ?? $paket->id,
            'kepribadian_soal_ids' => $soal->pluck('id')->all(),
            'kepribadian_mulai'    => $startedAt->timestamp,
        ]);

        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN UJIAN
        |--------------------------------------------------------------------------
        */

        return view(
            'murid.kepribadian.ujian',
            [
                'paket'       => $paket,
                'soal'        => $soal->values(),
                'durasiMenit' => (int) ($paket->durasi ?? 60),
                'startedAt'   => $startedAt->timestamp,
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
        $paketId
    ) {
        /*
        |--------------------------------------------------------------------------
        | AMBIL PAKET & SOAL
        |--------------------------------------------------------------------------
        */

        $paket = PaketSoal::query()
            ->where('id', $paketId)
            ->where('jenis_tes', 'Kepribadian')
            ->first();

        $soal = collect();
        $bankId = session('kepribadian_bank_id');

        if ($paket && method_exists($paket, 'soalKepribadian')) {
            $soal = $paket->soalKepribadian()
                ->where('soal_kepribadian.status', true)
                ->get();
        }

        if ($soal->isEmpty() && $bankId) {
            if (Schema::hasTable('soal_kepribadian')) {
                $soal = DB::table('soal_kepribadian')
                    ->where('bank_kepribadian_id', $bankId)
                    ->orWhere('bank_id', $bankId)
                    ->get();
            } elseif (Schema::hasTable('soal_kepribadians')) {
                $soal = DB::table('soal_kepribadians')
                    ->where('bank_kepribadian_id', $bankId)
                    ->orWhere('bank_id', $bankId)
                    ->get();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL SOAL SESUAI SESSION
        |--------------------------------------------------------------------------
        */

        $soalIds = session('kepribadian_soal_ids', []);

        $allowedIds = collect($soalIds)
            ->map(function ($id) {
                return (int) $id;
            })
            ->all();

        $soal = $soal
            ->filter(function ($item) use ($allowedIds) {
                return in_array((int) $item->id, $allowedIds, true);
            })
            ->values();

        if ($soal->isEmpty()) {
            return redirect()
                ->route('murid.paket-soal', ['tab' => 'kepribadian'])
                ->with('error', 'Soal paket tidak ditemukan.');
        }

        if (session('kepribadian_hasil')) {
            return redirect()->route(
                'murid.kepribadian.hasil',
                session('kepribadian_hasil')
            );
        }

        $jawaban = $request->input('jawaban', []);
        if (!is_array($jawaban)) {
            $jawaban = [];
        }

        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI PENYIMPANAN HASIL
        |--------------------------------------------------------------------------
        */

        $hasil = DB::transaction(function () use ($soal, $jawaban, $paketId, $bankId) {
            $jumlahSoal = $soal->count();
            $maksimal = $jumlahSoal * 5;

            $hasil = HasilKepribadian::create([
                'user_id'              => Auth::id(),
                'bank_kepribadian_id'  => $bankId,
                'paket_soal_id'        => $paketId,
                'total_soal'           => $jumlahSoal,
                'jumlah_dijawab'       => 0,
                'jumlah_tidak_dijawab' => $jumlahSoal,
                'total_skor'           => 0,
                'skor_maksimal'        => $maksimal,
                'persentase'           => 0,
            ]);

            $dijawab = 0;
            $totalSkor = 0;

            foreach ($soal as $item) {
                $selected = strtoupper(trim((string) ($jawaban[$item->id] ?? '')));

                if (!in_array($selected, ['A', 'B', 'C', 'D', 'E'], true)) {
                    $selected = null;
                }

                $texts = [
                    'A' => $item->pilihan_a ?? null,
                    'B' => $item->pilihan_b ?? null,
                    'C' => $item->pilihan_c ?? null,
                    'D' => $item->pilihan_d ?? null,
                    'E' => $item->pilihan_e ?? null,
                ];

                $text = $selected ? ($texts[$selected] ?? null) : null;
                $key = strtoupper(trim((string) ($item->kunci_jawaban ?? '')));

                $score = 0;

                if ($selected !== null) {
                    $dijawab++;

                    $normal = function ($value) {
                        $value = strtolower(trim((string) $value));
                        $value = preg_replace('/^[a-e]\s*[\.\)]\s*/i', '', $value);
                        return trim(preg_replace('/\s+/u', ' ', $value));
                    };

                    $answerNormal = $normal($text);
                    $keyText = $texts[$key] ?? $key;
                    $keyNormal = $normal($keyText);

                    $positive = [
                        'sangat setuju'       => 5,
                        'setuju'              => 4,
                        'ragu-ragu'           => 3,
                        'ragu ragu'           => 3,
                        'ragu'                => 3,
                        'tidak setuju'        => 2,
                        'sangat tidak setuju' => 1,
                    ];

                    $negative = [
                        'sangat setuju'       => 1,
                        'setuju'              => 2,
                        'ragu-ragu'           => 3,
                        'ragu ragu'           => 3,
                        'ragu'                => 3,
                        'tidak setuju'        => 4,
                        'sangat tidak setuju' => 5,
                    ];

                    if ($keyNormal === 'sangat setuju') {
                        $score = $positive[$answerNormal] ?? 0;
                    } elseif ($keyNormal === 'sangat tidak setuju') {
                        $score = $negative[$answerNormal] ?? 0;
                    } else {
                        $score = ($selected === $key) ? 5 : 0;
                    }
                }

                $totalSkor += $score;

                JawabanKepribadian::create([
                    'hasil_kepribadian_id' => $hasil->id,
                    'soal_kepribadian_id'  => $item->id,
                    'jawaban'              => $selected,
                    'teks_jawaban'         => $text,
                    'nilai'                => $score,
                ]);
            }

            $tidakDijawab = $jumlahSoal - $dijawab;
            $persentase = $maksimal > 0 ? round(($totalSkor / $maksimal) * 100, 2) : 0;

            $hasil->update([
                'jumlah_dijawab'       => $dijawab,
                'jumlah_tidak_dijawab' => $tidakDijawab,
                'total_skor'           => $totalSkor,
                'skor_maksimal'        => $maksimal,
                'persentase'           => $persentase,
            ]);

            return $hasil;
        });

        session()->forget([
            'kepribadian_paket_id',
            'kepribadian_bank_id',
            'kepribadian_soal_ids',
            'kepribadian_jawaban',
            'kepribadian_mulai',
        ]);

        session(['kepribadian_hasil' => $hasil->id]);

        return redirect()->route('murid.kepribadian.hasil', $hasil->id);
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN HASIL
    |--------------------------------------------------------------------------
    */

    public function hasil($hasil)
    {
        $data = HasilKepribadian::with([
            'bank',
            'paket',
            'jawaban.soal'
        ])
            ->where('id', $hasil)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $totalSoal    = (int) $data->total_soal;
        $dijawab      = (int) $data->jumlah_dijawab;
        $tidakDijawab = (int) $data->jumlah_tidak_dijawab;
        $totalSkor    = (float) $data->total_skor;
        $skorMaksimal = (float) $data->skor_maksimal;
        $persentase   = (float) $data->persentase;
        $rataRata     = $totalSoal > 0 ? round($totalSkor / $totalSoal, 2) : 0;

        if ($persentase >= 80) {
            $kategori = [
                'label'       => 'Sangat Baik',
                'icon'        => 'bi-emoji-laughing-fill',
                'description' => 'Hasil menunjukkan tingkat pencapaian yang sangat baik.',
            ];
        } elseif ($persentase >= 70) {
            $kategori = [
                'label'       => 'Baik',
                'icon'        => 'bi-emoji-smile-fill',
                'description' => 'Hasil menunjukkan tingkat pencapaian yang baik.',
            ];
        } elseif ($persentase >= 60) {
            $kategori = [
                'label'       => 'Cukup',
                'icon'        => 'bi-emoji-neutral-fill',
                'description' => 'Hasil menunjukkan tingkat pencapaian yang cukup.',
            ];
        } else {
            $kategori = [
                'label'       => 'Perlu Latihan',
                'icon'        => 'bi-emoji-frown-fill',
                'description' => 'Masih diperlukan latihan untuk meningkatkan hasil.',
            ];
        }

        $jawabanSesuai = $data->jawaban
            ->filter(function ($j) {
                return $j->jawaban !== null && (float) $j->nilai >= 4;
            })
            ->count();

        $jawabanKurangSesuai = $data->jawaban
            ->filter(function ($j) {
                return $j->jawaban !== null && (float) $j->nilai > 0 && (float) $j->nilai < 4;
            })
            ->count();

        $jumlahJawabanTersimpan = $data->jawaban
            ->filter(function ($j) {
                return $j->jawaban !== null;
            })
            ->count();

        $tidakDijawab = max(0, $totalSoal - $jumlahJawabanTersimpan);

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

        $semuaJawaban = $data->jawaban
            ->sortBy(function ($j) {
                return optional($j->soal)->nomor_soal ?? $j->soal_kepribadian_id;
            })
            ->values();

        $jumlahAspek = count($daftarAspek);
        $jumlahData = $semuaJawaban->count();

        if ($jumlahData > 0) {
            $ukuranDasar = intdiv($jumlahData, $jumlahAspek);
            $sisa = $jumlahData % $jumlahAspek;
            $offset = 0;

            foreach ($daftarAspek as $index => $namaAspek) {
                $jumlahKelompok = $ukuranDasar + ($index < $sisa ? 1 : 0);
                $kelompok = $semuaJawaban->slice($offset, $jumlahKelompok);
                $offset += $jumlahKelompok;

                $kelompokDijawab = $kelompok->filter(function ($j) {
                    return $j->jawaban !== null && is_numeric($j->nilai);
                });

                if ($kelompokDijawab->count() > 0) {
                    $totalNilai = $kelompokDijawab->sum(function ($j) {
                        return (float) $j->nilai;
                    });

                    $rata = $totalNilai / $kelompokDijawab->count();
                    $nilaiAspek = round(($rata / 5) * 100, 2);
                    $nilaiAspek = max(0, min(100, $nilaiAspek));

                    if ($nilaiAspek >= 80) {
                        $kategoriAspek = 'Sangat Baik';
                    } elseif ($nilaiAspek >= 70) {
                        $kategoriAspek = 'Baik';
                    } elseif ($nilaiAspek >= 60) {
                        $kategoriAspek = 'Cukup';
                    } else {
                        $kategoriAspek = 'Kurang';
                    }

                    $aspekKepribadian[$namaAspek] = [
                        'nilai'    => $nilaiAspek,
                        'kategori' => $kategoriAspek,
                    ];
                } else {
                    $aspekKepribadian[$namaAspek] = [
                        'nilai'    => null,
                        'kategori' => 'Belum Dinilai',
                    ];
                }
            }
        } else {
            foreach ($daftarAspek as $namaAspek) {
                $aspekKepribadian[$namaAspek] = [
                    'nilai'    => null,
                    'kategori' => 'Belum Dinilai',
                ];
            }
        }

        $hasil = $data;

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