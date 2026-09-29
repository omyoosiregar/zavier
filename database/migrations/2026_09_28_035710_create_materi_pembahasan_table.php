<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi_pembahasans', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Contoh: Pembahasan 1: Materi Logika Penalaran & Pola Gambar
            $table->string('kategori')->default('Kecerdasan'); // Kecerdasan / Kepribadian / Kecermatan / Umum
            $table->text('deskripsi')->nullable();
            $table->string('file_path'); // Lokasi file tersimpan (PDF, Image, DOCX, TXT)
            $table->string('file_name')->nullable(); // Nama asli file
            $table->string('file_extension', 10)->nullable(); // pdf, png, jpg, docx, txt
            $table->longText('konten_teks')->nullable(); // Jika file teks/ekstraksi teks langsung
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi_pembahasans');
    }
};