<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->string('delivery_carduse', 191)->nullable()->after('delivery_time');
            $table->string('delivery_cardmessage', 191)->nullable()->after('delivery_carduse');
            $table->string('delivery_cardname', 191)->nullable()->after('delivery_cardmessage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('delivery_carduse');
            $table->dropColumn('delivery_cardmessage');
            $table->dropColumn('delivery_cardname');
        });
    }
}
