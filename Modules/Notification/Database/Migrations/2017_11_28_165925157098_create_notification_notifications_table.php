<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification__notifications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields
            
            $table->integer('sender_id')->unsigned()->nullable();
            $table->string('sender_type')->comment('customer/washer');
            $table->integer('receiver_id')->unsigned()->nullable();
            $table->string('receiver_type')->comment('customer/washer');
            
            $table->string('title')->nullable();
            $table->text('message')->nullable();
            $table->string('message_type')->nullable();
            $table->boolean('is_new')->default(1);
            $table->boolean('is_read')->default(0);
            
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
        Schema::dropIfExists('notification__notifications');
    }
}
