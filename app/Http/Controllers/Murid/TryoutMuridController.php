<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\PaketTryout;
use App\Models\HasilTryout;
use App\Models\PaketKecerdasan;
use App\Models\PaketSoal;

class TryoutMuridController extends Controller
{
    /**
     * 1. Mulai Ujian Tryout (Inisialisasi Sesi)
     */
    public function mulai(PaketTryout $tryout)
    {
        $userId = Auth::id();

        $hasil = HasilTryout::firstOrCreate(
            [
                'user_id'         => $userId,
                'paket_tryout_id' => $tryout->id,
                'tahap_sekarang'  => 'kecerdasan',
            ],
            [
                'nilai_kecerdasan'  => 0,
                'nilai_kepribadian' => 0,
                'nilai_kecermatan'  => 0,
                'nilai_akhir'       => 0,
                'status_kelulusan'  => 'BELUM SELESAI',
            ]
        );

        return $this->arahkanTahap($hasil);
    }

    /**
     * 2. Traffic Controller Sesi Ujian (Query Kolom Sesuai Skema Database)
     */
    public function arahkanTahap(HasilTryout $hasil)
    {
        if ($hasil->user_id !== Auth::id()) {
            abort(403, 'Akses sesi ujian tidak sah.');
        }

        $tryout = PaketTryout::findOrFail($hasil->paket_tryout_id);

        switch ($hasil->tahap_sekarang) {
            // ==========================================
            // TAHAP 1: SUBTES KECERDASAN
            // ==========================================
            case 'kecerdasan':
                $paketKecId = $tryout->paket_kecerdasan_id;
                $soals = collect();
                $durasiMenit = (int) ($tryout->durasi_kecerdasan ?? 90);

                if ($paketKecId && class_exists(PaketKecerdasan::class)) {
                    $paketKec = PaketKecerdasan::with('soals')->find($paketKecId);
                    if ($paketKec) {
                        $soals = $paketKec->soals ?? collect();
                        if (empty($tryout->durasi_kecerdasan) && !empty($paketKec->durasi)) {
                            $durasiMenit = (int) $paketKec->durasi;
                        }
                    }
                }

                if ($soals->isEmpty() && Schema::hasTable('soal_kecerdasans')) {
                    $queryKec = DB::table('soal_kecerdasans');
                    if (Schema::hasColumn('soal_kecerdasans', 'paket_kecerdasan_id')) {
                        $queryKec->where('paket_kecerdasan_id', $paketKecId);
                    } elseif (Schema::hasColumn('soal_kecerdasans', 'paket_id')) {
                        $queryKec->where('paket_id', $paketKecId);
                    }
                    $soals = $queryKec->get();
                }

                return view('murid.tryout.subtes_kecerdasan', compact('tryout', 'hasil', 'soals', 'durasiMenit'));

            // ==========================================
            // JEDA 1 (Kecerdasan -> Kepribadian)
            // ==========================================
            case 'jeda_1':
                if (now()->greaterThanOrEqualTo($hasil->jeda_selesai_pada)) {
                    $hasil->update(['tahap_sekarang' => 'kepribadian']);
                    return redirect()->route('murid.tryout.lanjut', $hasil->id);
                }
                return view('murid.tryout.jeda', compact('tryout', 'hasil'));

            // ==========================================
            // TAHAP 2: SUBTES KEPRIBADIAN (FIX JOIN PIVOT & RELASI)
            // ==========================================
            case 'kepribadian':
                $paketKepId = $tryout->paket_kepribadian_id;
                $soalsKepribadian = collect();
                $durasiMenit = (int) ($tryout->durasi_kepribadian ?? 60);

                // 1. Ambil dari pivot tabel paket_kepribadian_soal (hanya gunakan kolom paket_soal_id)
                if (Schema::hasTable('paket_kepribadian_soal') && Schema::hasTable('soal_kepribadian')) {
                    $queryPivot = DB::table('soal_kepribadian')
                        ->join('paket_kepribadian_soal', 'soal_kepribadian.id', '=', 'paket_kepribadian_soal.soal_kepribadian_id')
                        ->where('paket_kepribadian_soal.paket_soal_id', $paketKepId);

                    if (Schema::hasColumn('paket_kepribadian_soal', 'nomor_urut')) {
                        $queryPivot->orderBy('paket_kepribadian_soal.nomor_urut', 'asc');
                    }

                    $soalsKepribadian = $queryPivot->select('soal_kepribadian.*')->get();
                }

                // 2. Cek melalui Model PaketSoal
                if ($soalsKepribadian->isEmpty() && class_exists(PaketSoal::class)) {
                    $paketModel = PaketSoal::find($paketKepId);
                    if ($paketModel) {
                        if (method_exists($paketModel, 'soalKepribadian')) {
                            $soalsKepribadian = $paketModel->soalKepribadian()->get();
                        } elseif (method_exists($paketModel, 'soals')) {
                            $soalsKepribadian = $paketModel->soals()->get();
                        }
                    }
                }

                // 3. Cek langsung di tabel soal_kepribadian berdasarkan kolom yang tersedia
                if ($soalsKepribadian->isEmpty() && Schema::hasTable('soal_kepribadian')) {
                    $queryRaw = DB::table('soal_kepribadian');
                    if (Schema::hasColumn('soal_kepribadian', 'paket_soal_id')) {
                        $queryRaw->where('paket_soal_id', $paketKepId);
                    } elseif (Schema::hasColumn('soal_kepribadian', 'bank_kepribadian_id')) {
                        $queryRaw->where('bank_kepribadian_id', $paketKepId);
                    } elseif (Schema::hasColumn('soal_kepribadian', 'bank_id')) {
                        $queryRaw->where('bank_id', $paketKepId);
                    }
                    $soalsKepribadian = $queryRaw->get();
                }

                return view('murid.tryout.subtes_kepribadian', compact('tryout', 'hasil', 'soalsKepribadian', 'durasiMenit'));

            // ==========================================
            // JEDA 2 (Kepribadian -> Kecermatan)
            // ==========================================
            case 'jeda_2':
                if (now()->greaterThanOrEqualTo($hasil->jeda_selesai_pada)) {
                    $hasil->update(['tahap_sekarang' => 'kecermatan']);
                    return redirect()->route('murid.tryout.lanjut', $hasil->id);
                }
                return view('murid.tryout.jeda', compact('tryout', 'hasil'));

            // ==========================================
            // TAHAP 3: SUBTES KECERMATAN
            // ==========================================
            case 'kecermatan':
                $paketKcmId = $tryout->paket_kecermatan_id;
                $durasiDetik = 60;
                $kolomList = collect();

                if ($paketKcmId && class_exists(PaketSoal::class)) {
                    $paketKcm = PaketSoal::find($paketKcmId);
                    if ($paketKcm) {
                        $durasiDetik = (int) ($paketKcm->durasi_per_kolom 
                                            ?? ($paketKcm->durasi ? $paketKcm->durasi * 60 : 60));

                        if (method_exists($paketKcm, 'soals')) {
                            $kolomList = $paketKcm->soals()->get();
                        }
                    }
                }

                if ($kolomList->isEmpty() && Schema::hasTable('soals')) {
                    $kolomList = DB::table('soals')->where('paket_soal_id', $paketKcmId)->get();
                }

                return view('murid.tryout.subtes_kecermatan', compact('tryout', 'hasil', 'durasiDetik', 'kolomList'));

            // ==========================================
            // SELESAI
            // ==========================================
            case 'selesai':
                return redirect()->route('murid.tryout.hasil', $hasil->id);

            default:
                return redirect()->route('murid.paket-soal')->with('error', 'Tahap ujian tidak valid.');
        }
    }

