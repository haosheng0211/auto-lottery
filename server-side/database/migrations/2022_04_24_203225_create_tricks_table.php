<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTricksTable extends Migration
{
    public function up()
    {
        Schema::create('tricks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tricks');
    }
}
