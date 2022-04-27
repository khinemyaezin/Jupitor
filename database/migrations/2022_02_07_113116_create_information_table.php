<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->string('email',500);
            $table->string('phone',100);
            $table->text('address');
            $table->text('image_url');
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('linkin')->nullable();
            $table->string('weekdays',7);
            $table->time('office_start_time', 0)->nullable();
            $table->time('office_end_time', 0)->nullable();
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
        Schema::dropIfExists('information');
    }
}
