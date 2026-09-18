<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'jenis_tes',
        'tipe_soal',
        'keterangan',
        'jumlah_soal',
        'durasi',
        'tingkat',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KOLOM UJIAN KECERMATAN
    |--------------------------------------------------------------------------
    */

    public function kolomUjians()
    {
        return $this->hasMany(
            KolomUjian::class,
            'paket_soal_id'
        )->orderBy('nomor_kolom');
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI SOAL KEPRIBADIAN
    |--------------------------------------------------------------------------
    */

    public function soalKepribadian()
    {
        return $this->belongsToMany(
            \App\Models\SoalKepribadian::class,
            'paket_kepribadian_soal',
            'paket_soal_id',
            'soal_kepribadian_id'
        )
        ->withPivot('nomor_urut')
        ->orderBy('paket_kepribadian_soal.nomor_urut');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE KECERMATAN
    |--------------------------------------------------------------------------
    */

    public function scopeKecermatan($query)
    {
        return $query->where(
            'jenis_tes',
            'Kecermatan'
        );
    }
}