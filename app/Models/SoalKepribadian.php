<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalKepribadian extends Model
{
    protected $table = 'soal_kepribadian';

    protected $fillable = [
        'bank_kepribadian_id',
        'nomor_soal',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
        'kunci_jawaban',
        'nilai',
        'status',
    ];

    protected $casts = [
        'nilai' => 'decimal:2',
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI BANK
    |--------------------------------------------------------------------------
    */

    public function bank()
    {
        return $this->belongsTo(
            BankKepribadian::class,
            'bank_kepribadian_id'
        );
    }
}