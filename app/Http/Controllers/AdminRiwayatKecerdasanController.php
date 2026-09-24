<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HasilKecerdasan;
use Illuminate\Support\Facades\Schema;

class AdminRiwayatKecerdasanController extends Controller
{
    /**
     * Tampilkan Daftar Siswa Beserta Ringkasan Aktivitas Ujiannya (Dengan Fitur Pencarian)
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'murid');

        // Pencarian Nama atau Email Murid (Case-Insensitive)
        if ($request->filled('q')) {
            $search = strtolower(trim($request->q));
            $query->where(function ($sub) use ($search) {
                $sub->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(email) LIKE ?', ["%{$search}%"]);
            });
        }

        // withQueryString() mempertahankan kata kunci pencarian pada pagination
        $murids = $query->latest()->paginate(15)->withQueryString();

        return view('admin.riwayat-kecerdasan.index', compact('murids'));
    }

    /**
     * Tampilkan Detail Riwayat Terpadu (Kecerdasan, Kecermatan, Kepribadian) Murid Tersebut
     */
    public function show($userId)
    {
        $murid = User::findOrFail($userId);

        // 1. Riwayat Ujian Kecerdasan
        $riwayatKecerdasan = HasilKecerdasan::with('paket')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        // 2. Riwayat Ujian Kecermatan
        $riwayatKecermatan = collect();
        if (class_exists(\App\Models\Hasil::class)) {
            $riwayatKecermatan = \App\Models\Hasil::with('paketSoal')->where('user_id', $userId)->latest()->get();
        } elseif (class_exists(\App\Models\HasilUjian::class)) {
            $riwayatKecermatan = \App\Models\HasilUjian::where('user_id', $userId)->latest()->get();
        }

        // 3. Riwayat Ujian Kepribadian
        $riwayatKepribadian = collect();
        if (class_exists(\App\Models\HasilKepribadian::class)) {
            $riwayatKepribadian = \App\Models\HasilKepribadian::with('paket')->where('user_id', $userId)->latest()->get();
        }

        return view('admin.riwayat-kecerdasan.show', compact(
            'murid',
            'riwayatKecerdasan',
            'riwayatKecermatan',
            'riwayatKepribadian'
        ));
    }

    /**
     * Reset / Hapus Riwayat Hasil Ujian Tertentu
     */
    public function destroy($hasilId)
    {
        $hasil = HasilKecerdasan::findOrFail($hasilId);

        if (class_exists(\App\Models\JawabanKecerdasan::class)) {
            \App\Models\JawabanKecerdasan::where('hasil_kecerdasan_id', $hasil->id)->delete();
        }

        $hasil->delete();

        return back()->with('success', 'Riwayat pengerjaan berhasil dihapus.');
    }
}