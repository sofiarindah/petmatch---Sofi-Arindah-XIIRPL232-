<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('permintaans', 'alasan')) {
            Schema::table('permintaans', function (Blueprint $table) {
                $table->text('alasan')->nullable()->after('pekerjaan');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('permintaans', 'alasan')) {
            Schema::table('permintaans', function (Blueprint $table) {
                $table->dropColumn('alasan');
            });
        }
    }
};
