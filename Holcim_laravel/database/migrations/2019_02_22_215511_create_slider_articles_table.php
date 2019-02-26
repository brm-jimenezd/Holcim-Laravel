<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_articles', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('id_article');
            $table->foreign('id_article')->references('id')->on('articles');
            $table->string('slider_type');
            $table->string('content');
            $table->integer('order');
            $table->text('text');
            $table->string('link');
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
        Schema::dropIfExists('slider_articles');
    }
}
