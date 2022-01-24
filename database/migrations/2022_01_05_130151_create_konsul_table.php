<?php

use App\Constants\AppKonsul;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateKonsulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsul', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('title');
            $table->string('text');
            $table->string('name');
            $table->string('catagory');
            $table->string('status')->nullable()->default(AppKonsul::STATUS_WAIT);
            $table->text('note')->nullable();
            $table->boolean('is_publish')->nullable()->default(false);
            $table->boolean('is_anonim')->nullable()->default(false);
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
        Schema::dropIfExists('konsul');
    }
}
