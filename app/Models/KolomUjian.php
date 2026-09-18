<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KolomUjian extends Model
{
    use HasFactory;

    protected $fillable = [
        'paket_soal_id',
        'nomor_kolom',
        'waktu_detik',
        'kunci',
    ];

    protected $casts = [
        'kunci' => 'array',
    ];

    /**
     * Kolom ini milik satu paket soal
     */
    public function paketSoal()
    {
        return $this->belongsTo(
            PaketSoal::class,
            'paket_soal_id'
        );
    }

    /**
     * Satu kolom memiliki banyak soal kecermatan
     */
    public function soalKecermatan()
    {
        return $this->hasMany(
            SoalKecermatan::class,
            'kolom_ujian_id'
        )->orderBy('nomor_soal');
    }
}