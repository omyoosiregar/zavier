<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_kecerdasan_soals', function (Blueprint $table) {

            $table->id();

            $table->foreignId('paket_kecerdasan_id')
                ->constrained('paket_kecerdasans')
                ->cascadeOnDelete();

            $table->foreignId('soal_kecerdasan_id')
                ->constrained('soal_kecerdasans')
                ->cascadeOnDelete();

            $table->unsignedInteger('nomor_urut');

            $table->timestamps();


            $table->unique([
                'paket_kecerdasan_id',
                'soal_kecerdasan_id'
            ]);

        });
    }


    public function down(): void
    {
        Schema::dropIfExists(
            'paket_kecerdasan_soals'
        );
    }
};