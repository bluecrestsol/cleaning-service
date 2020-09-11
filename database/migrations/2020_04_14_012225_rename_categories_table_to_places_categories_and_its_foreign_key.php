<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCategoriesTableToPlacesCategoriesAndItsForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('categories', 'places_categories');
        DB::statement("
            ALTER TABLE `places`
                CHANGE COLUMN `category_id` `places_category_id` INTEGER;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('places_categories', 'categories');
        DB::statement("
            ALTER TABLE `places`
                CHANGE COLUMN `places_category_id` `category_id` INTEGER;
        ");
    }
}
