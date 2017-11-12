<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer__customers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            // Your fields
            $table->string('email');
            $table->string('full_name')->nullable();
            $table->string('password');                        
            $table->string('phone_number')->nullable();
            $table->string('facebook_id')->nullable();
            
            $table->boolean('push_notification')->default(1);
            $table->boolean('first_time_login')->default(1);            
            
            // string type required to differentiate the account type is member or agent when login
            $table->string('type')->nullable()->default('customer')->comment('Determine the account type');            
            
			$table->softDeletes();
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
        Schema::dropIfExists('customer__customers');
    }
}
