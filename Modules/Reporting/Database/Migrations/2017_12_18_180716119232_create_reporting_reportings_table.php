<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportingReportingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporting__reportings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields
            
            $table->integer('customer_id')->unsigned()->nullable();            
            $table->integer('washer_id')->unsigned()->nullable();
            $table->integer('washrequest_id')->unsigned()->nullable();
            $table->string('report_type')->comment('customer_make_report/washer_make_report');
            $table->text('report_content');
            
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
        Schema::dropIfExists('reporting__reportings');
    }
}
