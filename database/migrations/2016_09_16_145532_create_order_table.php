<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->binary('shopping_list');  // {[product_id : xxx, quantity: xxx, unit_total: xxx]}
            $table->float('gross_total');
            $table->float('discount')->default(0);  // percentage of the gross total; default = 0%
            $table->float('net_total');
            $table->timestamps();

            // constraints
            $table->foreign('customer_id')->references('id')->on('customer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order');
    }
}
