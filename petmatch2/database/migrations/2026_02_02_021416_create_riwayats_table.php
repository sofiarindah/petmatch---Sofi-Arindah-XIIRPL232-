<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();

            // ke users.id (AMAN, default Laravel)
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // ke hewan.id (INI YANG TADI ERROR)
            $table->foreignId('hewan_id')
                ->constrained('hewan') // 👈 SESUAI TABEL KAMU
                ->cascadeOnDelete();

            $table->enum('status', ['selesai', 'batal']);
            $table->timestamp('tanggal_adopsi');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
