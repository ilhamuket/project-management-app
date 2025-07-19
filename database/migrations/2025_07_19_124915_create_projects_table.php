<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('paket_pekerjaan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('alamat');
            $table->string('koordinat')->nullable();
            $table->string('foto')->nullable();
            $table->string('jenis_konstruksi');
            $table->decimal('panjang', 10, 2)->nullable();
            $table->decimal('lebar', 10, 2)->nullable();
            $table->decimal('tebal', 10, 2)->nullable();
            $table->decimal('nilai_kontrak', 15, 2);
            $table->string('nama_kontraktor');
            $table->string('nama_konsultan_perencana')->nullable();
            $table->string('nama_konsultan_pengawas')->nullable();
            $table->json('dokumen_kontrak')->nullable();
            $table->enum('tipe_anggaran', ['APBD', 'APBDP']);
            $table->enum('status', ['Belum dimulai', 'Progress', 'Selesai']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};