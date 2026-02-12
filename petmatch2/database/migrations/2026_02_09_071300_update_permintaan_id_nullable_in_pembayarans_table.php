<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('pembayarans', 'permintaan_id')) {
            Schema::table('pembayarans', function (Blueprint $table) {
                $table->dropColumn('permintaan_id');
            });
        }

        Schema::table('pembayarans', function (Blueprint $table) {
            if (!Schema::hasColumn('pembayarans', 'permintaan_id')) {
                $table->foreignId('permintaan_id')
                    ->nullable()
                    ->constrained('permintaans')
                    ->nullOnDelete()
                    ->after('user_id');
            }
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('pembayarans', 'permintaan_id')) {
            Schema::table('pembayarans', function (Blueprint $table) {
                $table->dropForeign(['permintaan_id']);
                $table->dropColumn('permintaan_id');
            });
        }
    }
};
