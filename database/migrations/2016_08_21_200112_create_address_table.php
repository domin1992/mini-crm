<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('addresses', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('client_id');
          $table->string('name');
          $table->string('street');
          $table->string('street_number', 10);
          $table->string('apartment_number', 10)->nullable();
          $table->string('city');
          $table->string('postcode');
          $table->string('country');
          $table->text('other')->nullable();
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
      Schema::drop('addresses');
    }
}
