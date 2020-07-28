<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameSalesIdOnSalesMasters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_masters', function (Blueprint $table) {
            $table->renameColumn('sales_id','sales_master_id');
            $table->unique('sales_master_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_masters', function (Blueprint $table) {
            $table->renameColumn('sales_master_id','sale_id');
        });
    }
}
