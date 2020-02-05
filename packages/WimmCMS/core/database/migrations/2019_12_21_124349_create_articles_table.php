<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('content');
            $table->string('cover');
            $table->string('cover_alt');
            $table->string('seo_desc');
            $table->boolean('is_private');
            $table->boolean('show_in_footer');
            $table->boolean('show_in_navigation');
            $table->integer('lang')->default(1);
            $table->integer('category_id')->unsigned();
            $table->string('is_related_to_articles')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
