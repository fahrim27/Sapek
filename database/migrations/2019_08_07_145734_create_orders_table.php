<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('pro_id')->unsigned();
            $table->foreign('pro_id', '41526_592f086e76f2b')->references('id')->on('products')->onDelete('cascade');
            $table->integer('po_id')->unsigned();
            $table->string('nama');
            $table->string('email');
            $table->integer('no_ktp');
            $table->integer('phone');
            $table->string('keberangkatan');
            $table->string('tujuan');
            $table->date('tgl_sewa');
            $table->date('tgl_sampai');
            $table->text('alamat_jemputan');
            $table->text('detail_tujuan');
            $table->string('waktu_jemput');
            $table->double('amount', 20, 2)->unsigned();
            $table->text('catatan')->nullable();
            $table->string('status')->default('pending');
            $table->string('snap_token')->nullable();
            
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
        Schema::dropIfExists('orders');
    }
}
