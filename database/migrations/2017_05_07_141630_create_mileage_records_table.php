<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMileageRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mileage_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mileage_id');
            $table->date('departure');
            $table->string('route_description');
            $table->string('reason');
            $table->decimal('distance', 7, 2);
            $table->decimal('rate', 20, 6);
            $table->decimal('value', 20, 6);
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('mileage_records');
    }
}
