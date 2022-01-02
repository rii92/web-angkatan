<?php

use App\Models\Sambat;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSambatTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sambat_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sambat::class);
            $table->foreignIdFor(Tag::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sambat_tags');
    }
}
