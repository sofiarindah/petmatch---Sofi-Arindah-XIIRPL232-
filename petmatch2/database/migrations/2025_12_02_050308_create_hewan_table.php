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
        Schema::create('hewan', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('jenis');
            $table->string('umur'); // text-based (e.g. "2 tahun")

            $table->enum('gender', ['jantan', 'betina']);

            $table->text('deskripsi')->nullable();

            $table->string('foto')->nullable();

            $table->enum('kondisi', ['Baik', 'Sakit'])->default('Baik');

            $table->enum('status', ['tersedia', 'diadopsi'])->default('tersedia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hewan');
    }
};
