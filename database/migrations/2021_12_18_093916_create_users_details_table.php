<?php

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->char('nim', 9)->nullable();
            $table->char('kelas', 4)->nullable();
            $table->string('no_hp', 14)->nullable();
            $table->char('jenis_kelamin', 1)->nullable();
            $table->string('pa_divisi')->nullable();
            $table->string('pa_jabatan')->nullable();
            $table->foreignIdFor(Location::class)->nullable();
            $table->text('alamat_rumah')->nullable();
            $table->text('alamat_kos')->nullable();
            $table->string('skripsi_dosbing')->nullable();
            $table->string('skripsi_judul')->nullable();
            $table->string('skripsi_metode')->nullable();
            $table->text('skripsi_variabel_dependent')->nullable();
            $table->text('skripsi_variabel_independent')->nullable();
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
        Schema::dropIfExists('users_details');
    }
}
