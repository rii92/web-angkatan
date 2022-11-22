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
            $table->string("kode_wilayah", 10);
            $table->foreignIdFor(Location::class)->nullable();
            $table->integer("se")->nullable()->default(0);
            $table->integer("sk")->nullable()->default(0);
            $table->integer("si")->nullable()->default(0);
            $table->integer("sd")->nullable()->default(0);
            $table->integer("d3")->nullable()->default(0);
            $table->integer("ks")->nullable()->default(0);
            $table->integer("st")->nullable()->default(0);
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
