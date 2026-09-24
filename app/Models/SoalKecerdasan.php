<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SoalKecerdasan extends Model
{
    protected $table = 'soal_kecerdasans';


    protected $fillable = [
        'pertanyaan',
        'gambar_soal',

        'pilihan_a',
        'gambar_a',

        'pilihan_b',
        'gambar_b',

        'pilihan_c',
        'gambar_c',

        'pilihan_d',
        'gambar_d',

        'pilihan_e',
        'gambar_e',

        'jawaban_benar',

        'kategori',
        'tingkat',

        'pembahasan',

        'status',
    ];


    protected $casts = [
        'status' => 'boolean',
    ];


    /**
     * Paket-paket yang menggunakan soal ini
     */
    public function paketKecerdasan(): BelongsToMany
    {
        return $this->belongsToMany(
            PaketKecerdasan::class,
            'paket_kecerdasan_soals',
            'soal_kecerdasan_id',
            'paket_kecerdasan_id'
        )
        ->withPivot('nomor_urut');
    }
}