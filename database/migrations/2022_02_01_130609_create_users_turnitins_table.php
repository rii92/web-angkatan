<?php

use App\Constants\AppTurnitins;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTurnitinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_turnitins', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('status')->nullable()->default(AppTurnitins::STATUS_WAIT);
            $table->text('link_file');
            $table->text('link_hasil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_turnitins');
    }
}
