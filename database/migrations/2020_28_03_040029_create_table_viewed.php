<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableViewed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('viewed', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('story_id')->unsigned()->index();
          $table->foreign('story_id')->references('id')->on('stories')->onDelete('cascade');
          $table->bigInteger('chapter_id')->unsigned()->index();
          $table->foreign('chapter_id')->references('id')->on('chapters')->onDelete('cascade');
          $table->integer('user_id')->unsigned()->index();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('viewed');
    }
}
