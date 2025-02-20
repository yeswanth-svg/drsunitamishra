<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_langs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('blog_id');
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->string('lang')->nullable();
            $table->text('tags')->nullable();
            $table->string('author')->nullable();
            $table->longText('content')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('og_meta_title')->nullable();
            $table->text('og_meta_description')->nullable();
            $table->text('og_meta_image')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('blog_langs');
    }
}
