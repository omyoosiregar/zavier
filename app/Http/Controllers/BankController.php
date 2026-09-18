<?php

namespace App\Http\Controllers;

use App\Models\BankKepribadian;
use App\Models\BankKecerdasan;
use App\Models\TestBank;

class BankSoalController extends Controller
{
    /**
     * =========================================================
     * HALAMAN UTAMA BANK SOAL SUPER ADMIN
     * =========================================================
     *
     * Menampilkan hanya:
     *
     * 1. Kepribadian
     * 2. Kecerdasan
     * 3. Penalaran Numerik
     *
     * Sistem bank soal masing-masing kategori tetap terpisah.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | KEPRIBADIAN
        |--------------------------------------------------------------------------
        */

        $jumlahKepribadian = BankKepribadian::withCount('soal')
            ->get()
            ->sum('soal_count');


        /*
        |--------------------------------------------------------------------------
        | KECERDASAN
        |--------------------------------------------------------------------------
        */

        $jumlahKecerdasan = BankKecerdasan::withCount('soal')
            ->get()
            ->sum('soal_count');


        /*
        |--------------------------------------------------------------------------
        | PENALARAN NUMERIK
        |--------------------------------------------------------------------------
        |
        | Penalaran Numerik menggunakan sistem TestBank umum.
        |
        */

        $jumlahPenalaranNumerik = 0;

        if (\Schema::hasTable('test_banks')) {
            $jumlahPenalaranNumerik = TestBank::where(
                'type',
                'penalaran_numerik'
            )
            ->withCount([
                'questions' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->get()
            ->sum('questions_count');
        }


        /*
        |--------------------------------------------------------------------------
        | DATA KATEGORI
        |--------------------------------------------------------------------------
        */

        $kategori = [

            [
                'kode' => 'kepribadian',

                'nama' => 'Kepribadian',

                'deskripsi' =>
                    'Kelola kumpulan soal kepribadian dan karakter peserta.',

                'jumlah' =>
                    $jumlahKepribadian,

                'icon' =>
                    'bi-person-vcard-fill',

                'warna' =>
                    'purple',

                'route' =>
                    route('admin.kepribadian-bank.index'),
            ],


            [
                'kode' => 'kecerdasan',

                'nama' => 'Kecerdasan',

                'deskripsi' =>
                    'Kelola kumpulan soal logika, verbal, numerik dan kemampuan berpikir.',

                'jumlah' =>
                    $jumlahKecerdasan,

                'icon' =>
                    'bi-lightbulb-fill',

                'warna' =>
                    'green',

                'route' =>
                    route('admin.kecerdasan-bank.index'),
            ],


            [
                'kode' => 'penalaran_numerik',

                'nama' => 'Penalaran Numerik',

                'deskripsi' =>
                    'Kelola soal angka, pola, perhitungan dan analisis numerik.',

                'jumlah' =>
                    $jumlahPenalaranNumerik,

                'icon' =>
                    'bi-calculator-fill',

                'warna' =>
                    'blue',

                'route' =>
                    route(
                        'admin.test-banks.index',
                        'penalaran_numerik'
                    ),
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.bank-soal.index',
            compact('kategori')
        );
    }
}