<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('laporan_hasil_studi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->string('nrp');
            $table->string('nama');
            $table->string('program_studi');
            $table->string('semester');
            $table->decimal('ip_semester', 4, 2);
            $table->decimal('ipk', 4, 2);
            $table->integer('jumlah_sks');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('laporan_hasil_studi');
    }
};
