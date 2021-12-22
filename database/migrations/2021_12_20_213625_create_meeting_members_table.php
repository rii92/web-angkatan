<?php

use App\Constants\AppMeetings;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_members', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Meeting::class);
            $table->foreignIdFor(User::class);
            $table->string('status', 15)->default(AppMeetings::NOT_PRESENT)->nullable();
            $table->time('attend_at')->nullable();
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
        Schema::dropIfExists('meeting_members');
    }
}
