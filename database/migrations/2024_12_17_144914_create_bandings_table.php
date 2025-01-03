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
        Schema::create('banding', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinalti_id')->constrained('pinalti')->onDelete('cascade');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->enum('jenis_hukuman', ['peringatan', 'suspend', 'banned']);
            $table->enum('status', ['proses', 'diterima', 'ditolak'])->default('proses');
            $table->text('alasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banding');
    }
};
