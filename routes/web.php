<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\PaketSoalController;

use App\Http\Controllers\KepribadianBankController;
use App\Http\Controllers\PaketKepribadianController;
use App\Http\Controllers\KepribadianMuridController;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');

});


/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = auth()->user();

    if ($user->role === 'super_admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'mentor') {
        return redirect()->route('mentor.dashboard');
    }

    return redirect()->route('murid.dashboard');

})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');


    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');


    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:super_admin'
])
->prefix('admin')
->name('admin.')
->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [AdminController::class, 'dashboard']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | BANK SOAL UTAMA
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    | Halaman utama Bank Soal
    |
    | URL:
    | /admin/bank-soal
    |
    | Route:
    | admin.bank-soal.index
    |
    */

    Route::get(
        '/bank-soal',
        function () {

            return view(
                'admin.bank-soal.index'
            );

        }
    )->name('bank-soal.index');


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | PAKET UJIAN UTAMA
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    | Halaman utama Paket Ujian
    |
    | URL:
    | /admin/paket-ujian
    |
    | Route:
    | admin.paket-ujian.index
    |
    | Halaman ini nantinya akan menampilkan:
    |
    | 1. Tes Kecermatan
    | 2. Tes Psikologi & Penalaran
    | 3. Tes Akademik
    |
    | Sistem yang sudah memiliki route dapat dibuka.
    | Sistem lainnya ditampilkan terlebih dahulu.
    |
    */

    Route::get(
        '/paket-ujian',
        function () {

            return view(
                'admin.paket-ujian.index'
            );

        }
    )->name('paket-ujian.index');


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | BANK SOAL KEPRIBADIAN
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

    Route::prefix('kepribadian-bank')
        ->name('kepribadian-bank.')
        ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | DAFTAR BANK
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/',
            [KepribadianBankController::class, 'index']
        )->name('index');


        /*
        |--------------------------------------------------------------------------
        | FORM TAMBAH BANK
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/create',
            [KepribadianBankController::class, 'create']
        )->name('create');


        /*
        |--------------------------------------------------------------------------
        | SIMPAN BANK
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/',
            [KepribadianBankController::class, 'store']
        )->name('store');


        /*
        |--------------------------------------------------------------------------
        | FORM EDIT BANK
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/{bank}/edit',
            [KepribadianBankController::class, 'edit']
        )->name('edit');


        /*
        |--------------------------------------------------------------------------
        | UPDATE BANK
        |--------------------------------------------------------------------------
        */

        Route::put(
            '/{bank}',
            [KepribadianBankController::class, 'update']
        )->name('update');


        /*
        |--------------------------------------------------------------------------
        | HAPUS BANK
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/{bank}',
            [KepribadianBankController::class, 'destroy']
        )->name('destroy');


        /*
        |--------------------------------------------------------------------------
        | UPLOAD SOAL WORD
        |--------------------------------------------------------------------------
        |
        | Tetap menggunakan file Word .docx
        |
        */

        Route::post(
            '/{bank}/upload-word',
            [KepribadianBankController::class, 'uploadWord']
        )->name('upload');


        /*
        |--------------------------------------------------------------------------
        | UPDATE SOAL KEPRIBADIAN
        |--------------------------------------------------------------------------
        */

        Route::put(
            '/soal/{soal}',
            [KepribadianBankController::class, 'updateQuestion']
        )->name('soal.update');


        /*
        |--------------------------------------------------------------------------
        | HAPUS SOAL KEPRIBADIAN
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/soal/{soal}',
            [KepribadianBankController::class, 'destroyQuestion']
        )->name('soal.destroy');

    });


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | PAKET SOAL KEPRIBADIAN
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

    Route::prefix('paket-kepribadian')
        ->name('paket-kepribadian.')
        ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | DAFTAR PAKET KEPRIBADIAN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/',
            [PaketKepribadianController::class, 'index']
        )->name('index');


        /*
        |--------------------------------------------------------------------------
        | FORM TAMBAH PAKET
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/create',
            [PaketKepribadianController::class, 'create']
        )->name('create');


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PAKET
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/',
            [PaketKepribadianController::class, 'store']
        )->name('store');


        /*
        |--------------------------------------------------------------------------
        | FORM EDIT PAKET
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/{paket}/edit',
            [PaketKepribadianController::class, 'edit']
        )->name('edit');


        /*
        |--------------------------------------------------------------------------
        | UPDATE PAKET
        |--------------------------------------------------------------------------
        */

        Route::put(
            '/{paket}',
            [PaketKepribadianController::class, 'update']
        )->name('update');


        /*
        |--------------------------------------------------------------------------
        | HAPUS PAKET
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/{paket}',
            [PaketKepribadianController::class, 'destroy']
        )->name('destroy');

    });


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | MENTOR
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/mentor',
        [MentorController::class, 'index']
    )->name('mentor.index');


    Route::get(
        '/mentor/create',
        [MentorController::class, 'create']
    )->name('mentor.create');


    Route::post(
        '/mentor',
        [MentorController::class, 'store']
    )->name('mentor.store');


    Route::get(
        '/mentor/{mentor}/edit',
        [MentorController::class, 'edit']
    )->name('mentor.edit');


    Route::put(
        '/mentor/{mentor}',
        [MentorController::class, 'update']
    )->name('mentor.update');


    Route::delete(
        '/mentor/{mentor}',
        [MentorController::class, 'destroy']
    )->name('mentor.destroy');


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | MURID
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/murid',
        [AdminController::class, 'murid']
    )->name('murid');


    Route::get(
        '/murid/{user}/edit',
        [AdminController::class, 'editMurid']
    )->name('murid.edit');


    Route::post(
        '/murid',
        [AdminController::class, 'storeMurid']
    )->name('murid.store');


    Route::put(
        '/murid/{user}',
        [AdminController::class, 'updateMurid']
    )->name('murid.update');


    Route::delete(
        '/murid/{user}',
        [AdminController::class, 'destroyMurid']
    )->name('murid.destroy');


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | BANK SOAL KECERMATAN
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    | JANGAN DIUBAH
    |
    */

    Route::resource(
        'soal',
        SoalController::class
    );


    /*
    |--------------------------------------------------------------------------
    | GENERATE SOAL KECERMATAN
    |--------------------------------------------------------------------------
    |
    | Digunakan oleh:
    |
    | resources/views/admin/soal/index.blade.php
    |
    | route('admin.soal.generate')
    |
    */

    Route::post(
        '/soal/generate',
        [SoalController::class, 'generate']
    )->name('soal.generate');


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | PAKET SOAL KECERMATAN
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    | JANGAN DIUBAH
    |
    */

    Route::get(
        '/paket-soal',
        [PaketSoalController::class, 'index']
    )->name('paket-soal');


    /*
    |--------------------------------------------------------------------------
    | GENERATE PAKET KECERMATAN
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/paket-soal/generate',
        [PaketSoalController::class, 'generate']
    )->name('paket-soal.generate');


    /*
    |--------------------------------------------------------------------------
    | EDIT PAKET KECERMATAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/paket-soal/{paketSoal}/edit',
        [PaketSoalController::class, 'edit']
    )->name('paket-soal.edit');


    /*
    |--------------------------------------------------------------------------
    | UPDATE PAKET KECERMATAN
    |--------------------------------------------------------------------------
    */

    Route::put(
        '/paket-soal/{paketSoal}',
        [PaketSoalController::class, 'update']
    )->name('paket-soal.update');


    /*
    |--------------------------------------------------------------------------
    | HAPUS PAKET KECERMATAN
    |--------------------------------------------------------------------------
    */

    Route::delete(
        '/paket-soal/{paketSoal}',
        [PaketSoalController::class, 'destroy']
    )->name('paket-soal.destroy');

});


