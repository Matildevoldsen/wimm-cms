<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('desc');
            $table->string('seo_desc');
            $table->string('thumbnail')->nullable();
            $table->boolean('is_private');
            $table->boolean('show_in_footer');
            $table->boolean('show_in_navigation');
            $table->string('thumbnail_alt');
            $table->integer('top_category_id');
            $table->integer('lang')->default(1);
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
        Schema::dropIfExists('categories');
    }
}
