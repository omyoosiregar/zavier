<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('paket_soals', function (Blueprint $table) {
            $table->string('tipe_soal')
                ->default('Angka')
                ->after('jenis_tes');
        });
    }

    public function down(): void
    {
        Schema::table('paket_soals', function (Blueprint $table) {
            $table->dropColumn('tipe_soal');
        });
    }
};