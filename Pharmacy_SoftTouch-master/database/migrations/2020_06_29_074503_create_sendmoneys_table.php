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
            $table->string('branch_id')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_number')->nullable();
            $table->string('sender_location')->nullable();
            $table->string('sender_nid')->nullable();
            $table->string('amount')->nullable();
            $table->string('cost')->nullable();
            $table->string('receiver_location')->nullable();
            $table->string('receiver_number')->nullable();
            $table->string('receiver_nid')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('status')->default(0);
            $table->string('get_status')->default(1);
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
