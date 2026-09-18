<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('bank_kepribadian', function (Blueprint $table) {
            $table->id(); $table->string('nama_bank'); $table->text('deskripsi')->nullable(); $table->boolean('status')->default(true); $table->timestamps();
        });
        Schema::create('soal_kepribadian', function (Blueprint $table) {
            $table->id(); $table->foreignId('bank_kepribadian_id')->constrained('bank_kepribadian')->cascadeOnDelete();
            $table->unsignedInteger('nomor_soal'); $table->text('pertanyaan');
            $table->text('pilihan_a')->nullable(); $table->text('pilihan_b')->nullable(); $table->text('pilihan_c')->nullable(); $table->text('pilihan_d')->nullable(); $table->text('pilihan_e')->nullable();
            $table->string('kunci_jawaban',1)->nullable(); $table->decimal('nilai',8,2)->default(1); $table->boolean('status')->default(true); $table->timestamps();
            $table->unique(['bank_kepribadian_id','nomor_soal']);
        });
        Schema::create('paket_kepribadian_soal', function (Blueprint $table) {
            $table->id(); $table->foreignId('paket_soal_id')->constrained('paket_soals')->cascadeOnDelete();
            $table->foreignId('soal_kepribadian_id')->constrained('soal_kepribadian')->cascadeOnDelete(); $table->unsignedInteger('nomor_urut'); $table->timestamps();
            $table->unique(['paket_soal_id','soal_kepribadian_id']); $table->unique(['paket_soal_id','nomor_urut']);
        });
    }
    public function down(): void { Schema::dropIfExists('paket_kepribadian_soal'); Schema::dropIfExists('soal_kepribadian'); Schema::dropIfExists('bank_kepribadian'); }
};
