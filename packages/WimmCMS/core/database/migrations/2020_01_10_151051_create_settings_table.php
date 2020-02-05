<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('head')->nullable(); //Excluding title, meta description, author. This is primarily used for google analytics and similar.
            $table->string('description');
            $table->string('logo')->nullable();
            $table->string('favicon')->default('favicon.ico');
            $table->string('author');
            $table->boolean('construction')->default(0);
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
        Schema::dropIfExists('settings');
    }
}
