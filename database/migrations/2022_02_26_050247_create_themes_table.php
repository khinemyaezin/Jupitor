<?php

use App\Services\Utility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status')->default(Utility::$BIZ_STATUS['active']);
            $table->integer('biz_status')->default(Utility::$ROW_STATUS['normal']);
            $table->text('title');
            $table->integer('tree');
            $table->text('body')->nullable();
            
            $table->integer('max_articles')->default(1);
            $table->string('image_type')->default(Utility::$THEME_IMAGE_TYPE[1]);
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
        Schema::dropIfExists('theme');
    }
}
