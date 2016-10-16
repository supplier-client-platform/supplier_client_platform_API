<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSupplierCategoryToSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier', function (Blueprint $table) {
            $table->unsignedInteger('supplier_category_id')->nullable();
            $table->string('name');
            $table->string('contact');
            $table->string('email')->unique();
            $table->string('base_city')->nullable();
            $table->text('image');
            $table->json('address'); // DO NOT MIGRATE TILL JSON CAN BE CREATED

            // Constraints
            $table->foreign('supplier_category_id')->references('id')->on('supplier_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier', function (Blueprint $table) {
            //
        });
    }
}
