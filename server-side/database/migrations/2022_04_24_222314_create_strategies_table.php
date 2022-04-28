<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStrategiesTable extends Migration
{
    public function up()
    {
        Schema::create('strategies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('member_id');
            $table->integer('min_limit');
            $table->integer('max_limit');
            $table->decimal('tariff');
            $table->integer('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('strategies');
    }
}
