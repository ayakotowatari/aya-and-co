<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('user_type_id')->unsigned()->nullable();
            $table->string('name',191);
            // $table->string('first_name',191);
            $table->string('email',191);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',191);
            $table->integer('life')->nullable(); //0: 退会, 1: 現在会員
            $table->string('remember_token',100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique('email');

            $table->foreign("user_type_id")->references("id")->on("user_types");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
