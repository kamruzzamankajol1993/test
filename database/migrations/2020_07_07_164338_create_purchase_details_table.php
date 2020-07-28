<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchase_details_id',200);
            $table->string('purchase_id',200);
            $table->bigInteger('product_id');
            $table->integer('quantity');
            $table->integer('rate');
            $table->integer('total_amount');
            $table->integer('discount');
            $table->integer('batch_id');
            $table->integer('expire_date');
            $table->boolean('status');
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
        Schema::dropIfExists('purchase_details');
    }
}
