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
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nomor_peserta')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->foreign('kelas_id')->references('id')->on('daftar__kelas');
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->unsignedBigInteger('tingkatan_id')->nullable();
            $table->foreign('tingkatan_id')->references('id')->on('tingkatans');
            $table->foreign('jurusan_id')->references('id')->on('jurusans');
            $table->unsignedBigInteger('agama_id')->nullable();
            $table->foreign('agama_id')->references('id')->on('agamas');
            // $table->boolean('isDeleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
