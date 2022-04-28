<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWagersTable extends Migration
{
    public function up()
    {
        Schema::create('wagers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('trick_id');
            $table->unsignedBigInteger('cycle_no');
            $table->unsignedBigInteger('member_id');
            $table->integer('amount');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('monitor_at')->nullable()->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wagers');
    }
}
