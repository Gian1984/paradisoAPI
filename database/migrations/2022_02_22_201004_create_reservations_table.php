<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('startdate');
            $table->string('finishdate');
            $table->string('starttime');
            $table->string(    'finishtime');
            $table->string( 'slot_id');
            $table->tinyInteger('fullday');
            $table->string('guests');
            $table->string('amount');
            $table->string( 'product_id');
            $table->string(  'transactionID');
            $table->string('cardBrand');
            $table->string('lastFour');
            $table->string('expire');
            $table->string('language');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
