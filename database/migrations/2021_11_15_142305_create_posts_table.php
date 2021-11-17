<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title", 100);
            // $table->string("author", 100); // sostituisco con user_id per one to one con Users
            $table->unsignedBigInteger("user_id");
            $table->date("post_date");
            $table->text("post_content");
            $table->text('image_url');
            $table->string("slug", 100);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table){

            $table->dropForeign('posts_user_id_foreign');
        });

        Schema::dropIfExists('posts');
    }
}
