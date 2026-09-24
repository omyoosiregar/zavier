<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HasilKecerdasan extends Model
{
    protected $table = 'hasil_kecerdasans';

    protected $fillable = [
        'user_id',
        'paket_kecerdasan_id',
        'started_at',
        'finished_at',
        'jumlah_soal',
        'jumlah_dijawab',
        'jumlah_benar',
        'jumlah_salah',
        'nilai',
        'status',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'nilai' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(
            PaketKecerdasan::class,
            'paket_kecerdasan_id'
        );
    }

    public function jawaban(): HasMany
    {
        return $this->hasMany(
            JawabanKecerdasan::class,
            'hasil_kecerdasan_id'
        );
    }
}