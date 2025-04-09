<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('surat_keterangan_aktif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->string('nrp');
            $table->string('nama');
            $table->string('program_studi');
            $table->string('fakultas');
            $table->string('semester');
            $table->string('tahun_akademik');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surat_keterangan_aktif');
    }
};
