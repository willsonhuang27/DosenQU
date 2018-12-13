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
            $table->rememberToken();
            $table->timestamps();
//            $table->increments('user_id');
            $table->string('stsrc', 2);
            $table->string('email');
            $table->string('password');
            $table->string('name');
            $table->integer('age');
//            $table->char('gender',2);
//            $table->string('BOD');
            $table->string('address');
//            $table->string('pathKTP',8000);
            $table->char('role_id', 2);
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
