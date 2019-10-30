<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inboxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
             $table->foreign('user_id', '41525_592f086e76m2c')->references('id')->on('users')->onDelete('cascade');
            $table->string('subject');
            $table->boolean('status')->default(1);
            $table->string('message');
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
        Schema::dropIfExists('inboxes');
    }
}
