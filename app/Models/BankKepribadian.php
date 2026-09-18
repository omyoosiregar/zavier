<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankKepribadian extends Model
{
    protected $table = 'bank_kepribadian';

    protected $fillable = [
        'nama_bank',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI SOAL
    |--------------------------------------------------------------------------
    */

    public function soal()
    {
        return $this->hasMany(
            SoalKepribadian::class,
            'bank_kepribadian_id'
        )
        ->orderBy('nomor_soal');
    }
}