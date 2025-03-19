<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('program_studi_admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prodi_id')->constrained('program_studi')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles');
            $table->timestamp('assigned_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('program_studi_admins');
    }
};
