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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('reported_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('bukti');
            $table->string('alasan');
            $table->enum('status', ['proses', 'diterima', 'ditolak'])->default('proses');
            $table->unique(['report_id', 'reported_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
