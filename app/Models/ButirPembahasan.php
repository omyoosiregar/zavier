<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButirPembahasan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function modul()
    {
        return $this->belongsTo(ModulPembahasan::class, 'modul_pembahasan_id');
    }
}