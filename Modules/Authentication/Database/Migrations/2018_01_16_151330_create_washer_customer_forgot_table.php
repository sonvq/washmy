<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWasherCustomerForgotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('washer_customer_forgot', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('washer_id')->unsigned()->nullable();            
            $table->integer('customer_id')->unsigned()->nullable();
            
            $table->string('token', 255);
            $table->string('status', 255)->comment('pending/completed')->default('pending');
            $table->timestamp('completed_at')->nullable();
            
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
        Schema::dropIfExists('washer_customer_forgot');
    }
}
