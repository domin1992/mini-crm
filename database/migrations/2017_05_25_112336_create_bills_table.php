<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('address_id');
            $table->string('bill_number');
            $table->string('issue_city');
            $table->date('issue_date');
            $table->date('sell_date');
            $table->integer('payment_method')->comment('0 - przelew, 1 - gotówka, 2 - PayU');
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
        Schema::dropIfExists('bills');
    }
}
