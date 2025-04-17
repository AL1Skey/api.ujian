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
        Schema::create('sesi__ujians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_id')->nullable();
            $table->foreign('ujian_id')->references('id')->on('ujians')->nullOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('nomor_peserta')->nullable();
            $table->foreign('nomor_peserta')->references('nomor_peserta')->on('pesertas')->nullOnDelete()->cascadeOnUpdate();
            $table->boolean('isTrue')->default(false);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi__ujians');
    }
};