    /**
     * 3. Lewati Jeda Istirahat (Skip Jeda)
     */
    public function skipJeda(HasilTryout $hasil)
    {
        if ($hasil->user_id !== Auth::id()) {
            abort(403, 'Akses sesi ujian tidak sah.');
        }

        if ($hasil->tahap_sekarang === 'jeda_1') {
            $hasil->update([
                'tahap_sekarang'    => 'kepribadian',
                'jeda_selesai_pada' => now(),
            ]);
        } elseif ($hasil->tahap_sekarang === 'jeda_2') {
            $hasil->update([
                'tahap_sekarang'    => 'kecermatan',
                'jeda_selesai_pada' => now(),
            ]);
        }

        return redirect()->route('murid.tryout.lanjut', $hasil->id);
    }

    /**
     * 4. Submit Subtes 1: Kecerdasan
     */
    public function submitKecerdasan(Request $request, HasilTryout $hasil)
    {
        $tryout = $hasil->paketTryout;
        $soals = collect();

        if ($tryout && $tryout->paket_kecerdasan_id && class_exists(PaketKecerdasan::class)) {
            $paketKec = PaketKecerdasan::with('soals')->find($tryout->paket_kecerdasan_id);
            $soals = $paketKec ? ($paketKec->soals ?? collect()) : collect();
        }

        $totalSoal = max($soals->count(), 1);
        $benar = 0;

        if ($request->has('jawaban')) {
            foreach ($request->jawaban as $soalId => $jawabanMurid) {
                $soal = $soals->firstWhere('id', $soalId);
                if ($soal) {
                    $kunci = strtoupper(trim($soal->jawaban_benar ?? $soal->kunci_jawaban ?? $soal->kunci ?? ''));
                    if (strtoupper(trim($jawabanMurid)) === $kunci) {
                        $benar++;
                    }
                }
            }
        }

        $nilaiKecerdasan = round(($benar / $totalSoal) * 100, 1);
        $menitJeda = $tryout->jeda_menit ?? 5;
        $waktuJedaSelesai = now()->addMinutes($menitJeda);

        $hasil->update([
            'nilai_kecerdasan'  => $nilaiKecerdasan,
            'tahap_sekarang'    => 'jeda_1',
            'jeda_selesai_pada' => $waktuJedaSelesai,
        ]);

        return redirect()->route('murid.tryout.lanjut', $hasil->id);
    }

