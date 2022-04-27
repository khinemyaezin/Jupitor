<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_group', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fk_ptheme_id');
            $table->bigInteger('fk_ctheme_id');
            $table->foreign('fk_ptheme_id')->references('id')->on('theme');
            $table->foreign('fk_ctheme_id')->references('id')->on('theme');
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
        Schema::dropIfExists('theme_group');
    }
}
