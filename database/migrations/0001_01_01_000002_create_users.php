<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->foreignId('prodi_id')->constrained('program_studi')->onDelete('cascade');
            $table->string('nrp', 10)->unique()->nullable(); // Untuk Mahasiswa
            $table->string('nip', 7)->unique()->nullable(); // Untuk Ketua Prodi & Tata Usaha
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
