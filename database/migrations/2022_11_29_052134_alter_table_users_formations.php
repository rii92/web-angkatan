<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersFormations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_formations', function (Blueprint $table) {
            $table->string('satker_final_keterangan')->nullable();
            $table->dateTime('user_selection_at')->nullable();
            $table->smallInteger('status_pilihan')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_formations', function (Blueprint $table) {
            $table->dropColumn('satker_final_keterangan');
            $table->dropColumn('user_selection_at');
            $table->dropColumn('status_pilihan');
        });
    }
}
