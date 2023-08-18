<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserDetailsAddNilaiAndRankColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_details', function (Blueprint $table) {
            $table->float("ipk")->default(2);
            $table->integer("rank_jurusan")->default(0);
            $table->integer("rank_peminatan")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_details', function (Blueprint $table) {
            $table->dropColumn('ipk');
            $table->dropColumn('rank_jurusan');
            $table->dropColumn('rank_peminatan');
        });
    }
}
