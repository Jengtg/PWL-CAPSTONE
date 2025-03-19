<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('program_studi', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // TI, SI, MIK
            $table->timestamps();
        });


    }

    public function down()
    {
        Schema::dropIfExists('program_studi');
    }
};
