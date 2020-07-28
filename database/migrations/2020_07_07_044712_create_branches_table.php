<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('branch_id')->nullable();
            $table->string('sub_branch_id')->nullable();
            $table->string('detail')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('add')->nullable();
            $table->string('mpass')->nullable();
            $table->string('add_by')->nullable();
            $table->integer('amount')->default(0);
            $table->string('fund_status')->default(2);
            $table->string('mstatus')->default(1);
            $table->string('address')->nullable();
            $table->string('name')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('branches');
    }
}
