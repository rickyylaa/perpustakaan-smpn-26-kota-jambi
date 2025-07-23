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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rak_baris_id')->constrained('rak_baris')->onDelete('cascade');
            $table->string('isbn')->nullable()->unique();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori');
            $table->string('pengarang');
            $table->string('penerbit')->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->integer('jumlah_eksemplar')->default(1);
            $table->text('deskripsi')->nullable();
            $table->json('cover')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
