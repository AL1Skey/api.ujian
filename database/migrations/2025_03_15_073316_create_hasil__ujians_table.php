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
        Schema::create('hasil__ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nomor_peserta')->nullable();
            $table->unsignedBigInteger('ujian_id')->nullable();
            $table->foreign('ujian_id')->references('id')->on('ujians')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('soal_id')->nullable();
            $table->foreign('soal_id')->references('id')->on('soals')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('sesi_soal_id')->nullable();
            $table->foreign('sesi_soal_id')->references('id')->on('sesi__soals')->nullOnDelete()->cascadeOnUpdate();
            $table->string('tipe_soal')->nullable();
            $table->string('jawaban_soal')->nullable();
            $table->string('jawaban_sesi')->nullable();
            $table->boolean('isTrue')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil__ujians');
    }
};
