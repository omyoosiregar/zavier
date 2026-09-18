<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | HASIL KEPRIBADIAN
        |--------------------------------------------------------------------------
        */

        Schema::create('hasil_kepribadian', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('bank_kepribadian_id')
                ->constrained('bank_kepribadian')
                ->cascadeOnDelete();

            $table->unsignedInteger('total_soal')
                ->default(0);

            $table->unsignedInteger('jumlah_dijawab')
                ->default(0);

            $table->unsignedInteger('jumlah_tidak_dijawab')
                ->default(0);

            $table->decimal('total_skor', 10, 2)
                ->default(0);

            $table->decimal('skor_maksimal', 10, 2)
                ->default(0);

            $table->decimal('persentase', 5, 2)
                ->default(0);

            $table->timestamps();
        });


        /*
        |--------------------------------------------------------------------------
        | JAWABAN KEPRIBADIAN
        |--------------------------------------------------------------------------
        */

        Schema::create('jawaban_kepribadian', function (Blueprint $table) {

            $table->id();

            $table->foreignId('hasil_kepribadian_id')
                ->constrained('hasil_kepribadian')
                ->cascadeOnDelete();

            $table->foreignId('soal_kepribadian_id')
                ->constrained('soal_kepribadian')
                ->cascadeOnDelete();

            $table->string('jawaban', 1)
                ->nullable();

            $table->text('teks_jawaban')
                ->nullable();

            $table->decimal('nilai', 5, 2)
                ->default(0);

            $table->timestamps();

            $table->unique([
                'hasil_kepribadian_id',
                'soal_kepribadian_id'
            ]);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists(
            'jawaban_kepribadian'
        );

        Schema::dropIfExists(
            'hasil_kepribadian'
        );
    }
};