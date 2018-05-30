<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->string('account_name')->nullable();
            $table->string('email')->nullable();
            $table->string('package');
            $table->string('package_slug');
            $table->decimal('price_tax_excl', 20, 2);
            $table->dateTime('start_date');
            $table->boolean('finishing')->default(false);
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
        Schema::dropIfExists('hostings');
    }
}
