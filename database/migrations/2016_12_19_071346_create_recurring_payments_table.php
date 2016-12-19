<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurringPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('recurring_payments', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('client_id');
        $table->string('name');
        $table->text('description')->nullable();
        $table->integer('period_count');
        $table->integer('period')->comment('1 - day, 2 - week, 3 - month, 4 - year');
        $table->dateTime('period_start');
        $table->decimal('price', 8, 2);
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
      Schema::drop('recurring_payments');
    }
}
