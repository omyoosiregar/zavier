<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaketKecerdasan extends Model
{
    protected $table = 'paket_kecerdasans';

    protected $fillable = [
        'nama_paket',
        'jumlah_soal',
        'tingkat',
        'durasi',
        'status',
    ];

    protected $casts = [
        'jumlah_soal' => 'integer',
        'durasi' => 'integer',
        'status' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | SOAL KECERDASAN
    |--------------------------------------------------------------------------
    */

    public function soals(): BelongsToMany
    {
        return $this->belongsToMany(
            SoalKecerdasan::class,
            'paket_kecerdasan_soals',
            'paket_kecerdasan_id',
            'soal_kecerdasan_id'
        )
        ->withPivot('nomor_urut')
        ->orderBy(
            'paket_kecerdasan_soals.nomor_urut'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HASIL UJIAN
    |--------------------------------------------------------------------------
    */

    public function hasil(): HasMany
    {
        return $this->hasMany(
            HasilKecerdasan::class,
            'paket_kecerdasan_id'
        );
    }
}