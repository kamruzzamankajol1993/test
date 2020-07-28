<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseMasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('chalan_no',200);
            $table->string('purchase_id',200);
            $table->string('supplier_id',200);
            $table->string('payment_date',200);
            $table->string('purchase_details',200);
            $table->bigInteger('grand_total');
            $table->bigInteger('bank_id');
            $table->string('payment_type');
            $table->bigInteger('total_discount');
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
        Schema::dropIfExists('purchase_masters');
    }
}
