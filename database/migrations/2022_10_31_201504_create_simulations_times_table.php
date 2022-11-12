<?php

use App\Models\Simulations;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimulationsTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulations_times', function (Blueprint $table) {
            $table->id();
            $table->dateTime("start_time");
            $table->dateTime("end_time");
            $table->foreignIdFor(Simulations::class)->nullable();
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
        Schema::dropIfExists('simulations_times');
    }
}
