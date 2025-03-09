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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Penerima notifikasi
            $table->foreignId('laporan_id')->nullable()->constrained('laporan')->onDelete('cascade'); // Opsional, terkait dengan laporan
            $table->string('type')->nullable();
            $table->string('judul'); // Judul notifikasi
            $table->text('pesan'); // Isi notifikasi
            $table->string('link')->nullable(); // Link tujuan (misalnya detail laporan)
            $table->enum('status', ['unread', 'read'])->default('unread'); // Status notifikasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
