<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('jenis');
            $table->integer('umur');
            $table->text('deskripsi')->nullable();

            $table->string('foto')->nullable();

            $table->enum('kondisi', ['Baik', 'Sakit'])->default('Baik');
            $table->enum('status', ['tersedia', 'diadopsi'])->default('tersedia');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
