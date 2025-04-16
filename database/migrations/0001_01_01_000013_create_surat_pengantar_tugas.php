<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('surat_pengantar_tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->string('nrp');
            $table->string('nama');
            $table->string('program_studi');
            $table->string('mata_kuliah');
            $table->string('dosen_pengampu');
            $table->string('instansi_tujuan');
            $table->text('alamat_instansi');
            // $table->date('tanggal_kegiatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surat_pengantar_tugas');
    }
};
