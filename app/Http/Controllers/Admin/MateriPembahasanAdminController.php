<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MateriPembahasan;
use Illuminate\Support\Facades\Storage;

class MateriPembahasanAdminController extends Controller
{
    /**
     * Menampilkan daftar semua file materi pembahasan
     */
    public function index()
    {
        $materis = MateriPembahasan::latest()->paginate(10);
        return view('admin.pembahasan.index', compact('materis'));
    }

    /**
     * Form tambah file materi pembahasan baru
     */
    public function create()
    {
        return view('admin.pembahasan.create');
    }

    /**
     * Menyimpan file materi pembahasan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'file_materi' => 'required|file|mimes:pdf,png,jpg,jpeg,webp,txt,doc,docx|max:51200', // Maks 50MB
            'deskripsi' => 'nullable|string',
        ]);

        $file = $request->file('file_materi');
        $ext = strtolower($file->getClientOriginalExtension());
        $origName = $file->getClientOriginalName();
        $path = $file->store('materi_pembahasan', 'public');

        $kontenTeks = null;
        if (in_array($ext, ['txt', 'text'])) {
            $kontenTeks = file_get_contents($file->getRealPath());
        }

        MateriPembahasan::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'file_path' => $path,
            'file_name' => $origName,
            'file_extension' => $ext,
            'konten_teks' => $kontenTeks,
            'is_aktif' => true,
        ]);

        return redirect()->route('admin.pembahasan.index')->with('success', 'File materi pembahasan berhasil diunggah!');
    }

    /**
     * Form edit materi pembahasan
     */
    public function edit(MateriPembahasan $pembahasan)
    {
        return view('admin.pembahasan.edit', compact('pembahasan'));
    }

    /**
     * Memperbarui materi pembahasan & mengganti file jika ada unggahan baru
     */
    public function update(Request $request, MateriPembahasan $pembahasan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string',
            'file_materi' => 'nullable|file|mimes:pdf,png,jpg,jpeg,webp,txt,doc,docx|max:51200',
            'deskripsi' => 'nullable|string',
        ]);

        $dataUpdate = [
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
        ];

        // Jika ada unggahan file baru pengganti
        if ($request->hasFile('file_materi')) {
            // Hapus file lama dari disk storage
            if ($pembahasan->file_path && Storage::disk('public')->exists($pembahasan->file_path)) {
                Storage::disk('public')->delete($pembahasan->file_path);
            }

            $file = $request->file('file_materi');
            $ext = strtolower($file->getClientOriginalExtension());
            $origName = $file->getClientOriginalName();
            $path = $file->store('materi_pembahasan', 'public');

            $kontenTeks = null;
            if (in_array($ext, ['txt', 'text'])) {
                $kontenTeks = file_get_contents($file->getRealPath());
            }

            $dataUpdate['file_path'] = $path;
            $dataUpdate['file_name'] = $origName;
            $dataUpdate['file_extension'] = $ext;
            $dataUpdate['konten_teks'] = $kontenTeks;
        }

        $pembahasan->update($dataUpdate);

        return redirect()->route('admin.pembahasan.index')->with('success', 'Materi pembahasan berhasil diperbarui!');
    }

    /**
     * Menghapus materi pembahasan dan menghapus file fisiknya
     */
    public function destroy(MateriPembahasan $pembahasan)
    {
        if ($pembahasan->file_path && Storage::disk('public')->exists($pembahasan->file_path)) {
            Storage::disk('public')->delete($pembahasan->file_path);
        }

        $pembahasan->delete();

        return redirect()->route('admin.pembahasan.index')->with('success', 'Materi pembahasan berhasil dihapus.');
    }
}