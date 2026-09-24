<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('soal_kecerdasans', function (Blueprint $table) {
            $table->id();

            // Pertanyaan
            $table->text('pertanyaan');

            // Gambar pertanyaan
            $table->string('gambar_soal')->nullable();

            // Pilihan A
            $table->text('pilihan_a')->nullable();
            $table->string('gambar_a')->nullable();

            // Pilihan B
            $table->text('pilihan_b')->nullable();
            $table->string('gambar_b')->nullable();

            // Pilihan C
            $table->text('pilihan_c')->nullable();
            $table->string('gambar_c')->nullable();

            // Pilihan D
            $table->text('pilihan_d')->nullable();
            $table->string('gambar_d')->nullable();

            // Pilihan E
            $table->text('pilihan_e')->nullable();
            $table->string('gambar_e')->nullable();

            // Jawaban benar: A/B/C/D/E
            $table->string('jawaban_benar', 1);

            // Kategori soal
            $table->string('kategori')->nullable();

            // Tingkat kesulitan
            $table->string('tingkat')->default('sedang');

            // Pembahasan
            $table->text('pembahasan')->nullable();

            // Status aktif/nonaktif
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_kecerdasans');
    }
};