<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_ujians', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('paket_soal_id')
                ->constrained('paket_soals')
                ->cascadeOnDelete();

            $table->json('nilai_kolom');

            $table->unsignedInteger('total_benar')
                ->default(0);

            $table->unsignedInteger('total_soal')
                ->default(0);

            $table->decimal('nilai', 5, 2)
                ->default(0);

            $table->string('kategori')
                ->nullable();

            $table->text('keterangan')
                ->nullable();

            $table->timestamp('mulai_pada')
                ->nullable();

            $table->timestamp('selesai_pada')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_ujians');
    }
};