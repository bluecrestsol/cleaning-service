<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAppointmentCrewMembersTableToAppointmentCrewMemberAndAppointmentsServicesTableToAppointmentService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('appointment_crew_members', 'appointment_crew_member');
        Schema::rename('appointments_services', 'appointment_service');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('appointment_crew_member', 'appointment_crew_members');
        Schema::rename('appointment_service', 'appointments_services');
    }
}
