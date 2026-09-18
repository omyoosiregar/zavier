<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soal_kecermatans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('kolom_ujian_id')
                ->constrained('kolom_ujians')
                ->cascadeOnDelete();

            $table->unsignedInteger('nomor_soal');

            $table->string('pertanyaan');

            $table->string('jawaban_benar', 1);

            $table->boolean('status')
                ->default(true);

            $table->timestamps();

            $table->unique([
                'kolom_ujian_id',
                'nomor_soal'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soal_kecermatans');
    }
};