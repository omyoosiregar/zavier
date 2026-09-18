<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('kolom_ujians', 'waktu_detik')) {
            Schema::table('kolom_ujians', function (Blueprint $table) {
                $table->integer('waktu_detik')->default(60);
            });
        }

        if (!Schema::hasColumn('kolom_ujians', 'kunci')) {
            Schema::table('kolom_ujians', function (Blueprint $table) {
                $table->json('kunci')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Jangan hapus kolom agar data ujian tetap aman.
    }
};