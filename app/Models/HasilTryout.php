<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilTryout extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'jeda_selesai_pada' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paketTryout()
    {
        return $this->belongsTo(PaketTryout::class);
    }
}