<?php

namespace App\Http\Controllers;

use App\Models\SoalKecerdasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SoalKecerdasanController extends Controller
{
    /**
     * Menampilkan daftar bank soal kecerdasan.
     */
    public function index()
    {
        $soal = SoalKecerdasan::latest()->paginate(20);

        return view('admin.soal-kecerdasan.index', compact('soal'));
    }

    /**
     * Form tambah soal.
     */
    public function create()
    {
        return view('admin.soal-kecerdasan.create');
    }

    /**
     * Menyimpan soal baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string'],

            'gambar_soal' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'pilihan_a' => ['nullable', 'string'],
            'gambar_a' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'pilihan_b' => ['nullable', 'string'],
            'gambar_b' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'pilihan_c' => ['nullable', 'string'],
            'gambar_c' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'pilihan_d' => ['nullable', 'string'],
            'gambar_d' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'pilihan_e' => ['nullable', 'string'],
            'gambar_e' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'jawaban_benar' => ['required', 'in:A,B,C,D,E'],

            'kategori' => ['nullable', 'string', 'max:100'],

            'tingkat' => ['required', 'in:mudah,sedang,sulit'],

            'pembahasan' => ['nullable', 'string'],

            'status' => ['nullable', 'boolean'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload gambar soal
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('gambar_soal')) {
            $validated['gambar_soal'] =
                $request->file('gambar_soal')->store(
                    'soal-kecerdasan',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Upload gambar pilihan A-E
        |--------------------------------------------------------------------------
        */

        foreach (['a', 'b', 'c', 'd', 'e'] as $huruf) {
            $field = 'gambar_' . $huruf;

            if ($request->hasFile($field)) {
                $validated[$field] =
                    $request->file($field)->store(
                        'soal-kecerdasan',
                        'public'
                    );
            }
        }

        $validated['status'] = $request->boolean('status');

        SoalKecerdasan::create($validated);

        return redirect()
            ->route('admin.soal-kecerdasan.index')
            ->with('success', 'Soal kecerdasan berhasil ditambahkan.');
    }

    /**
     * Form edit soal.
     */
    public function edit(SoalKecerdasan $soalKecerdasan)
    {
        return view(
            'admin.soal-kecerdasan.edit',
            compact('soalKecerdasan')
        );
    }

    /**
     * Update soal.
     */
    public function update(
        Request $request,
        SoalKecerdasan $soalKecerdasan
    ) {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string'],

            'gambar_soal' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'pilihan_a' => ['nullable', 'string'],
            'gambar_a' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'pilihan_b' => ['nullable', 'string'],
            'gambar_b' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            'pilihan_c' => ['nullable', 'string'],
            'gambar_c' => ['nullable', 'image', 'mimes:jpg,jpeg', 'max:2048'],

            'pilihan_d' => ['nullable', 'string'],
            'gambar_d' => ['nullable', 'image', 'mimes:jpg,jpeg', 'max:2048'],

            'pilihan_e' => ['nullable', 'string'],
            'gambar_e' => ['nullable', 'image', 'mimes:jpg,jpeg', 'max:2048'],

            'jawaban_benar' => ['required', 'in:A,B,C,D,E'],

            'kategori' => ['nullable', 'string', 'max:100'],

            'tingkat' => ['required', 'in:mudah,sedang,sulit'],

            'pembahasan' => ['nullable', 'string'],

            'status' => ['nullable', 'boolean'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload gambar baru
        |--------------------------------------------------------------------------
        */

        $gambarFields = [
            'gambar_soal',
            'gambar_a',
            'gambar_b',
            'gambar_c',
            'gambar_d',
            'gambar_e',
        ];

        foreach ($gambarFields as $field) {
            if ($request->hasFile($field)) {

                // Hapus gambar lama
                if ($soalKecerdasan->{$field}) {
                    Storage::disk('public')
                        ->delete($soalKecerdasan->{$field});
                }

                // Simpan gambar baru
                $validated[$field] =
                    $request->file($field)->store(
                        'soal-kecerdasan',
                        'public'
                    );
            } else {
                unset($validated[$field]);
            }
        }

        $validated['status'] = $request->boolean('status');

        $soalKecerdasan->update($validated);

        return redirect()
            ->route('admin.soal-kecerdasan.index')
            ->with('success', 'Soal kecerdasan berhasil diperbarui.');
    }

    /**
     * Menghapus soal.
     */
    public function destroy(SoalKecerdasan $soalKecerdasan)
    {
        $gambarFields = [
            'gambar_soal',
            'gambar_a',
            'gambar_b',
            'gambar_c',
            'gambar_d',
            'gambar_e',
        ];

        foreach ($gambarFields as $field) {
            if ($soalKecerdasan->{$field}) {
                Storage::disk('public')
                    ->delete($soalKecerdasan->{$field});
            }
        }

        $soalKecerdasan->delete();

        return redirect()
            ->route('admin.soal-kecerdasan.index')
            ->with('success', 'Soal kecerdasan berhasil dihapus.');
    }
}