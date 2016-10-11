<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->string('brand')->default('generic');
            $table->string('img_url')->default('http://tse3.mm.bing.net/th?id=OIP.M0513e15231fdab2fde41fde1a4701868o0');
            $table->string('status')->default('drafted');   // drafted or published
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            //
        });
    }
}
