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
            $table->text('description');
            $table->string('category');
            $table->string('name')->nullable();
            $table->string('status')->nullable()->default(AppKonsul::STATUS_WAIT);
            $table->text('note')->nullable();
            $table->boolean('is_publish')->nullable()->default(false);
            $table->boolean('is_anonim')->nullable()->default(false);
            $table->dateTime('acc_rej_at')->nullable();
            $table->dateTime('done_at')->nullable();
            $table->dateTime('published_at')->nullable();
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
