<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCountryCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('country_currency');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('country_currency', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id')->nullable();
            $table->integer('currency_id')->nullable();
            $table->enum('status', ['enabled', 'disabled', 'draft'])->nullable();
            $table->boolean('is_primary')->nullable();
            $table->timestamps();
        });
    }
}
