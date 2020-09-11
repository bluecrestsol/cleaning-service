<?php

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\CrewMember;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Appointment::class, 5)->create()->each(function($appointment) {
            $members = CrewMember::all()->random(mt_rand(3, 10));
            $leader = mt_rand(0, count($members)-1);
            $data = [];
            $members->map(function($member, $key) use (&$data, $leader) {
                $data[$member->id] = [
                    'is_leader' => ($leader == $key) ? 1 : 0
                ];
                return $member;
            });
            $appointment->crew_members()->attach($data);
        });
    }
}
