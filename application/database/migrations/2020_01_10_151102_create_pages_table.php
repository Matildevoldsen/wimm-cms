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
            $table->string('description');
            $table->string('content');
            $table->integer('layout');
            $table->boolean('is_private')->default(0);
            $table->boolean('show_in_navigation')->default(0);
            $table->boolean('show_in_footer')->default(0);
            $table->integer('order');
            $table->integer('is_related_to')->default(0);
            $table->integer('lang_id');
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
