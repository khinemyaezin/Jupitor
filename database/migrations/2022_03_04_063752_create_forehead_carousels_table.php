<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeheadCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forehead_carousel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->text('body');
            $table->bigInteger('fk_forehead_id');
            $table->integer('order')->uniqid();
            $table->text('image_url');
            $table->bigInteger('fk_group_id')->nullable();
            $table->foreign('fk_forehead_id')->references('id')->on('forehead');
            $table->foreign('fk_group_id')->references('id')->on('group');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forehead_carousel');
    }
}
