<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnAttributeOnSalesDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_details', function (Blueprint $table) {
            $table->decimal('rate',8,2)->change();
            $table->integer('carton')->nullable()->change();
            $table->decimal('manufacturer_rate',8,2)->nullable()->change();
            $table->decimal('total_price',8,2)->change();
            $table->decimal('discount',8,2)->nullable()->change();
            $table->decimal('tax',8,2)->nullable()->change();
            $table->decimal('paid_amount',8,2)->nullable()->change();
            $table->decimal('due_amount',8,2)->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_details', function (Blueprint $table) {
            //
        });
    }
}
