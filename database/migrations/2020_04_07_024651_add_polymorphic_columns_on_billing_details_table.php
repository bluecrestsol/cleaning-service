<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPolymorphicColumnsOnBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billing_details', function (Blueprint $table) {
            $table->renameColumn('place_id', 'billing_detailable_id');
        });
        Schema::table('billing_details', function (Blueprint $table) {
            $table->unsignedBigInteger('billing_detailable_id')->change();
            $table->string('billing_detailable_type')->after('billing_detailable_id');
            $table->index(['billing_detailable_id', 'billing_detailable_type'], 'billing_detailable_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billing_details', function (Blueprint $table) {
            $table->dropIndex('billing_detailable_index');
            $table->renameColumn('billing_detailable_id', 'place_id');
        });
        Schema::table('billing_details', function (Blueprint $table) {
            $table->dropColumn('billing_detailable_type');
        });
    }
}
