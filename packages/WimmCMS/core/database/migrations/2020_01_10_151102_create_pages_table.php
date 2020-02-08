<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('nav_title');
            $table->string('nav_icon');
            $table->text('content');
            $table->boolean('show_articles')->default(true);
            $table->boolean('sort_by')->default(true);
            $table->boolean('show_thumbnail_full_page')->default(true);
            $table->boolean('show_thumbnail')->default(true);
            $table->boolean('is_private')->default(false);
            $table->boolean('show_in_footer')->default(true);
            $table->boolean('show_in_navigation')->default(true);
            $table->boolean('show_contact_form_at_bottom_of_page')->default(true);
            $table->integer('lang')->default(1);
            $table->string('layout_type');
            $table->string('seo_desc');
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
        Schema::dropIfExists('pages');
    }
}
