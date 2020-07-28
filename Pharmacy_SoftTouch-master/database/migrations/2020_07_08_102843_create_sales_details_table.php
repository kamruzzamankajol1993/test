<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sales_details_id',200);
            $table->string('sales_master_id',200);
            $table->bigInteger('product_id');
            $table->bigInteger('batch_id');
            $table->integer('carton');
            $table->integer('quantity');
            $table->integer('rate');
            $table->integer('manufacturer_rate');
            $table->integer('total_price');
            $table->integer('discount');
            $table->integer('tax');
            $table->integer('paid_amount');
            $table->integer('due_amount');
            $table->integer('status');
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
        Schema::dropIfExists('sales_details');
    }
}
