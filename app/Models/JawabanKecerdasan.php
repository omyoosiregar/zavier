<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JawabanKecerdasan extends Model
{
    protected $table = 'jawaban_kecerdasans';

    protected $fillable = [
        'hasil_kecerdasan_id',
        'soal_kecerdasan_id',
        'jawaban',
        'benar',
    ];

    protected $casts = [
        'benar' => 'boolean',
    ];

    public function hasil(): BelongsTo
    {
        return $this->belongsTo(
            HasilKecerdasan::class,
            'hasil_kecerdasan_id'
        );
    }

    public function soal(): BelongsTo
    {
        return $this->belongsTo(
            SoalKecerdasan::class,
            'soal_kecerdasan_id'
        );
    }
}