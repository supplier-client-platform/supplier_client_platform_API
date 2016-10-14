<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductEdit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('product', function (Blueprint $table) {

            $table->text('img_url')->default('http://adhilrangelfotografias.com/arquivosblog2015/sorry-image-not-available.png')->change();
            $table->string('status')->default('Draft')->change(); // Draft or Published
            $table->binary('template')->nullable()->change();
            $table->binary('custom_attr')->nullable()->change();
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
    }
}
