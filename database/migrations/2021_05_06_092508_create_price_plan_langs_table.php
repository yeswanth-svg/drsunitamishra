<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricePlanLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_plan_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('price_plan_id')->nullable();;
            $table->string('title')->nullable();;
            $table->string('type')->nullable();;
            $table->longText('features')->nullable();;
            $table->string('btn_text')->nullable();;
            $table->string('lang')->nullable();
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
        Schema::dropIfExists('price_plan_langs');
    }
}
