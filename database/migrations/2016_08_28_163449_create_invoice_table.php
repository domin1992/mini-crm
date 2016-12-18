<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('invoices', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('client_id');
          $table->integer('address_id');
          $table->string('invoice_number');
          $table->string('issue_city');
          $table->date('issue_date');
          $table->string('issue_name');
          $table->date('payment_date');
          $table->boolean('advance')->comment('faktura zaliczkowa')->default(false);
          $table->string('comment')->nullable();
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
      Schema::drop('invoices');
    }
}
