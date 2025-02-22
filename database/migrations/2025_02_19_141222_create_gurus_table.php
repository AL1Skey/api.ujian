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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->rememberToken();
            $table->string('nama');
            $table->string('alamat');
            $table->unsignedBigInteger('mapel_id')->nullable();
            $table->foreign('mapel_id')->references('id')->on('mapels')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('agama_id')->nullable();
            $table->foreign('agama_id')->references('id')->on('agamas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
