<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uuid');
            $table->integer('customer_id');
            $table->integer('category_id');
            $table->enum('status',['enabled', 'disabled']);
            $table->string('name');
            $table->string('description');
            $table->enum('area_unit',['sqm', 'sqf']);
            $table->integer('area');
            $table->integer('district_id');
            $table->integer('city_id');
            $table->integer('state_id');
            $table->integer('country_id');
            $table->enum('type',['private', 'commercial', 'public']);
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
        Schema::dropIfExists('places');
    }
}
