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
        Schema::create('pinalti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->nullable()->constrained('laporan')->onDelete('cascade');
            $table->enum('jenis_hukuman', ['peringatan', 'suspend', 'banned']);
            $table->text('pesan')->nullable();
            $table->integer('durasi')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinalti');
    }
};
