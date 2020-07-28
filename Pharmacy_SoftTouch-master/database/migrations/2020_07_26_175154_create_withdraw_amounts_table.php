<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_amounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('branch_id')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('check_id')->nullable();
            $table->string('checkpage_no')->nullable();
            $table->string('date')->nullable();
            $table->string('amount')->nullable();
            $table->string('signature')->nullable();
            $table->string('barreidBy')->nullable();
            $table->string('desi')->nullable();
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
        Schema::dropIfExists('withdraw_amounts');
    }
}
