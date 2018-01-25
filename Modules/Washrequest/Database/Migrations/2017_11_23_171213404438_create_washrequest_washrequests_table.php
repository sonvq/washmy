<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWashrequestWashrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('washrequest__washrequests', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            $table->string('type', 255)
                    ->comment('saloon_hatchback_mini_van - Saloon/Hatchback/Mini Van | mpv_suv_van - MPV / SUV / VAN type'); 
            $table->integer('customer_id')->unsigned()->nullable();
            $table->string('car_plate_no', 255);
            $table->string('car_color', 255);
            $table->string('street_name', 255);
            $table->string('block_no', 255);
            $table->string('level', 255);
            $table->string('car_park_lot_no', 255);
            $table->text('notes')->nullable();
            $table->string('status')->default('user_requesting')
                ->comment('user_requesting / user_declined / user_accept_pay / user_payment_done / user_cancel_request / user_confirm_request '
                        . '/ washer_accepted / washer_washing / washer_done ');
            
            $table->string('payment_method')->default('cash')
                    ->comment('posb_paynow / dbs_paylah / ocbc_pay_anyone / cash');
            
            $table->integer('washer_id')->unsigned()->nullable();
            // Your fields
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
        Schema::dropIfExists('washrequest__washrequests');
    }
}
