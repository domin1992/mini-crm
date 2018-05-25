<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->nullable();
            $table->string('slug');
            $table->integer('contract_type_id');
            $table->integer('contract_sign_method_id');
            $table->string('email');
            $table->text('predefined_fields')->nullable();
            $table->text('fields')->nullable();
            $table->boolean('signed')->default(false);
            $table->dateTime('signed_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('sms_code')->nullable();
            $table->dateTime('sms_code_sent_date')->nullable();
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
        Schema::dropIfExists('contracts');
    }
}
