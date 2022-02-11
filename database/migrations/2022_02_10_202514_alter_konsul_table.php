<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterKonsulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('konsul', function (Blueprint $table) {
            $table->boolean('acc_publish_admin')->default(false);
            $table->boolean('acc_publish_user')->default(false);
        });

        Schema::table('konsul', function (Blueprint $table) {
            $table->dropColumn('is_publish');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slug', function (Blueprint $table) {
            $table->dropColumn('acc_publish_admin');
            $table->dropColumn('acc_publish_user');
        });

        Schema::table('konsul', function (Blueprint $table) {
            $table->boolean('is_publish')->default(false);
        });
    }
}
