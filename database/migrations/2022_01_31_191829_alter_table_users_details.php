<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsersDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_details', function (Blueprint $table) {
            $table->boolean('setting_send_email_accept_konsultasi')->default(true);
            $table->tinyInteger('setting_send_email_reply_konsultasi')->nullable()->default(3);
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
            $table->dropColumn('setting_send_email_accept_konsultasi');
            $table->dropColumn('setting_send_email_reply_konsultasi');
        });
    }
}
