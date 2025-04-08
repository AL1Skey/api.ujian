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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('nama');
            $table->string('alamat');
            $table->unsignedBigInteger('mapel_id')->nullable();
            $table->foreign('mapel_id')->references('id')->on('mapels')->nullOnDelete()->cascadeOnUpdate();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('agama_id')->nullable();
            $table->foreign('agama_id')->references('id')->on('agamas')->nullOnDelete()->cascadeOnUpdate();
            $table->boolean('isDeleted')->default(false);
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
