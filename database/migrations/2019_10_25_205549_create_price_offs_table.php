<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_offs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id')->unsigned();
                $table->foreign('pro_id', '41526_592f086e76ffe')->references('id')->on('products')->onDelete('cascade');
            $table->integer('discount');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_offs');
    }
}
