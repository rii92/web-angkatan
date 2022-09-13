<?php

use App\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSatkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satkers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignIdFor(Location::class)->nullable();
            $table->integer("se_formation")->default(0);
            $table->integer("sk_formation")->default(0);
            $table->integer("si_formation")->default(0);
            $table->integer("sd_formation")->default(0);
            $table->integer("d3_formation")->default(0);
            $table->integer("ks_formation")->default(0);
            $table->integer("st_formation")->default(0);
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
        Schema::dropIfExists('satkers');
    }
}
