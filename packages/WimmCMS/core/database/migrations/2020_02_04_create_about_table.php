<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->default('About Us');
            $table->string('nav_title')->default('About Us');
            $table->string('nav_icon')->nullable();
            $table->text('content')->nullable();
            $table->boolean('show_articles')->nullable()->default(false);
            $table->boolean('sort_by')->nullable()->default(true);
            $table->boolean('show_thumbnail_full_page')->default(true);
            $table->boolean('show_thumbnail')->default(true);
            $table->boolean('is_private')->default(false);
            $table->boolean('show_in_footer')->default(true);
            $table->boolean('show_in_navigation')->default(true);
            $table->boolean('show_contact_form_at_bottom_of_page')->default(false);
            $table->integer('lang')->default(2);
            $table->string('layout_type')->nullable();
            $table->string('seo_desc')->nullable();
            $table->string('thumbnail');
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
        Schema::dropIfExists('about');
    }
}


