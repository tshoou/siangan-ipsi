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
        Schema::create('sarpras', function (Blueprint $table) {
            $table->string('username', 50)->primary();
            $table->string('nama', 255);
            $table->string('password', 30);
            $table->string('phone_number', 20);
            $table->string('email', 255);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('jenis_kelamin', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_sarpras');
    }
};
