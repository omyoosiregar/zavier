<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('kolom_ujians')) {

            Schema::create('kolom_ujians', function (Blueprint $table) {

                $table->id();

                $table->foreignId('paket_soal_id')
                    ->constrained('paket_soals')
                    ->cascadeOnDelete();

                $table->integer('nomor_kolom');

                $table->integer('jumlah_soal')
                    ->default(0);

                $table->timestamps();

                $table->unique([
                    'paket_soal_id',
                    'nomor_kolom'
                ]);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kolom_ujians');
    }
};