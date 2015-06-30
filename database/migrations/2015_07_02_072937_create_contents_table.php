<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->text('body');
            $table->integer('type_id')->index()->unsigned();
            $table->integer('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('category_id')->index()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->boolean('is_excellent')->default(false)->index();
            $table->boolean('is_blocked')->default(false)->index();
            $table->boolean('is_topped')->default(false)->index();
            $table->integer('comment_count')->default(0)->index();
            $table->integer('view_count')->default(0)->index();
            $table->integer('favorite_count')->default(0)->index();
            $table->integer('vote_up_count')->default(0)->index();
            $table->integer('vote_down_count')->default(0)->index();
            $table->integer('last_comment_user_id')->index()->unsigned()->nullable();
            $table->foreign('last_comment_user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::drop('contents');
    }
}
