<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 7);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('jenis_surat', 255);
            $table->foreignId('status_id')->constrained('statuses')->default(1);
            $table->string('file_path', 255)->nullable();
            $table->string('uploaded_by', 7)->nullable();
            $table->foreign('uploaded_by')->references('id')->on('users');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('surat');
    }
};