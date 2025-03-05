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
        Schema::create('notif_laporans', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // ID user yang menerima notifikasi
            $table->string('type'); // Jenis notifikasi (misalnya: 'peringatan', 'penolakan')
            $table->text('message'); // Pesan notifikasi
            $table->boolean('is_read')->default(false); // Status notifikasi (sudah dibaca atau belum)
            $table->string('link')->nullable(); // Link tujuan (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at

            // Foreign key ke tabel users
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Jika user dihapus, notifikasinya juga dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notif_laporans');
    }
};
