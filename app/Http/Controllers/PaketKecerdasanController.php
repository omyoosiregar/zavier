<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketKecerdasan;
use App\Models\SoalKecerdasan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PaketKecerdasanController extends Controller
{
    public function index()
    {
        $pakets = PaketKecerdasan::latest()->paginate(10);
        return view('admin.paket-kecerdasan.index', compact('pakets'));
    }

    public function create()
    {
        // Ambil ID soal yang sudah dipakai di paket manapun
        $usedSoalIds = [];
        if (Schema::hasTable('paket_soal_kecerdasan')) {
            $usedSoalIds = DB::table('paket_soal_kecerdasan')->pluck('soal_kecerdasan_id')->toArray();
        } elseif (Schema::hasColumn('soal_kecerdasans', 'paket_kecerdasan_id')) {
            $usedSoalIds = SoalKecerdasan::whereNotNull('paket_kecerdasan_id')->pluck('id')->toArray();
        }

        $soals = SoalKecerdasan::where('status', 1)->orderBy('id', 'asc')->get();

        return view('admin.paket-kecerdasan.create', compact('soals', 'usedSoalIds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'durasi'     => 'required|numeric|min:1',
            'tingkat'    => 'required|string',
            'soal_ids'   => 'required|array|min:1',
            'soal_ids.*' => 'exists:soal_kecerdasans,id',
            'keterangan' => 'nullable|string',
        ], [
            'soal_ids.required' => 'Pilih minimal satu butir soal untuk dimasukkan ke dalam paket ini.',
        ]);

        $selectedIds = $request->soal_ids;

        $paket = PaketKecerdasan::create([
            'nama_paket'   => $request->nama_paket,
            'jenis_tes'    => 'Kecerdasan',
            'durasi'       => $request->durasi,
            'jumlah_soal'  => count($selectedIds),
            'keterangan'   => $request->keterangan,
            'tingkat'      => $request->tingkat ?? 'Sedang',
            'status'       => 1,
        ]);

        if (method_exists($paket, 'soals')) {
            $paket->soals()->sync($selectedIds);
        } elseif (Schema::hasColumn('soal_kecerdasans', 'paket_kecerdasan_id')) {
            SoalKecerdasan::whereIn('id', $selectedIds)->update(['paket_kecerdasan_id' => $paket->id]);
        }

        return redirect()->route('admin.paket-kecerdasan.index')->with('success', 'Paket soal kecerdasan berhasil dibuat.');
    }

    /*
    |--------------------------------------------------------------------------
    | FITUR EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(PaketKecerdasan $paket)
    {
        // 1. Ambil ID soal yang sedang aktif dipakai di paket INI
        $currentSoalIds = [];
        if (method_exists($paket, 'soals')) {
            $currentSoalIds = $paket->soals()->pluck('soal_kecerdasans.id')->toArray();
        } elseif (Schema::hasColumn('soal_kecerdasans', 'paket_kecerdasan_id')) {
            $currentSoalIds = SoalKecerdasan::where('paket_kecerdasan_id', $paket->id)->pluck('id')->toArray();
        }

        // 2. Ambil ID soal yang dipakai di paket LAIN (selain paket ini)
        $usedInOtherPaketIds = [];
        if (Schema::hasTable('paket_soal_kecerdasan')) {
            $usedInOtherPaketIds = DB::table('paket_soal_kecerdasan')
                ->where('paket_kecerdasan_id', '!=', $paket->id)
                ->pluck('soal_kecerdasan_id')
                ->toArray();
        } elseif (Schema::hasColumn('soal_kecerdasans', 'paket_kecerdasan_id')) {
            $usedInOtherPaketIds = SoalKecerdasan::whereNotNull('paket_kecerdasan_id')
                ->where('paket_kecerdasan_id', '!=', $paket->id)
                ->pluck('id')
                ->toArray();
        }

        // 3. Ambil semua soal dari bank soal
        $soals = SoalKecerdasan::where('status', 1)->orderBy('id', 'asc')->get();

        return view('admin.paket-kecerdasan.edit', compact('paket', 'soals', 'currentSoalIds', 'usedInOtherPaketIds'));
    }

    /*
    |--------------------------------------------------------------------------
    | FITUR UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, PaketKecerdasan $paket)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'durasi'     => 'required|numeric|min:1',
            'tingkat'    => 'required|string',
            'soal_ids'   => 'required|array|min:1',
            'soal_ids.*' => 'exists:soal_kecerdasans,id',
            'keterangan' => 'nullable|string',
        ], [
            'soal_ids.required' => 'Pilih minimal satu butir soal untuk paket ini.',
        ]);

        $selectedIds = $request->soal_ids;

        // 1. Update data paket
        $paket->update([
            'nama_paket'   => $request->nama_paket,
            'durasi'       => $request->durasi,
            'jumlah_soal'  => count($selectedIds),
            'tingkat'      => $request->tingkat,
            'keterangan'   => $request->keterangan,
        ]);

        // 2. Sinkronkan soal baru
        if (method_exists($paket, 'soals')) {
            $paket->soals()->sync($selectedIds);
        } elseif (Schema::hasColumn('soal_kecerdasans', 'paket_kecerdasan_id')) {
            // Lepas soal lama milik paket ini
            SoalKecerdasan::where('paket_kecerdasan_id', $paket->id)->update(['paket_kecerdasan_id' => null]);
            // Pasang soal yang baru dipilih
            SoalKecerdasan::whereIn('id', $selectedIds)->update(['paket_kecerdasan_id' => $paket->id]);
        }

        return redirect()->route('admin.paket-kecerdasan.index')->with('success', 'Paket soal kecerdasan berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | FITUR HAPUS
    |--------------------------------------------------------------------------
    */
    public function destroy(PaketKecerdasan $paket)
    {
        // 1. Lepas hubungan soal dari paket (soal di bank soal tidak terhapus)
        if (method_exists($paket, 'soals')) {
            $paket->soals()->detach();
        } elseif (Schema::hasColumn('soal_kecerdasans', 'paket_kecerdasan_id')) {
            SoalKecerdasan::where('paket_kecerdasan_id', $paket->id)->update(['paket_kecerdasan_id' => null]);
        }

        // 2. Hapus paket
        $paket->delete();

        return redirect()->route('admin.paket-kecerdasan.index')->with('success', 'Paket soal kecerdasan berhasil dihapus.');
    }
}