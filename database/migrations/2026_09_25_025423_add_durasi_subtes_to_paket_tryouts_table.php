<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('paket_tryouts', function (Blueprint $table) {
            if (!Schema::hasColumn('paket_tryouts', 'durasi_kecerdasan')) {
                $table->integer('durasi_kecerdasan')->default(90)->nullable();
            }
            if (!Schema::hasColumn('paket_tryouts', 'durasi_kepribadian')) {
                $table->integer('durasi_kepribadian')->default(60)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paket_tryouts', function (Blueprint $table) {
            if (Schema::hasColumn('paket_tryouts', 'durasi_kecerdasan')) {
                $table->dropColumn('durasi_kecerdasan');
            }
            if (Schema::hasColumn('paket_tryouts', 'durasi_kepribadian')) {
                $table->dropColumn('durasi_kepribadian');
            }
        });
    }
};