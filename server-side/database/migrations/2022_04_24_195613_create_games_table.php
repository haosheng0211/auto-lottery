<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('cycle_id')->nullable();
            $table->unsignedBigInteger('cycle_no')->nullable();
            $table->boolean('active')->nullable();
            $table->timestamp('stopped_at')->nullable()->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }
}