    /**
     * 5. Submit Subtes 2: Kepribadian
     */
    public function submitKepribadian(Request $request, HasilTryout $hasil)
    {
        $jawabanKep = $request->input('jawaban_kepribadian', []);
        $skorTotal = 0;
        $bobot = ['A' => 4, 'B' => 3, 'C' => 2, 'D' => 1];

        if (!empty($jawabanKep)) {
            foreach ($jawabanKep as $jawab) {
                $skorTotal += $bobot[$jawab] ?? 2;
            }
            $maxSkor = count($jawabanKep) * 4;
            $nilaiKepribadian = round(($skorTotal / max($maxSkor, 1)) * 100, 1);
        } else {
            $nilaiKepribadian = (float) $request->input('nilai_kepribadian', 72);
        }

        $menitJeda = $hasil->paketTryout->jeda_menit ?? 5;
        $waktuJedaSelesai = now()->addMinutes($menitJeda);

        $hasil->update([
            'nilai_kepribadian' => $nilaiKepribadian,
            'tahap_sekarang'    => 'jeda_2',
            'jeda_selesai_pada' => $waktuJedaSelesai,
        ]);

        return redirect()->route('murid.tryout.lanjut', $hasil->id);
    }

    /**
     * 6. Submit Subtes 3: Kecermatan & Perhitungan Bobot POLRI
     */
    public function submitKecermatan(Request $request, HasilTryout $hasil)
    {
        $nilaiKecermatan = (float) $request->input('nilai_kecermatan', 75);

        $skorKecerdasan  = (float) $hasil->nilai_kecerdasan;
        $skorKepribadian = (float) $hasil->nilai_kepribadian;

        $nilaiAkhir = round(($skorKecerdasan * 0.33) + ($skorKepribadian * 0.33) + ($nilaiKecermatan * 0.34), 1);
        $statusKelulusan = ($nilaiAkhir >= 61) ? 'MEMENUHI SYARAT (MS)' : 'TIDAK MEMENUHI SYARAT (TMS)';

        $hasil->update([
            'nilai_kecermatan'  => $nilaiKecermatan,
            'nilai_akhir'       => $nilaiAkhir,
            'status_kelulusan'  => $statusKelulusan,
            'tahap_sekarang'    => 'selesai',
        ]);

        return redirect()->route('murid.tryout.hasil', $hasil->id);
    }

    /**
     * 7. Halaman Hasil Akhir
     */
    public function hasil(HasilTryout $hasil)
    {
        if ($hasil->user_id !== Auth::id()) {
            abort(403, 'Akses hasil tryout tidak diizinkan.');
        }

        return view('murid.tryout.hasil', compact('hasil'));
    }
}