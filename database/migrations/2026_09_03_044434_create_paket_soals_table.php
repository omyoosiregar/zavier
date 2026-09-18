<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_soals', function (Blueprint $table) {
            $table->id();

            // Nama paket
            $table->string('nama_paket');

            // Jenis tes
            $table->string('jenis_tes');

            // Keterangan paket
            $table->text('keterangan')->nullable();

            // Jumlah soal
            $table->integer('jumlah_soal');

            // Durasi dalam menit
            $table->integer('durasi');

            // Tingkat kesulitan
            $table->enum('tingkat', [
                'Mudah',
                'Sedang',
                'Sulit'
            ])->default('Sedang');

            // Status paket
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_soals');
    }
};