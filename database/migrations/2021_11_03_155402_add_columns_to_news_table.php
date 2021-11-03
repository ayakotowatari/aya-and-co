<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToNewsTable extends Migration
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
            $table->string('p2_link', 191)->nullable()->after('p2_main');
            $table->string('p3_link', 191)->nullable()->after('p3_main');
            $table->string('p4_link', 191)->nullable()->after('p4_main');
            $table->string('p5_link', 191)->nullable()->after('p5_main');
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
            $table->dropColumn('p2_link');
            $table->dropColumn('p3_link');
            $table->dropColumn('p4_link');
            $table->dropColumn('p5_link');
        });
    }
}
