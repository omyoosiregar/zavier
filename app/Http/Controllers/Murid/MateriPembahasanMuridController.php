<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MateriPembahasan;
use Illuminate\Support\Facades\Storage;

class MateriPembahasanMuridController extends Controller
{
    /**
     * Tampilkan katalog materi pembahasan untuk murid
     */
    public function index()
    {
        // Menggunakan paginate() agar $materis memiliki method hasPages() & links()
        $materis = MateriPembahasan::where('is_aktif', true)->latest()->paginate(9);
        return view('murid.pembahasan.index', compact('materis'));
    }

    /**
     * Tampilkan layar baca dokumen rahasia terproteksi
     */
    public function show(MateriPembahasan $materi)
    {
        if (!$materi->is_aktif) {
            abort(403, 'Materi pembahasan ini belum dipublikasikan.');
        }

        return view('murid.pembahasan.show', compact('materi'));
    }

    /**
     * Stream file secara aman tanpa tombol download bawaan browser
     */
    public function streamFile(MateriPembahasan $materi)
    {
        if (!Storage::disk('public')->exists($materi->file_path)) {
            abort(404, 'File materi tidak ditemukan.');
        }

        $path = Storage::disk('public')->path($materi->file_path);
        $mime = Storage::disk('public')->mimeType($materi->file_path);

        return response()->file($path, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="dokumen-rahasia.dat"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
        ]);
    }
}