<?php

use App\Models\Satker;
use App\Models\Simulations;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_formations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Satker::class, "satker_1")->nullable();
            $table->foreignIdFor(Satker::class, "satker_2")->nullable();
            $table->foreignIdFor(Satker::class, "satker_3")->nullable();
            $table->foreignIdFor(Satker::class, "satker_final")->nullable();
            $table->foreignIdFor(Simulations::class);
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
        Schema::dropIfExists('users_formations');
    }
}
