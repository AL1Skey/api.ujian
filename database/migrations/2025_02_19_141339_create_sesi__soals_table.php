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
            $table->unsignedBigInteger('sesi_ujian_id')->nullable();
            $table->foreign('sesi_ujian_id')->references('id')->on('sesi__ujians')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('nomor_peserta')->nullable();
            $table->foreign('nomor_peserta')->references('nomor_peserta')->on('pesertas')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('soal_id');
            $table->foreign('soal_id')->references('id')->on('soals')->nullOnDelete()->cascadeOnUpdate();
            $table->string('tipe_soal')->nullable();
            $table->string('jawaban')->nullable();
            $table->bool('isTrue')->nullable();
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
