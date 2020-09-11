<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnPublicListingPublicHistoryPublicHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `places`
                MODIFY COLUMN `public_listing` BOOLEAN
        ");

        DB::statement("
            ALTER TABLE `places`
                CHANGE COLUMN `public_listing` `is_listing_public` BOOLEAN
        ");

        DB::statement("
            ALTER TABLE `places`
                MODIFY COLUMN `public_history` BOOLEAN
        ");

        DB::statement("
            ALTER TABLE `places`
                CHANGE COLUMN `public_history` `is_history_public` BOOLEAN
        ");

        DB::statement("
            ALTER TABLE `places`
                MODIFY COLUMN `public_photos` BOOLEAN
        ");

        DB::statement("
            ALTER TABLE `places`
                CHANGE COLUMN `public_photos` `is_gallery_public` BOOLEAN
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
