<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->enum('type', ['hired', 'freelancer'])->nullable();
            $table->enum('title', ['mr', 'mrs', 'ms', 'dr', 'prof'])->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('status', ['enabled', 'disabled', 'dismissed'])->nullable();
            $table->string('position')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->integer('nationality_country_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('doc_type', ['passport', 'id_card', 'drivers_license'])->nullable();
            $table->string('doc_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('line')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('doc_file')->nullable();
            $table->string('photo_file')->nullable();
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
        Schema::dropIfExists('agents');
    }
}
