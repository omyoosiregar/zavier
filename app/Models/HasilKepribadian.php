<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilKepribadian extends Model
{
    protected $table = 'hasil_kepribadian';

    protected $fillable = [
        'user_id',
        'bank_kepribadian_id',
        'paket_soal_id',
        'total_soal',
        'jumlah_dijawab',
        'jumlah_tidak_dijawab',
        'total_skor',
        'skor_maksimal',
        'persentase',
    ];


    protected $casts = [
        'total_skor' => 'decimal:2',
        'skor_maksimal' => 'decimal:2',
        'persentase' => 'decimal:2',
    ];


    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }


    public function bank()
    {
        return $this->belongsTo(
            BankKepribadian::class,
            'bank_kepribadian_id'
        );
    }

    public function paket()
    {
        return $this->belongsTo(
            PaketSoal::class,
            'paket_soal_id'
        );
    }


    public function jawaban()
    {
        return $this->hasMany(
            JawabanKepribadian::class,
            'hasil_kepribadian_id'
        );
    }
}