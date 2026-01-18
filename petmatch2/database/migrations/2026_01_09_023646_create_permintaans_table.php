<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permintaans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('hewan_id')->constrained()->cascadeOnDelete();

    // IDENTITAS CALON ADOPTER
    $table->string('nama_lengkap');
    $table->string('no_hp');
    $table->text('alamat');
    $table->string('pekerjaan');

    $table->enum('status', ['pending','diterima','ditolak'])->default('pending');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('permintaans');
    }
};
