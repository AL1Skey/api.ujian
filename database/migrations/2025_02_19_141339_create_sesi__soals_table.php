<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sesi__soals', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->unsignedBigInteger('ujian_id')->nullable();
            $table->foreign('ujian_id')->references('id')->on('ujians')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('nomor_peserta')->nullable();
            $table->foreign('nomor_peserta')->references('nomor_peserta')->on('pesertas')->nullOnDelete()->cascadeOnUpdate();
=======
            
            $table->unsignedBigInteger('nomor_peserta')->nullable();
            $table->foreign('nomor_peserta')->references('nomor_peserta')->on('pesertas')->nullOnDelete()->cascadeOnUpdate();
            
            $table->unsignedBigInteger('ujian_id')->nullable();
            $table->foreign('ujian_id')->references('id')->on('ujians')->nullOnDelete()->cascadeOnUpdate();
        
>>>>>>> f6925f0209e602d33cfce465645b0879fee9227d
            $table->unsignedBigInteger('soal_id')->nullable();
            $table->foreign('soal_id')->references('id')->on('soals')->nullOnDelete()->cascadeOnUpdate();
        
            $table->string('tipe_soal')->nullable();
            $table->string('jawaban')->nullable();
            $table->boolean('isTrue')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi__soals');
    }
};
