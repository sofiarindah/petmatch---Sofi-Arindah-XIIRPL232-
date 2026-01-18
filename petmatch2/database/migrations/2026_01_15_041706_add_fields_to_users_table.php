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
    Schema::table('users', function (Blueprint $table) {
        // Gunakan ->after('id') agar posisi kolom rapi
        // Kita gunakan 'change()' atau 'nullable()' jika kolomnya sudah ada tapi ingin diubah
        if (!Schema::hasColumn('users', 'nama')) {
            $table->string('nama')->after('id');
        }
        if (!Schema::hasColumn('users', 'username')) {
            $table->string('username')->unique()->after('nama');
        }
        // Dan seterusnya untuk kolom lain...
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