/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| MENTOR
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:mentor'
])
->prefix('mentor')
->name('mentor.')
->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD MENTOR
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [MentorController::class, 'dashboard']
    )->name('dashboard');

});


/*
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| MURID
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:murid'
])
->prefix('murid')
->name('murid.')
->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD MURID
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [MuridController::class, 'dashboard']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | SISTEM TES KEPRIBADIAN
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | DAFTAR TES KEPRIBADIAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/kepribadian',
        [KepribadianMuridController::class, 'index']
    )->name('kepribadian.index');


    /*
    |--------------------------------------------------------------------------
    | HASIL TES KEPRIBADIAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/kepribadian/hasil/{hasil}',
        [KepribadianMuridController::class, 'hasil']
    )->name('kepribadian.hasil');


    /*
    |--------------------------------------------------------------------------
    | MULAI TES KEPRIBADIAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/kepribadian/{paket}/mulai',
        [KepribadianMuridController::class, 'mulai']
    )->name('kepribadian.mulai');


    /*
    |--------------------------------------------------------------------------
    | SELESAI TES KEPRIBADIAN
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/kepribadian/{paket}/selesai',
        [KepribadianMuridController::class, 'selesai']
    )->name('kepribadian.selesai');


    /*
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    | SISTEM KECERMATAN
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    | JANGAN DIUBAH
    |
    */


    /*
    |--------------------------------------------------------------------------
    | DAFTAR PAKET SOAL KECERMATAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/paket-soal',
        [MuridController::class, 'paketSoal']
    )->name('paket-soal');


    /*
    |--------------------------------------------------------------------------
    | MULAI UJIAN KECERMATAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/ujian/{paketSoal}',
        [MuridController::class, 'mulaiUjian']
    )->name('ujian');


    /*
    |--------------------------------------------------------------------------
    | SIMPAN JAWABAN KOLOM
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/ujian/simpan-kolom',
        [MuridController::class, 'simpanKolom']
    )->name('ujian.simpan-kolom');


    /*
    |--------------------------------------------------------------------------
    | SELESAI UJIAN KECERMATAN
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/ujian/selesai',
        [MuridController::class, 'selesaiUjian']
    )->name('ujian.selesai');


    /*
    |--------------------------------------------------------------------------
    | HASIL TERAKHIR KECERMATAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/hasil-terakhir',
        [MuridController::class, 'hasilTerakhir']
    )->name('hasil.terakhir');


    /*
    |--------------------------------------------------------------------------
    | RIWAYAT UJIAN KECERMATAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/riwayat',
        [MuridController::class, 'hasilIndex']
    )->name('riwayat');


    /*
    |--------------------------------------------------------------------------
    | DETAIL HASIL UJIAN KECERMATAN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/hasil/{hasil}',
        [MuridController::class, 'hasil']
    )->name('hasil');

});


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';