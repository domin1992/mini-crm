<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pkds', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('pkd_id');
         $table->integer('level_id');
         $table->string('symbol');
         $table->string('symbol_rewrite');
         $table->string('name');
         $table->text('description')->nullable();
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
      Schema::drop('pkds');
    }
}
