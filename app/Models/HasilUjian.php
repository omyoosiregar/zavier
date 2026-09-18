<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    protected $fillable = [

        'user_id',

        'paket_soal_id',

        'nilai_kolom',

        'jumlah_dijawab',

        'jawaban',

        'total_benar',

        'total_soal',

        'nilai',

        'kategori',

        'keterangan',

        'mulai_pada',

        'selesai_pada',
    ];


    protected $casts = [

        'nilai_kolom' =>
            'array',

        'jumlah_dijawab' =>
            'array',

        'jawaban' =>
            'array',

        'mulai_pada' =>
            'datetime',

        'selesai_pada' =>
            'datetime',

        'nilai' =>
            'decimal:2',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI PAKET SOAL
    |--------------------------------------------------------------------------
    */

    public function paketSoal()
    {
        return $this->belongsTo(
            PaketSoal::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI USER / MURID
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }
}