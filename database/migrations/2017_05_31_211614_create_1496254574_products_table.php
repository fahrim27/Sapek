<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1496254574ProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('cat_id')->unsigned();
                $table->foreign('cat_id', '41526_592f086e76f1b')->references('id')->on('categories')->onDelete('cascade');
                $table->string('name');
                $table->string('slug');
                $table->integer('stock')->unsigned();
                $table->integer('price')->unsigned();
                $table->string('model')->nullable();
                $table->string('primary_image');
                $table->text('descriptions')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
