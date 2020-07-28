<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePaymentDateOnPurchaseMasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_masters', function (Blueprint $table) {
            $table->renameColumn('payment_date','purchase_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_masters', function (Blueprint $table) {
            $table->renameColumn('purchase_date','payment_date');
        });
    }
}
