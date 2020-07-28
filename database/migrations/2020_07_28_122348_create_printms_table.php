<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printms', function (Blueprint $table) {
            $table->increments('id');
             $table->string('user_id')->nullable();
            $table->string('branch_id')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('branch')->nullable();
            $table->string('accountnumber')->nullable();
            $table->string('amount')->default(0);
            $table->string('depositeBy')->nullable();
            $table->string('status')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('printms');
    }
}
