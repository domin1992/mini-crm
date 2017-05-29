<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_id');
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
        Schema::dropIfExists('bill_positions');
    }
}
