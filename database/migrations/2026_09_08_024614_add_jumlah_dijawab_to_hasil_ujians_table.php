<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_ujians', function (Blueprint $table) {
            $table->json('jumlah_dijawab')
                ->nullable()
                ->after('nilai_kolom');
        });
    }

    public function down(): void
    {
        Schema::table('hasil_ujians', function (Blueprint $table) {
            $table->dropColumn('jumlah_dijawab');
        });
    }
};