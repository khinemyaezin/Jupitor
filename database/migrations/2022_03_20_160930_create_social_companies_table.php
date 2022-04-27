<?php

use App\Services\Utility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_company', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status')->default(Utility::$ROW_STATUS['normal']);
            $table->integer('biz_status')->default(Utility::$BIZ_STATUS['active']);
            $table->bigInteger('fk_information_id');
            $table->bigInteger('fk_social_id');
            $table->foreign('fk_information_id')->references('id')->on('information');
            $table->foreign('fk_social_id')->references('id')->on('social');
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
        Schema::dropIfExists('social_company');
    }
}
