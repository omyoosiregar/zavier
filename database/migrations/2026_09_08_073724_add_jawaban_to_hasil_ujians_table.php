<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_ujians', function (Blueprint $table) {
            $table->json('jawaban')
                ->nullable()
                ->after('jumlah_dijawab');
        });
    }

    public function down(): void
    {
        Schema::table('hasil_ujians', function (Blueprint $table) {
            $table->dropColumn('jawaban');
        });
    }
};