<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_langs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('page_id');
            $table->string('lang')->nullable();
            $table->text('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('slug')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('og_meta_description')->nullable();
            $table->text('og_meta_title')->nullable();
            $table->text('og_meta_image')->nullable();
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
        Schema::dropIfExists('page_langs');
    }
}
