<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('hasil_kepribadian', 'paket_soal_id')) {
            Schema::table('hasil_kepribadian', function (Blueprint $table) {
                $table->foreignId('paket_soal_id')
                    ->nullable()
                    ->after('bank_kepribadian_id')
                    ->constrained('paket_soals')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('hasil_kepribadian', 'paket_soal_id')) {
            Schema::table('hasil_kepribadian', function (Blueprint $table) {
                $table->dropForeign(['paket_soal_id']);
                $table->dropColumn('paket_soal_id');
            });
        }
    }
};
