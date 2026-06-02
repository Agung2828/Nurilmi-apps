<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->enum('topik', ['zakat', 'mawaris', 'haji']);
            $table->string('judul');
            $table->string('sub_judul')->nullable();
            $table->text('konten');         // isi materi HTML/teks
            $table->string('pdf')->nullable(); // path file PDF
            $table->string('badge')->nullable(); // contoh: "Pertemuan 1"
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
