<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Master Paket Tryout
        Schema::create('paket_tryouts', function (Blueprint $table) {
            $table->id();
            $table->string('judul_tryout');
            $table->text('deskripsi')->nullable();
            
            // Relasi ke masing-masing paket ujian/bank soal
            $table->unsignedBigInteger('paket_kecerdasan_id')->nullable();
            $table->unsignedBigInteger('paket_kepribadian_id')->nullable();
            $table->unsignedBigInteger('paket_kecermatan_id')->nullable();

            $table->integer('jeda_menit')->default(5); // Default jeda 5 menit
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Tabel Rekap Hasil Tryout Siswa
        Schema::create('hasil_tryouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('paket_tryout_id')->constrained('paket_tryouts')->onDelete('cascade');
            
            // Status tahapan: 'kecerdasan', 'jeda_1', 'kepribadian', 'jeda_2', 'kecermatan', 'selesai'
            $table->string('tahap_sekarang')->default('kecerdasan');
            $table->timestamp('jeda_selesai_pada')->nullable();

            // Nilai Masing-masing Subtes (Skala 100)
            $table->decimal('nilai_kecerdasan', 5, 2)->default(0);
            $table->decimal('nilai_kepribadian', 5, 2)->default(0);
            $table->decimal('nilai_kecermatan', 5, 2)->default(0);
            $table->decimal('nilai_akhir', 5, 2)->default(0);
            $table->string('status_kelulusan')->default('TIDAK MEMENUHI SYARAT'); // MS / TMS

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_tryouts');
        Schema::dropIfExists('paket_tryouts');
    }
};