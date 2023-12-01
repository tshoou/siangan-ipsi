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
        Schema::create('adkeu', function (Blueprint $table) {
            $table->string('username', 50)->primary();
            $table->string('nim', 50);
            $table->timestamps();

            // $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('SET NULL')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_adkeu');
    }
};
