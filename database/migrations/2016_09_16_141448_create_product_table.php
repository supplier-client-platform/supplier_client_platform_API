<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->float('price');
            $table->float('quantity');
            $table->unsignedInteger('supplier_id');
            $table->unsignedInteger('category_id');
            $table->binary('template');
            $table->binary('custom_attr');
            /*$table->json('template');
            $table->json('custom_attr');*/  //mysql 5.5 does not support json type
            $table->timestamps();

            // constraints
            $table->foreign('supplier_id')->references('id')->on('supplier');
            $table->foreign('category_id')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product');
    }
}
