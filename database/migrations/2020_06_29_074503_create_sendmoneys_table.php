<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendmoneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sendmoneys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pin')->nullable();
            $table->string('user_id')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_number')->nullable();
            $table->string('sender_location')->nullable();
            $table->string('amount')->nullable();
            $table->string('reciver_location')->nullable();
            $table->string('reciver_name')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('sendmoneys');
    }
}
