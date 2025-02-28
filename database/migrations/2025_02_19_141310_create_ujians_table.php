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
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelompok_id')->nullable();
            $table->foreign('kelompok_id')->references('id')->on('kelompok__ujians')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('mapel_id')->nullable();
            $table->foreign('mapel_id')->references('id')->on('mapels')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->foreign('kelas_id')->references('id')->on('daftar__kelas')->nullOnDelete()->cascadeOnUpdate();
            $table->string('nama');
            $table->string('id_sekolah')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujians');
    }
};
