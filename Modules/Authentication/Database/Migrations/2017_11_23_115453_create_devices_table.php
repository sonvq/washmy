<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('washer_id')->unsigned()->nullable();            
            $table->integer('customer_id')->unsigned()->nullable();

            $table->string('device_token', 255);
            $table->string('device_type', 255);
            $table->string('player_id', 255);
            
            $table->string('type', 255)->comment('washer/customer type');
            
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
        Schema::dropIfExists('devices');
    }
}
