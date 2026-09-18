<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalKecermatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kolom_ujian_id',
        'nomor_soal',
        'pertanyaan',
        'jawaban_benar',
        'status',
    ];

    protected $casts = [
        'jawaban_benar' => 'array',
        'status' => 'boolean',
    ];

    /**
     * Soal ini berada di satu kolom ujian
     */
    public function kolomUjian()
    {
        return $this->belongsTo(
            KolomUjian::class,
            'kolom_ujian_id'
        );
    }
}