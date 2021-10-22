<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 191);
            $table->string('type', 191); 
            $table->integer('value')->nullable();
            $table->integer('percent_off')->nullable();
            $table->integer('minimum')->nullable();
            $table->string('date_by')->nullable();
            $table->bigInteger('status_id')->unsigned();
            $table->timestamps();

            $table->foreign("status_id")->references("id")->on("statuses");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
