<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePurchaseMasterIdOnPurchaseDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_masters', function (Blueprint $table) {
            $table->renameColumn('purchase_id','purchase_master_id');
            $table->unique('purchase_master_id');
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
            $table->renameColumn('purchase_master_id','purchase_id');
        });
    }
}
