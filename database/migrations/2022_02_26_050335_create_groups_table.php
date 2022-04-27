<?php

use App\Services\Utility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status')->default(Utility::$BIZ_STATUS['active']);
            $table->integer('biz_status')->default(Utility::$ROW_STATUS['normal']);
            $table->integer('order');
            $table->text('title');
            $table->boolean('has_title')->default(true);
            $table->text('highlight')->nullable();
            $table->bigInteger('fk_group_theme_id')->nullable();
            $table->bigInteger('fk_type_id')->nullable();
            $table->foreign('fk_type_id')->references('id')->on('type');
            $table->foreign('fk_group_theme_id')->references('id')->on('theme');
            $table->boolean('on_navbar')->default(false);
            $table->boolean('on_home')->default(false);
            $table->boolean('dropdown_on_navbar')->default(false);
            $table->boolean('show_all')->default(false);
            $table->integer('max_items')->default(3);
            $table->text('image_url')->nullable();
            $table->binary('html')->nullable();
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
        Schema::dropIfExists('group');
    }
}
