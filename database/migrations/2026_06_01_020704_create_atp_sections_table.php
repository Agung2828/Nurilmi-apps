<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('atp_sections', function (Blueprint $table) {
            $table->id();
            // Tipe section: cp | tp | timeline | topik
            $table->enum('tipe', ['cp', 'tp', 'timeline', 'topik']);
            // Topik: zakat | mawaris | haji (untuk filter tab & badge warna)
            $table->enum('topik', ['zakat', 'mawaris', 'haji']);
            $table->string('judul');          // Judul utama section
            $table->string('sub_judul')->nullable(); // Sub judul / badge label
            $table->text('isi');              // Deskripsi / konten utama
            $table->string('icon')->nullable(); // Emoji icon
            $table->string('badge_style')->nullable(); // Inline style untuk badge
            $table->string('minggu')->nullable(); // Untuk timeline: "Pertemuan 1-2 · Zakat"
            $table->string('chips')->nullable(); // JSON: ["Tatap Muka","Diskusi"]
            $table->string('tags')->nullable();  // JSON: ["C1 Mengingat","C2 Memahami"]
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atp_sections');
    }
};
