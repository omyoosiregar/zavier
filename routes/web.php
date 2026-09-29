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

use App\Http\Controllers\SoalKecerdasanController;
use App\Http\Controllers\PaketKecerdasanController;
use App\Http\Controllers\KecerdasanMuridController;
use App\Http\Controllers\AdminRiwayatKecerdasanController;

// Controller Tryout Terpadu
use App\Http\Controllers\Admin\TryoutAdminController;
use App\Http\Controllers\Murid\TryoutMuridController;

// Controller Materi & Pembahasan Soal
use App\Http\Controllers\Admin\MateriPembahasanAdminController;
use App\Http\Controllers\Murid\MateriPembahasanMuridController;

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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
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
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | BANK SOAL UTAMA
    |--------------------------------------------------------------------------
    */
    Route::get('/bank-soal', function () {
        return view('admin.bank-soal.index');
    })->name('bank-soal.index');

    /*
    |--------------------------------------------------------------------------
    | PAKET UJIAN UTAMA
    |--------------------------------------------------------------------------
    */
    Route::get('/paket-ujian', function () {
        return view('admin.paket-ujian.index');
    })->name('paket-ujian.index');

    /*
    |--------------------------------------------------------------------------
    | BANK SOAL KEPRIBADIAN
    |--------------------------------------------------------------------------
    */
    Route::prefix('kepribadian-bank')->name('kepribadian-bank.')->group(function () {
        Route::get('/', [KepribadianBankController::class, 'index'])->name('index');
        Route::get('/create', [KepribadianBankController::class, 'create'])->name('create');
        Route::post('/', [KepribadianBankController::class, 'store'])->name('store');
        Route::get('/{bank}/edit', [KepribadianBankController::class, 'edit'])->name('edit');
        Route::put('/{bank}', [KepribadianBankController::class, 'update'])->name('update');
        Route::delete('/{bank}', [KepribadianBankController::class, 'destroy'])->name('destroy');

        Route::post('/{bank}/upload-word', [KepribadianBankController::class, 'uploadWord'])->name('upload');
        Route::put('/soal/{soal}', [KepribadianBankController::class, 'updateQuestion'])->name('soal.update');
        Route::delete('/soal/{soal}', [KepribadianBankController::class, 'destroyQuestion'])->name('soal.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | PAKET SOAL KEPRIBADIAN
    |--------------------------------------------------------------------------
    */
    Route::prefix('paket-kepribadian')->name('paket-kepribadian.')->group(function () {
        Route::get('/', [PaketKepribadianController::class, 'index'])->name('index');
        Route::get('/create', [PaketKepribadianController::class, 'create'])->name('create');
        Route::post('/', [PaketKepribadianController::class, 'store'])->name('store');
        Route::get('/{paket}/edit', [PaketKepribadianController::class, 'edit'])->name('edit');
        Route::put('/{paket}', [PaketKepribadianController::class, 'update'])->name('update');
        Route::delete('/{paket}', [PaketKepribadianController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | MENTOR ADMIN
    |--------------------------------------------------------------------------
    */
    Route::get('/mentor', [MentorController::class, 'index'])->name('mentor.index');
    Route::get('/mentor/create', [MentorController::class, 'create'])->name('mentor.create');
    Route::post('/mentor', [MentorController::class, 'store'])->name('mentor.store');
    Route::get('/mentor/{mentor}/edit', [MentorController::class, 'edit'])->name('mentor.edit');
    Route::put('/mentor/{mentor}', [MentorController::class, 'update'])->name('mentor.update');
    Route::delete('/mentor/{mentor}', [MentorController::class, 'destroy'])->name('mentor.destroy');

    /*
    |--------------------------------------------------------------------------
    | MURID ADMIN
    |--------------------------------------------------------------------------
    */
    Route::get('/murid', [AdminController::class, 'murid'])->name('murid');
    Route::get('/murid/{user}/edit', [AdminController::class, 'editMurid'])->name('murid.edit');
    Route::post('/murid', [AdminController::class, 'storeMurid'])->name('murid.store');
    Route::put('/murid/{user}', [AdminController::class, 'updateMurid'])->name('murid.update');
    Route::delete('/murid/{user}', [AdminController::class, 'destroyMurid'])->name('murid.destroy');

    /*
    |--------------------------------------------------------------------------
    | BANK SOAL KECERMATAN (JANGAN DIUBAH)
    |--------------------------------------------------------------------------
    */
    Route::resource('soal', SoalController::class);
    Route::post('/soal/generate', [SoalController::class, 'generate'])->name('soal.generate');

    /*
    |--------------------------------------------------------------------------
    | PAKET SOAL KECERMATAN (JANGAN DIUBAH)
    |--------------------------------------------------------------------------
    */
    Route::get('/paket-soal', [PaketSoalController::class, 'index'])->name('paket-soal');
    Route::post('/paket-soal/generate', [PaketSoalController::class, 'generate'])->name('paket-soal.generate');
    Route::get('/paket-soal/{paketSoal}/edit', [PaketSoalController::class, 'edit'])->name('paket-soal.edit');
    Route::put('/paket-soal/{paketSoal}', [PaketSoalController::class, 'update'])->name('paket-soal.update');
    Route::delete('/paket-soal/{paketSoal}', [PaketSoalController::class, 'destroy'])->name('paket-soal.destroy');

    /*
    |--------------------------------------------------------------------------
    | BANK SOAL KECERDASAN
    |--------------------------------------------------------------------------
    */
    Route::prefix('soal-kecerdasan')->name('soal-kecerdasan.')->group(function () {
        Route::get('/', [SoalKecerdasanController::class, 'index'])->name('index');
        Route::get('/create', [SoalKecerdasanController::class, 'create'])->name('create');
        Route::post('/', [SoalKecerdasanController::class, 'store'])->name('store');
        Route::get('/{soalKecerdasan}/edit', [SoalKecerdasanController::class, 'edit'])->name('edit');
        Route::put('/{soalKecerdasan}', [SoalKecerdasanController::class, 'update'])->name('update');
        Route::delete('/{soalKecerdasan}', [SoalKecerdasanController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | PAKET SOAL KECERDASAN
    |--------------------------------------------------------------------------
    */
    Route::prefix('paket-kecerdasan')->name('paket-kecerdasan.')->group(function () {
        Route::get('/', [PaketKecerdasanController::class, 'index'])->name('index');
        Route::get('/create', [PaketKecerdasanController::class, 'create'])->name('create');
        Route::post('/', [PaketKecerdasanController::class, 'store'])->name('store');
        Route::get('/{paket}/edit', [PaketKecerdasanController::class, 'edit'])->name('edit');
        Route::put('/{paket}', [PaketKecerdasanController::class, 'update'])->name('update');
        Route::delete('/{paket}', [PaketKecerdasanController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT UJIAN KECERDASAN (SUPER ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::prefix('riwayat-kecerdasan')->name('riwayat-kecerdasan.')->group(function () {
        Route::get('/', [AdminRiwayatKecerdasanController::class, 'index'])->name('index');
        Route::get('/{hasil}', [AdminRiwayatKecerdasanController::class, 'show'])->name('show');
        Route::delete('/{hasil}', [AdminRiwayatKecerdasanController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | MASTER PAKET & REKAP TRYOUT PSIKOLOGI POLRI (SUPER ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::prefix('tryout')->name('tryout.')->group(function () {
        Route::get('/', [TryoutAdminController::class, 'index'])->name('index');
        Route::get('/create', [TryoutAdminController::class, 'create'])->name('create');
        Route::post('/', [TryoutAdminController::class, 'store'])->name('store');
        Route::delete('/{tryout}', [TryoutAdminController::class, 'destroy'])->name('destroy');
        Route::get('/rekap-nilai', [TryoutAdminController::class, 'rekapHasil'])->name('rekap');
    });

    /*
    |--------------------------------------------------------------------------
    | MODUL PEMBAHASAN SOAL (SUPER ADMIN)
    |--------------------------------------------------------------------------
    */
    Route::resource('pembahasan', MateriPembahasanAdminController::class);

});

/*
|--------------------------------------------------------------------------
| MENTOR
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:mentor'
])
->prefix('mentor')
->name('mentor.')
->group(function () {
    Route::get('/dashboard', [MentorController::class, 'dashboard'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| MURID
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
    Route::get('/dashboard', [MuridController::class, 'dashboard'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | SISTEM TES KEPRIBADIAN
    |--------------------------------------------------------------------------
    */
    Route::get('/kepribadian', [KepribadianMuridController::class, 'index'])->name('kepribadian.index');
    Route::get('/kepribadian/hasil/{hasil}', [KepribadianMuridController::class, 'hasil'])->name('kepribadian.hasil');
    Route::get('/kepribadian/{paket}/mulai', [KepribadianMuridController::class, 'mulai'])->name('kepribadian.mulai');
    Route::post('/kepribadian/{paket}/selesai', [KepribadianMuridController::class, 'selesai'])->name('kepribadian.selesai');

    /*
    |--------------------------------------------------------------------------
    | SISTEM KECERMATAN
    |--------------------------------------------------------------------------
    */
    Route::get('/paket-soal', [MuridController::class, 'paketSoal'])->name('paket-soal');

    Route::get('/ujian/{paketSoal}', function ($id) {
        if (class_exists(\App\Models\PaketKecerdasan::class)) {
            $isKecerdasan = \App\Models\PaketKecerdasan::where('id', $id)->exists();
            if ($isKecerdasan) {
                return redirect()->route('murid.kecerdasan.mulai', $id);
            }
        }

        $paketModel = \App\Models\PaketSoal::find($id);

        if (!$paketModel) {
            return redirect()->route('murid.paket-soal')->with('error', 'Paket soal tidak ditemukan.');
        }

        return app(\App\Http\Controllers\MuridController::class)->mulaiUjian($paketModel);
    })->name('ujian');

    Route::post('/ujian/simpan-kolom', [MuridController::class, 'simpanKolom'])->name('ujian.simpan-kolom');
    Route::post('/ujian/selesai', [MuridController::class, 'selesaiUjian'])->name('ujian.selesai');
    Route::get('/hasil-terakhir', [MuridController::class, 'hasilTerakhir'])->name('hasil.terakhir');
    Route::get('/riwayat', [MuridController::class, 'hasilIndex'])->name('riwayat');
    Route::get('/hasil/{hasil}', [MuridController::class, 'hasil'])->name('hasil');

    /*
    |--------------------------------------------------------------------------
    | SISTEM TES KECERDASAN
    |--------------------------------------------------------------------------
    */
    Route::get('/kecerdasan', [KecerdasanMuridController::class, 'index'])->name('kecerdasan.index');
    Route::get('/kecerdasan/hasil/{hasil}', [KecerdasanMuridController::class, 'hasil'])->name('kecerdasan.hasil');
    Route::get('/kecerdasan/{paket}/mulai', [KecerdasanMuridController::class, 'mulai'])->name('kecerdasan.mulai');
    Route::post('/kecerdasan/jawab/{hasil}', [KecerdasanMuridController::class, 'jawab'])->name('kecerdasan.jawab');
    Route::post('/kecerdasan/{hasil}/selesai', [KecerdasanMuridController::class, 'selesai'])->name('kecerdasan.selesai');
    Route::get('/kecerdasan-riwayat', [KecerdasanMuridController::class, 'riwayat'])->name('kecerdasan.riwayat');

    /*
    |--------------------------------------------------------------------------
    | ALUR SIMULASI TRYOUT PSIKOLOGI LENGKAP
    |--------------------------------------------------------------------------
    */
    Route::prefix('tryout')->name('tryout.')->group(function () {
        Route::get('/', [TryoutMuridController::class, 'index'])->name('index');
        Route::get('/{tryout}/mulai', [TryoutMuridController::class, 'mulai'])->name('mulai');
        Route::get('/{hasil}/lanjut', [TryoutMuridController::class, 'arahkanTahap'])->name('lanjut');
        Route::post('/{hasil}/skip-jeda', [TryoutMuridController::class, 'skipJeda'])->name('skip_jeda');
        Route::post('/{hasil}/submit-kecerdasan', [TryoutMuridController::class, 'submitKecerdasan'])->name('submit.kecerdasan');
        Route::post('/{hasil}/submit-kepribadian', [TryoutMuridController::class, 'submitKepribadian'])->name('submit.kepribadian');
        Route::post('/{hasil}/submit-kecermatan', [TryoutMuridController::class, 'submitKecermatan'])->name('submit.kecermatan');
        Route::get('/{hasil}/hasil', [TryoutMuridController::class, 'hasil'])->name('hasil');
    });

    /*
    |--------------------------------------------------------------------------
    | MATERI & PEMBAHASAN SOAL (MURID)
    |--------------------------------------------------------------------------
    */
    Route::get('/pembahasan', [MateriPembahasanMuridController::class, 'index'])->name('pembahasan.index');
    Route::get('/pembahasan/{materi}', [MateriPembahasanMuridController::class, 'show'])->name('pembahasan.show');
    Route::get('/pembahasan/{materi}/stream', [MateriPembahasanMuridController::class, 'streamFile'])->name('pembahasan.stream');

});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';