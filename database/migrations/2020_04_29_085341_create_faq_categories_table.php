<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('uuid')->nullable();
            $table->integer('country_id')->nullable();
            $table->longText('name')->nullable();
            $table->enum('status', ['enabled', 'disabled'])->nullable()->default('disabled');
            $table->enum('type', ['customer', 'staff', 'crew_member'])->nullable()->default('customer');
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('faq_categories');
    }
}
