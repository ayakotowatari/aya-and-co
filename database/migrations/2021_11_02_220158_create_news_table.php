<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            //
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('admin_id')->unsigned();
            $table->string('subject',191);
            $table->string('image',191);
            $table->string('p1_heading',191);
            $table->text('p1_main');
            $table->string('p2_heading', 191)->nullable();
            $table->text('p2_main')->nullable();
            $table->string('p2_link, 191')->nullable();
            $table->string('p2_btntext', 191)->nullable();
            $table->string('p3_heading', 191)->nullable();
            $table->text('p3_main')->nullable();
            $table->string('p3_link, 191')->nullable();
            $table->string('p3_btntext', 191)->nullable();
            $table->string('p4_heading', 191)->nullable();
            $table->text('p4_main')->nullable();
            $table->string('p4_link, 191')->nullable();
            $table->string('p4_btntext', 191)->nullable();
            $table->text('p5_main')->nullable();
            $table->string('p5_link, 191')->nullable();
            $table->string('p5_btntext', 191)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("admin_id")->references("id")->on("admins");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            //
        });
    }
}
