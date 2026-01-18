<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('permintaans', function (Blueprint $table) {
        $table->string('nama_lengkap');
        $table->string('no_hp');
        $table->string('pekerjaan');
        $table->text('alamat');
        $table->text('alasan')->nullable();
    });
}

public function down()
{
    Schema::table('permintaans', function (Blueprint $table) {
        $table->dropColumn([
            'nama_lengkap',
            'no_hp',
            'pekerjaan',
            'alamat',
            'alasan'
        ]);
    });
}

};
