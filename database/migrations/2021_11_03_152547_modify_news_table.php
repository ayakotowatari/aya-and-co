<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNewsTable extends Migration
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
            // $table->renameColumn('p2_link, 191', 'p2_link')->change();
            // $table->renameColumn('p3_link, 191', 'p3_link')->change();
            // $table->renameColumn('p4_link, 191', 'p4_link')->change();
            // $table->renameColumn('p5_link, 191', 'p5_link')->change();
            $table->dropColumn('p2_link, 191');
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
