<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jawaban_kecerdasans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('hasil_kecerdasan_id')
                ->constrained('hasil_kecerdasans')
                ->cascadeOnDelete();

            $table->foreignId('soal_kecerdasan_id')
                ->constrained('soal_kecerdasans')
                ->cascadeOnDelete();

            $table->string('jawaban')->nullable();

            $table->boolean('benar')->default(false);

            $table->timestamps();

            $table->unique([
                'hasil_kecerdasan_id',
                'soal_kecerdasan_id'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_kecerdasans');
    }
};