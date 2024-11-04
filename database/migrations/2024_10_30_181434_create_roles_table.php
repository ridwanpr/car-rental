<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('roles')->insert([
            ['id' => 'user', 'name' => 'User', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 'admin', 'name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
