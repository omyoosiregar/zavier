<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketTryout extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * 1. Relasi ke Paket Soal Kecerdasan
     */
    public function paketKecerdasan()
    {
        return $this->belongsTo(PaketKecerdasan::class, 'paket_kecerdasan_id');
    }

    /**
     * 2. Relasi ke Paket Soal Kepribadian
     */
    public function paketKepribadian()
    {
        if (class_exists(\App\Models\PaketKepribadian::class)) {
            return $this->belongsTo(\App\Models\PaketKepribadian::class, 'paket_kepribadian_id');
        }
        return $this->belongsTo(PaketSoal::class, 'paket_kepribadian_id');
    }

    /**
     * 3. Relasi ke Paket Soal Kecermatan
     */
    public function paketKecermatan()
    {
        return $this->belongsTo(PaketSoal::class, 'paket_kecermatan_id');
    }

    /**
     * 4. Relasi ke Rekap Hasil Tryout Siswa
     */
    public function hasilTryouts()
    {
        return $this->hasMany(HasilTryout::class);
    }
}