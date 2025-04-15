<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 7);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('action');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('logs');
    }
};