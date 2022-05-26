<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUserDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_details', function (Blueprint $table) {
            $table->string('no_hp_ayah', 15)->nullable();
            $table->string('no_hp_ibu', 15)->nullable();
            $table->string('no_hp_wali', 15)->nullable();
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
            $table->dropColumn('no_hp_ayah');
            $table->dropColumn('no_hp_ibu');
            $table->dropColumn('no_hp_wali');
        });
    }
}
