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
            $table->integer('user_from_id')->unsigned()->index();
            $table->integer('user_to_id')->unsigned()->index();
            $table->foreign('user_from_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_to_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('new_message')->default(0);
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
        Schema::dropIfExists('inboxes');
    }
}
