<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('approval', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->onDelete('cascade');
            
            $table->string('approved_by', 7);
            $table->foreign('approved_by')->references('id')->on('users');
        
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->text('comment')->nullable();
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('approval');
    }
};
