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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->integer('id_peminjaman', true);
            $table->string('nim', 50);
            $table->integer('id_ruangan');
            $table->string('nama_kegiatan', 255);
            $table->integer('jumlah_peserta');
            $table->string('tujuan_peminjaman', 255);
            $table->date('tgl_pengajuan');
            $table->date('tgl_peminjaman');
            $table->date('tgl_selesai');
            $table->string('ktm_digital', 50);
            $table->string('surat_peminjaman', 250);
            $table->string('status_revisi', 50);
            $table->string('status_peminjaman', 50);
            $table->string('surat_terbit', 50);
            $table->timestamps();

            // $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('SET NULL')->onUpdate('CASCADE');
            // $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangan')->onDelete('SET NULL')->onUpdate('CASCADE');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_peminjaman');
    }
};
