<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanKepribadian extends Model
{
    protected $table = 'jawaban_kepribadian';


    protected $fillable = [
        'hasil_kepribadian_id',
        'soal_kepribadian_id',
        'jawaban',
        'teks_jawaban',
        'nilai',
    ];


    protected $casts = [
        'nilai' => 'decimal:2',
    ];


    public function hasil()
    {
        return $this->belongsTo(
            HasilKepribadian::class,
            'hasil_kepribadian_id'
        );
    }


    public function soal()
    {
        return $this->belongsTo(
            SoalKepribadian::class,
            'soal_kepribadian_id'
        );
    }
}