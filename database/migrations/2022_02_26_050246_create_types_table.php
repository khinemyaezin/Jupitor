<?php

use App\Services\Utility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status')->default(Utility::$BIZ_STATUS['active']);
            $table->integer('biz_status')->default(Utility::$ROW_STATUS['normal']);
            $table->string('code',100)->unique();
            $table->text('title');
            $table->text('body')->nullable();
            $table->boolean('allow_detail');
            $table->boolean('allow_body');
            $table->boolean('is_unique')->default(false);
            $table->boolean('allow_pagination');
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
        Schema::dropIfExists('type');
    }
}
