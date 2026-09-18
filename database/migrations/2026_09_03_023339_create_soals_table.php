<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->id();

            $table->string('kategori');
            $table->text('pertanyaan');

            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c');
            $table->string('pilihan_d');
            $table->string('pilihan_e');

            $table->enum('jawaban_benar', [
                'A',
                'B',
                'C',
                'D',
                'E'
            ]);

            $table->enum('tingkat', [
                'Mudah',
                'Sedang',
                'Sulit'
            ])->default('Sedang');

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};