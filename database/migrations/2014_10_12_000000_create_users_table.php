<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('picture')->nullable();
            $table->string('picture_crop')->nullable();
            $table->string('document')->nullable();
            $table->text('biography')->nullable();
            $table->integer('featured')->default(0);
            $table->rememberToken();

            $table->unsignedInteger('level_id');
            $table->foreign('level_id')
                ->references('id')->on('levels')
                ->onDelete('cascade');

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
        Schema::dropIfExists('users');
    }
}
