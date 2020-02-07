<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('zone_id')->unsigned();
            $table->bigInteger('record_type_id')->unsigned();
            $table->bigInteger('record_group_id')->unsigned();
            $table->string('name');
            $table->string('value');
            $table->integer('ttl')->unsigned()->nullable();
            $table->integer('priority')->unsigned()->nullable();
            $table->boolean('active')->default(true);
            $table->softDeletes(0);
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
        Schema::dropIfExists('records');
    }
}
