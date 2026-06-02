<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->enum('topik', ['zakat', 'mawaris', 'haji']);
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('video_type', ['youtube', 'file'])->default('youtube'); // sumber video
            $table->string('youtube_id')->nullable();   // diisi jika video_type = 'youtube'
            $table->string('video_path')->nullable();   // diisi jika video_type = 'file'
            $table->string('durasi')->nullable();       // contoh: "18:24"
            $table->string('seri')->nullable();         // contoh: "Seri Zakat — Ep. 1"
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
