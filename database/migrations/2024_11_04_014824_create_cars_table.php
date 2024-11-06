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
        Schema::create('cars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('model');
            $table->integer('tahun')->nullable();
            $table->string('plat_nomor')->nullable();
            $table->double('harga_sewa', 10, 2);
            $table->string('jumlah_kursi')->nullable();
            $table->string('bahan_bakar')->nullable();
            $table->string('transmission')->nullable();
            $table->string('slug');
            $table->enum('status', ['disewa', 'tersedia', 'tidak tersedia'])->default('tidak tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
