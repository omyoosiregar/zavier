<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_kecerdasans', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('paket_kecerdasan_id')
                ->constrained('paket_kecerdasans')
                ->cascadeOnDelete();

            $table->timestamp('started_at')->nullable();

            $table->timestamp('finished_at')->nullable();

            $table->integer('jumlah_soal')->default(0);

            $table->integer('jumlah_dijawab')->default(0);

            $table->integer('jumlah_benar')->default(0);

            $table->integer('jumlah_salah')->default(0);

            $table->decimal('nilai', 5, 2)->default(0);

            $table->string('status')->default('berjalan');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_kecerdasans');
    }
};