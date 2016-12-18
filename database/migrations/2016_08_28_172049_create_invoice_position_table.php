<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('invoice_positions', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('invoice_id');
          $table->string('name');
          $table->integer('quantity');
          $table->string('measure_unit');
          $table->decimal('price_tax_excl', 20, 2);
          $table->integer('tax_id');
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
      Schema::drop('invoice_positions');
    }
}
