<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusInStatesCitiesDistricts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('states', function (Blueprint $table) {
            $table->enum('status',['enabled','disabled'])->after('name')->nullable();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->enum('status',['enabled','disabled'])->after('name')->nullable();
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->enum('status',['enabled','disabled'])->after('name')->nullable();
        });
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
