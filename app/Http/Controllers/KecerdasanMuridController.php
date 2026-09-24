<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketKecerdasan;
use App\Models\SoalKecerdasan;
use App\Models\HasilKecerdasan;
use App\Models\JawabanKecerdasan;
use Illuminate\Support\Facades\Schema;

class KecerdasanMuridController extends Controller
{
    public function index()
    {
        $pakets = PaketKecerdasan::where('status', 1)->latest()->get();
        return view('murid.kecerdasan.index', compact('pakets'));
    }

    public function mulai($paketId)
    {
        $paket = PaketKecerdasan::findOrFail($paketId);

        if (method_exists($paket, 'soals') && $paket->soals()->exists()) {
            $soals = $paket->soals;
        } elseif (Schema::hasColumn('soal_kecerdasans', 'paket_kecerdasan_id')) {
            $soals = SoalKecerdasan::where('paket_kecerdasan_id', $paket->id)->get();
        } else {
            $soals = SoalKecerdasan::where('status', 1)->limit($paket->jumlah_soal ?? 30)->get();
        }

        $hasil = HasilKecerdasan::firstOrCreate([
            'user_id' => auth()->id(),
            'paket_kecerdasan_id' => $paket->id,
            'status' => 'sedang_mengerjakan',
        ], [
            'jumlah_dijawab' => 0,
            'nilai' => 0,
            'total_soal' => $soals->count(),
        ]);

        return view('murid.kecerdasan.mulai', compact('paket', 'soals', 'hasil'));
    }

    public function jawab(Request $request, $hasilId)
    {
        $request->validate([
            'soal_id' => 'required',
            'jawaban' => 'required|string|max:5',
        ]);

        $hasil = HasilKecerdasan::findOrFail($hasilId);
        $soal = SoalKecerdasan::findOrFail($request->soal_id);

        $pilihanMurid = strtoupper(trim($request->jawaban));

        // Deteksi kolom kunci jawaban dari berbagai kemungkinan nama kolom database
        $kunci = strtoupper(trim(
            $soal->jawaban_benar ?? 
            $soal->kunci_jawaban ?? 
            $soal->kunci ?? 
            $soal->jawaban ?? ''
        ));

        $isBenar = (!empty($kunci) && $pilihanMurid === $kunci) ? 1 : 0;

        if (class_exists(JawabanKecerdasan::class)) {
            JawabanKecerdasan::updateOrCreate([
                'hasil_kecerdasan_id' => $hasil->id,
                'soal_kecerdasan_id'  => $soal->id,
            ], [
                'jawaban'  => $pilihanMurid,
                'is_benar' => $isBenar,
            ]);
        }

        $jumlahTerjawab = class_exists(JawabanKecerdasan::class)
            ? JawabanKecerdasan::where('hasil_kecerdasan_id', $hasil->id)->count()
            : ($hasil->jumlah_dijawab + 1);

        $hasil->update(['jumlah_dijawab' => $jumlahTerjawab]);

        return response()->json([
            'success' => true,
            'dijawab' => $jumlahTerjawab,
        ]);
    }

    public function selesai(Request $request, $hasilId)
    {
        $hasil = HasilKecerdasan::with('paket')->findOrFail($hasilId);
        $paket = $hasil->paket;

        if (method_exists($paket, 'soals') && $paket->soals()->exists()) {
            $totalSoal = $paket->soals()->count();
            $soals = $paket->soals;
        } else {
            $totalSoal = SoalKecerdasan::where('status', 1)->limit($paket->jumlah_soal ?? 30)->count();
            $soals = SoalKecerdasan::where('status', 1)->limit($paket->jumlah_soal ?? 30)->get();
        }

        $totalBenar = 0;
        if (class_exists(JawabanKecerdasan::class)) {
            $jawabans = JawabanKecerdasan::where('hasil_kecerdasan_id', $hasil->id)->get();
            foreach ($jawabans as $jb) {
                $soalTerkait = $soals->firstWhere('id', $jb->soal_kecerdasan_id);
                if ($soalTerkait) {
                    $kunci = strtoupper(trim(
                        $soalTerkait->jawaban_benar ?? 
                        $soalTerkait->kunci_jawaban ?? 
                        $soalTerkait->kunci ?? 
                        $soalTerkait->jawaban ?? ''
                    ));

                    if (!empty($kunci) && strtoupper(trim($jb->jawaban)) === $kunci) {
                        $totalBenar++;
                    }
                }
            }
        }

        $totalSoalFinal = max($totalSoal, 1);
        $skorAkhir = round(($totalBenar / $totalSoalFinal) * 100, 1);

        $hasil->update([
            'status'       => 'selesai',
            'total_soal'   => $totalSoalFinal,
            'jumlah_benar' => $totalBenar,
            'jumlah_salah' => $totalSoalFinal - $totalBenar,
            'nilai'        => $skorAkhir,
        ]);

        return redirect()->route('murid.kecerdasan.hasil', $hasil->id);
    }

    public function hasil($hasilId)
    {
        $hasil = HasilKecerdasan::with('paket')->findOrFail($hasilId);

        $detailJawaban = [];
        if (class_exists(JawabanKecerdasan::class)) {
            $detailJawaban = JawabanKecerdasan::where('hasil_kecerdasan_id', $hasil->id)->get();
        }

        $paket = $hasil->paket;
        $soals = method_exists($paket, 'soals') && $paket->soals()->exists()
            ? $paket->soals
            : SoalKecerdasan::where('status', 1)->limit($paket->jumlah_soal ?? 30)->get();

        return view('murid.kecerdasan.hasil', compact('hasil', 'paket', 'soals', 'detailJawaban'));
    }
}