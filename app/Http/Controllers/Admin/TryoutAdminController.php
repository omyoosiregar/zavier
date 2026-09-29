<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketTryout;
use App\Models\PaketKecerdasan;
use App\Models\PaketSoal;
use App\Models\HasilTryout;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TryoutAdminController extends Controller
{
    /**
     * Tampilkan Daftar Paket Tryout
     */
    public function index()
    {
        $tryouts = PaketTryout::latest()->paginate(10);
        return view('admin.tryout.index', compact('tryouts'));
    }

    /**
     * Form Buat Paket Tryout Baru
     * Mengambil seluruh paket ujian yang sudah dibuat agar muncul di dropdown.
     */
    public function create()
    {
        // ==========================================
        // 1. AMBIL PAKET SOAL KECERDASAN
        // ==========================================
        $paketKecerdasans = collect();
        if (class_exists(PaketKecerdasan::class)) {
            $paketKecerdasans = PaketKecerdasan::all();
        } elseif (Schema::hasTable('paket_kecerdasans')) {
            $paketKecerdasans = DB::table('paket_kecerdasans')->get();
        }

        // Jika kosong, cari di paket_soals bertipe kecerdasan
        if ($paketKecerdasans->isEmpty() && Schema::hasTable('paket_soals')) {
            $paketKecerdasans = DB::table('paket_soals')
                ->where('tipe', 'like', '%kecerdasan%')
                ->orWhere('kategori', 'like', '%kecerdasan%')
                ->orWhere('nama_paket', 'like', '%kecerdasan%')
                ->orWhere('judul', 'like', '%kecerdasan%')
                ->get();
        }

        // ==========================================
        // 2. AMBIL PAKET SOAL KEPRIBADIAN
        // ==========================================
        $paketKepribadians = collect();
        if (Schema::hasTable('paket_soals')) {
            $paketKepribadians = DB::table('paket_soals')
                ->where('tipe', 'like', '%kepribadian%')
                ->orWhere('kategori', 'like', '%kepribadian%')
                ->orWhere('nama_paket', 'like', '%kepribadian%')
                ->orWhere('judul', 'like', '%kepribadian%')
                ->get();
        }

        if ($paketKepribadians->isEmpty() && Schema::hasTable('bank_kepribadian')) {
            $paketKepribadians = DB::table('bank_kepribadian')->get();
        }

        // ==========================================
        // 3. AMBIL PAKET SOAL KECERMATAN (SEMUA PAKET SOAL KECERMATAN)
        // ==========================================
        $paketKecermatans = collect();

        // Cek jika ada tabel khusus paket_kecermatans
        if (Schema::hasTable('paket_kecermatans')) {
            $paketKecermatans = DB::table('paket_kecermatans')->get();
        }

        // Cek di tabel paket_soals (tabel menu Paket Ujian ZAVIER)
        if ($paketKecermatans->isEmpty() && Schema::hasTable('paket_soals')) {
            // Ambil yang bertipe kecermatan atau yang memiliki kata kecermatan
            $paketKecermatans = DB::table('paket_soals')
                ->where(function ($q) {
                    $q->where('tipe', 'like', '%kecermatan%')
                      ->orWhere('kategori', 'like', '%kecermatan%')
                      ->orWhere('jenis', 'like', '%kecermatan%')
                      ->orWhere('nama_paket', 'like', '%kecermatan%')
                      ->orWhere('judul', 'like', '%kecermatan%');
                })
                ->get();

            // Fallback: Jika kolom tipe/kategori kosong/tidak terdefinisi, ambil paket_soals selain kecerdasan & kepribadian
            if ($paketKecermatans->isEmpty()) {
                $kecerdasanIds = $paketKecerdasans->pluck('id')->toArray();
                $kepribadianIds = $paketKepribadians->pluck('id')->toArray();

                $paketKecermatans = DB::table('paket_soals')
                    ->whereNotIn('id', array_merge($kecerdasanIds, $kepribadianIds))
                    ->get();
            }

            // Jika masih kosong juga, tampilkan seluruh paket_soals yang ada
            if ($paketKecermatans->isEmpty()) {
                $paketKecermatans = DB::table('paket_soals')->get();
            }
        }

        // Normalisasi format nama paket agar dropdown selalu menampilkan teks
        $paketKecermatans = $paketKecermatans->map(function ($item) {
            $item = (object) $item;
            if (empty($item->nama_paket)) {
                $item->nama_paket = $item->judul ?? $item->nama ?? ('Paket Kecermatan #' . $item->id);
            }
            return $item;
        });

        $paketKecerdasans = $paketKecerdasans->map(function ($item) {
            $item = (object) $item;
            if (empty($item->nama_paket)) {
                $item->nama_paket = $item->judul ?? $item->nama ?? ('Paket Kecerdasan #' . $item->id);
            }
            return $item;
        });

        $paketKepribadians = $paketKepribadians->map(function ($item) {
            $item = (object) $item;
            if (empty($item->nama_paket)) {
                $item->nama_paket = $item->judul ?? $item->nama ?? ('Paket Kepribadian #' . $item->id);
            }
            return $item;
        });

        return view('admin.tryout.create', compact('paketKecerdasans', 'paketKepribadians', 'paketKecermatans'));
    }

    /**
     * Simpan Paket Tryout Baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_tryout'         => 'required|string|max:255',
            'paket_kecerdasan_id'  => 'required',
            'paket_kepribadian_id' => 'required',
            'paket_kecermatan_id'  => 'required',
            'durasi_kecerdasan'    => 'required|integer|min:1|max:300',
            'durasi_kepribadian'   => 'required|integer|min:1|max:300',
            'jeda_menit'           => 'required|integer|min:1|max:60',
        ]);

        PaketTryout::create([
            'judul_tryout'         => $validated['judul_tryout'],
            'paket_kecerdasan_id'  => $validated['paket_kecerdasan_id'],
            'paket_kepribadian_id' => $validated['paket_kepribadian_id'],
            'paket_kecermatan_id'  => $validated['paket_kecermatan_id'],
            'durasi_kecerdasan'    => (int) $validated['durasi_kecerdasan'],
            'durasi_kepribadian'   => (int) $validated['durasi_kepribadian'],
            'jeda_menit'           => (int) $validated['jeda_menit'],
        ]);

        return redirect()->route('admin.tryout.index')->with('success', 'Paket Tryout Psikologi POLRI berhasil dibuat!');
    }

    /**
     * Hapus Paket Tryout
     */
    public function destroy(PaketTryout $tryout)
    {
        $tryout->delete();
        return redirect()->route('admin.tryout.index')->with('success', 'Paket tryout berhasil dihapus.');
    }

    /**
     * Rekapitulasi Hasil Tryout
     */
    public function rekapHasil()
    {
        $hasils = HasilTryout::with(['user', 'paketTryout'])->latest()->paginate(20);
        return view('admin.tryout.rekap', compact('hasils'));
    }
}