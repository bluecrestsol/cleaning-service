<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crew_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uuid');
            $table->string('email');
            $table->string('password');
            $table->enum('type',['hired','freelancer']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('position');
            $table->enum('gender',['male','female']);
            $table->integer('nationality');
            $table->date('date_of_birth');
            $table->enum('doc_type',['passport','id_card','drivers_license']);
            $table->string('mobile');
            $table->string('line');
            $table->string('whatsapp');
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
        Schema::dropIfExists('crew_members');
    }
}
