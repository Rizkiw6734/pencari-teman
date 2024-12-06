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
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('penerima_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['pengirim_id', 'penerima_id']);
            $table->mediumText('konten');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat');
    }
};