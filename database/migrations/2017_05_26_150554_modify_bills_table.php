<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bills', function(Blueprint $table){
            $table->dropColumn('payment_method');
            $table->integer('payment_method_id')->after('sell_date');
            $table->boolean('paid')->default(false)->comment('0 - nie, 1 - tak')->after('payment_method_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
