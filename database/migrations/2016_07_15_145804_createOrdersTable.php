<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create("orders",function(Blueprint $table){
            $table->increments("id");
            $table->string("bag_size");
	        $table->string("orientation",25);
            $table->string("background_type",50);
            $table->string("background",50);
            $table->string("logo",1000);
            $table->string("design_text",500);
            $table->string("text_font",25);
            $table->string("finishing",100);
	        $table->string("bag_handles",1000);
            $table->integer("cust_id",false,true);
            $table->string("email",225);
            $table->string("phone",50);
            $table->string("address",1000);
            $table->string("city",100);
            $table->string("state",50);
            $table->string("country",100);
            $table->decimal("price",10,2);

            $table->foreign("cust_id")->references("id")->on("customers")->onUpdate("cascade")->onDelete("cascade");
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
        Schema::drop("orders");
    }
}
