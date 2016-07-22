<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("posts",function(Blueprint $table){
            $table->increments("id");
            $table->string("title");
            $table->string("description",255);
            $table->string("permalink");
            $table->string("image");
            $table->string("p_content",1000);
            $table->boolean("has_parent");
            $table->integer("parent_id");
            $table->string("target",150);
            $table->enum("status",array('published','unpublished','drafted','archived'));
            $table->boolean("featured");
            $table->string("audio");
            $table->string("video");
            $table->string("document");
            $table->string("author");
            $table->string("meta_title");
            $table->string("meta_keyword");
            $table->string("meta_description");
            $table->enum("type",array('page','post','category','custom menu','document','slideshow','document category','page block','result document','result category','event','event category'));
            $table->string("post_meta");
            $table->date("start_date");
            $table->date("end_date");
            $table->time("start_time");
            $table->time("end_time");
            $table->string("venue");
            $table->string("address");
            $table->string("frequency");
            $table->string("latitude");
            $table->string("longitude");
            $table->string("created_by");
            $table->enum("view_status",array("visible","hidden"));
            $table->integer("sortorder");
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
        //
        Schema::drop("posts");
    }
}
