<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaketKecerdasanSoal extends Model
{
    protected $table = 'paket_kecerdasan_soals';

    protected $fillable = [
        'paket_kecerdasan_id',
        'soal_kecerdasan_id',
        'nomor_urut',
    ];

    protected $casts = [
        'paket_kecerdasan_id' => 'integer',
        'soal_kecerdasan_id'  => 'integer',
        'nomor_urut'          => 'integer',
    ];


    /**
     * Paket kecerdasan.
     */
    public function paket(): BelongsTo
    {
        return $this->belongsTo(
            PaketKecerdasan::class,
            'paket_kecerdasan_id'
        );
    }


    /**
     * Soal kecerdasan.
     */
    public function soal(): BelongsTo
    {
        return $this->belongsTo(
            SoalKecerdasan::class,
            'soal_kecerdasan_id'
        );
    }
}