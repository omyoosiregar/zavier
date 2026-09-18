<?php

namespace App\Http\Controllers;

use App\Models\BankKepribadian;
use App\Models\SoalKepribadian;
use App\Models\PaketSoal;
use App\Models\HasilKepribadian;
use App\Models\JawabanKepribadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KepribadianMuridController extends Controller
{
    public function index()
    {
        $pakets = PaketSoal::query()
            ->where('jenis_tes', 'Kepribadian')
            ->where('status', true)
            ->whereHas('soalKepribadian', fn ($q) => $q->where('status', true))
            ->withCount('soalKepribadian')
            ->latest('id')
            ->get();

        return view('murid.kepribadian.index', compact('pakets'));
    }

    public function mulai($paket)
    {
        $paket = PaketSoal::query()
            ->where('id', $paket)
            ->where('jenis_tes', 'Kepribadian')
            ->where('status', true)
            ->with(['soalKepribadian' => function ($q) {
                $q->where('soal_kepribadian.status', true)
                  ->orderBy('paket_kepribadian_soal.nomor_urut');
            }])
            ->firstOrFail();

        $soal = $paket->soalKepribadian->values();

        if ($soal->isEmpty()) {
            return redirect()->route('murid.kepribadian.index')
                ->with('error', 'Paket ini belum memiliki soal aktif.');
        }

        // Hapus sesi ujian lama agar paket baru selalu bersih.
        session()->forget([
            'kepribadian_paket_id',
            'kepribadian_bank_id',
            'kepribadian_soal_ids',
            'kepribadian_jawaban',
            'kepribadian_mulai',
            'kepribadian_hasil',
        ]);

        $startedAt = now();
        session([
            'kepribadian_paket_id' => $paket->id,
            'kepribadian_bank_id' => optional($soal->first())->bank_kepribadian_id,
            'kepribadian_soal_ids' => $soal->pluck('id')->all(),
            'kepribadian_mulai' => $startedAt->timestamp,
        ]);

        return view('murid.kepribadian.ujian', [
            'paket' => $paket,
            'soal' => $soal,
            'durasiMenit' => (int) $paket->durasi,
            'startedAt' => $startedAt->timestamp,
        ]);
    }

    public function selesai(Request $request, $paket)
    {
        $paket = PaketSoal::query()
            ->where('id', $paket)
            ->where('jenis_tes', 'Kepribadian')
            ->with(['soalKepribadian' => function ($q) {
                $q->where('soal_kepribadian.status', true)
                  ->orderBy('paket_kepribadian_soal.nomor_urut');
            }])
            ->firstOrFail();

        // Hanya boleh submit paket yang benar-benar sedang dikerjakan.
        abort_unless((int) session('kepribadian_paket_id') === (int) $paket->id, 403, 'Sesi paket ujian tidak cocok.');

        $soal = $paket->soalKepribadian->values();
        $soalIds = session('kepribadian_soal_ids', []);
        $allowedIds = collect($soalIds)->map(fn ($id) => (int) $id)->all();
        $soal = $soal->filter(fn ($item) => in_array((int) $item->id, $allowedIds, true))->values();

        if ($soal->isEmpty()) {
            return redirect()->route('murid.kepribadian.index')->with('error', 'Soal paket tidak ditemukan.');
        }

        // Tolak submit ulang dari sesi yang sama.
        if (session('kepribadian_hasil')) {
            return redirect()->route('murid.kepribadian.hasil', session('kepribadian_hasil'));
        }

        $jawaban = $request->input('jawaban', []);
        $jawaban = is_array($jawaban) ? $jawaban : [];
        $started = (int) session('kepribadian_mulai', now()->timestamp);
        $expired = now()->timestamp >= ($started + ((int) $paket->durasi * 60));

        $hasil = DB::transaction(function () use ($soal, $jawaban, $paket, $expired) {
            $bankId = optional($soal->first())->bank_kepribadian_id;
            $hasil = HasilKepribadian::create([
                'user_id' => Auth::id(),
                'bank_kepribadian_id' => $bankId,
                'paket_soal_id' => $paket->id,
                'total_soal' => $soal->count(),
                'jumlah_dijawab' => 0,
                'jumlah_tidak_dijawab' => $soal->count(),
                'total_skor' => 0,
                'skor_maksimal' => $soal->count() * 5,
                'persentase' => 0,
            ]);

            $dijawab = 0; $total = 0; $maks = $soal->count() * 5;
            foreach ($soal as $item) {
                $selected = strtoupper(trim((string) ($jawaban[$item->id] ?? '')));
                $selected = in_array($selected, ['A','B','C','D','E'], true) ? $selected : null;
                $texts = ['A'=>$item->pilihan_a,'B'=>$item->pilihan_b,'C'=>$item->pilihan_c,'D'=>$item->pilihan_d,'E'=>$item->pilihan_e];
                $text = $selected ? ($texts[$selected] ?? null) : null;
                $key = strtoupper(trim((string) $item->kunci_jawaban));
                $score = 0;

                if ($selected !== null) {
                    $dijawab++;
                    $normal = function ($v) {
                        $v = strtolower(trim((string) $v));
                        $v = preg_replace('/^[a-e]\s*[\.\)]\s*/i', '', $v);
                        return trim(preg_replace('/\s+/u', ' ', $v));
                    };
                    $answerNormal = $normal($text);
                    $keyText = $texts[$key] ?? $key;
                    $keyNormal = $normal($keyText);
                    $positive = ['sangat setuju'=>5,'setuju'=>4,'ragu-ragu'=>3,'ragu ragu'=>3,'ragu'=>3,'tidak setuju'=>2,'sangat tidak setuju'=>1];
                    $negative = ['sangat setuju'=>1,'setuju'=>2,'ragu-ragu'=>3,'ragu ragu'=>3,'ragu'=>3,'tidak setuju'=>4,'sangat tidak setuju'=>5];
                    if ($keyNormal === 'sangat setuju') $score = $positive[$answerNormal] ?? 0;
                    elseif ($keyNormal === 'sangat tidak setuju') $score = $negative[$answerNormal] ?? 0;
                    else $score = ($selected === $key) ? 5 : 0;
                }
                $total += $score;
                JawabanKepribadian::create([
                    'hasil_kepribadian_id' => $hasil->id,
                    'soal_kepribadian_id' => $item->id,
                    'jawaban' => $selected,
                    'teks_jawaban' => $text,
                    'nilai' => $score,
                ]);
            }

            $hasil->update([
                'jumlah_dijawab' => $dijawab,
                'jumlah_tidak_dijawab' => $soal->count() - $dijawab,
                'total_skor' => $total,
                'skor_maksimal' => $maks,
                'persentase' => $maks > 0 ? round(($total / $maks) * 100, 2) : 0,
            ]);
            return $hasil;
        });

        session()->forget(['kepribadian_paket_id','kepribadian_bank_id','kepribadian_soal_ids','kepribadian_jawaban','kepribadian_mulai']);
        session(['kepribadian_hasil' => $hasil->id]);

        return redirect()->route('murid.kepribadian.hasil', $hasil->id);
    }

    public function hasil($hasil)
    {
        $data = HasilKepribadian::with(['bank','paket','jawaban.soal'])
            ->where('id', $hasil)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $totalSoal = (int) $data->total_soal;
        $dijawab = (int) $data->jumlah_dijawab;
        $tidakDijawab = (int) $data->jumlah_tidak_dijawab;
        $totalSkor = (float) $data->total_skor;
        $skorMaksimal = (float) $data->skor_maksimal;
        $persentase = (float) $data->persentase;
        $rataRata = $totalSoal > 0 ? round($totalSkor / $totalSoal, 2) : 0;

        if ($persentase >= 80) $kategori = ['label'=>'Sangat Baik','icon'=>'bi-emoji-laughing-fill','description'=>'Hasil menunjukkan tingkat pencapaian yang sangat baik.'];
        elseif ($persentase >= 70) $kategori = ['label'=>'Baik','icon'=>'bi-emoji-smile-fill','description'=>'Hasil menunjukkan tingkat pencapaian yang baik.'];
        elseif ($persentase >= 60) $kategori = ['label'=>'Cukup','icon'=>'bi-emoji-neutral-fill','description'=>'Hasil menunjukkan tingkat pencapaian yang cukup.'];
        else $kategori = ['label'=>'Perlu Latihan','icon'=>'bi-emoji-frown-fill','description'=>'Masih diperlukan latihan untuk meningkatkan hasil.'];

        $totalBenar = $data->jawaban->filter(fn ($item) => (float) ($item->nilai ?? 0) > 0)->count();
        return view('murid.kepribadian.hasil', compact('data','persentase','totalSoal','totalBenar','totalSkor','skorMaksimal','dijawab','tidakDijawab','rataRata','kategori'));
    }
}
