<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('surat_keterangan_lulus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            $table->string('nrp');
            $table->string('nama');
            $table->string('program_studi');
            $table->date('tanggal_lulus');
            $table->decimal('ipk', 4, 2);
            $table->string('gelar');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('surat_keterangan_lulus');
    }
};
