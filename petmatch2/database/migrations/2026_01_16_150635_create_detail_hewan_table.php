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
    Schema::create('detail_hewan', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('jenis');
    $table->integer('umur');
    $table->text('deskripsi');
    $table->string('foto')->nullable();
    $table->string('kondisi');
    $table->string('status');
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->timestamps();
});

}

public function down(): void
{
    Schema::dropIfExists('detail_hewan');
}

};
