<?php

use App\Models\SambatTag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateSambatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sambat', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->text('description')->nullable();
            $table->boolean('is_anonim');
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
        Schema::dropIfExists('sambat');
    }
}
