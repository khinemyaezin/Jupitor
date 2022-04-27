<?php

use App\Services\Utility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status')->default(Utility::$BIZ_STATUS['active']);
            $table->integer('biz_status')->default(Utility::$ROW_STATUS['normal']);
            $table->text('title');
            $table->boolean('has_title')->default(true);
            $table->text('detail')->nullable();
            $table->text('body')->nullable();
            $table->text('image_url')->nullable();
            $table->bigInteger('fk_group_id');
            $table->bigInteger('fk_theme_id');
            $table->string('detail_title')->nullable();
            $table->string('detail_image_url')->nullable();
            $table->foreign('fk_group_id')->references('id')->on('group');
            $table->foreign('fk_theme_id')->references('id')->on('theme');
            $table->integer('order');
            $table->boolean('btn_detail')->default(true);
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
        Schema::dropIfExists('article');
    }
}
