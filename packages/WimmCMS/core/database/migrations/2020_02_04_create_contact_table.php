<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->default('Contact Us');
            $table->string('nav_title')->default('Contact Us');
            $table->string('nav_icon')->nullable();
            $table->string('email');
            $table->text('content')->nullable();
            $table->boolean('show_articles')->default(true);
            $table->boolean('sort_by')->default(true);
            $table->boolean('show_thumbnail_full_page')->default(true);
            $table->boolean('show_thumbnail')->default(true);
            $table->boolean('is_private')->default(false);
            $table->boolean('show_in_footer')->default(true);
            $table->boolean('show_in_navigation')->default(true);
            $table->string('lang')->default('en');
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
        Schema::dropIfExists('contact');
    }
}
