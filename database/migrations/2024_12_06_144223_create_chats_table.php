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
        $table->mediumText('konten');
        $table->enum('status', ['sent_and_read', 'sent_and_unread', 'received'])->default('sent_and_unread');
        $table->boolean('is_seen')->default(false);
        $table->timestamps();

        $table->index(['pengirim_id', 'penerima_id']);
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
