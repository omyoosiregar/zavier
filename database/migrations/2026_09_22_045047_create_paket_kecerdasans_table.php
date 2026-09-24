<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_kecerdasans', function (Blueprint $table) {
            $table->id();

            $table->string('nama_paket');
            $table->text('keterangan')->nullable();

            $table->string('kategori')->nullable();

            $table->unsignedInteger('jumlah_soal')->default(0);

            $table->unsignedInteger('durasi')->default(30);

            $table->string('tingkat')->default('campuran');

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_kecerdasans');
    }
};