<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('domain');
            $table->string('file')->nullable();
            $table->string('name_server');
            $table->string('email');
            $table->bigInteger('serial')->unsigned();
            $table->integer('refresh')->unsigned();
            $table->integer('retry')->unsigned();
            $table->integer('expire')->unsigned();
            $table->integer('minimum')->unsigned();
            $table->integer('ttl')->unsigned();
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
        Schema::dropIfExists('zones');
    }
}
