<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kuis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');                          // Zakat — Konsep Dasar
            $table->enum('topik', ['zakat', 'mawaris', 'haji']); // filter tab
            $table->enum('kesulitan', ['mudah', 'sedang', 'sulit']);
            $table->string('icon')->default('📝');            // emoji icon
            $table->text('deskripsi')->nullable();
            $table->integer('durasi_menit')->default(20);     // batas waktu
            $table->integer('skor_lulus')->default(75);       // passing grade
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};
