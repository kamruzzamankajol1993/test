<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sales_id',200);
            $table->string('customer_id',200);
            $table->date('date');
            $table->integer('grand_total');
            $table->integer('net_total');
            $table->integer('paid_amount');
            $table->integer('invoice_discount');
            $table->integer('total_discount');
            $table->integer('total_tax')->nullable();
            $table->integer('vat')->nullable();
            $table->integer('previous_due')->nullable();
            $table->integer('invoice_details')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('bank_id')->nullable();
            $table->string('sales_by')->nullable();
            $table->string('payment_type');
            $table->string('due')->nullable();
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
        Schema::dropIfExists('sales_masters');
    }
}
