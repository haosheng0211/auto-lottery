<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksTable extends Migration
{
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('wager_id');
            $table->unsignedBigInteger('trick_id');
            $table->unsignedBigInteger('cycle_no');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('strategy_id');
            $table->integer('amount');
            $table->integer('status');
            $table->longText('stop_message')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tracks');
    }
}
