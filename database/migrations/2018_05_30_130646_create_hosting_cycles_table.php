<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostingCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosting_cycles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hosting_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('period_count');
            $table->integer('period')->comment('1 - day, 2 - week, 3 - month, 4 - year');
            $table->boolean('paid')->Default(false);
            $table->decimal('price_tax_excl', 20, 2)->nullable();
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
        Schema::dropIfExists('hosting_cycles');
    }
}
