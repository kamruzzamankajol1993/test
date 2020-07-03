<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivemoneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivemoneys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pin')->nullable();
            $table->string('user_id')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_number')->nullable();
            $table->string('sender_location')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('receive_amount')->nullable();
            $table->string('reciver_nidnumber')->nullable();
            $table->string('copy')->nullable();
            $table->string('status')->default(0);
            $table->string('date')->nullable();
            $table->string('time')->nullable();
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
        Schema::dropIfExists('receivemoneys');
    }
}
