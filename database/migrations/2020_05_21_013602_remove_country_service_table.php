<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCountryServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('country_service');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('country_service', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id')->nullable();
            $table->integer('service_id')->nullable();
            $table->enum('status',['enabled','disabled'])->nullable();
            $table->timestamps();
        });
    }
}
