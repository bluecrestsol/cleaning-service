<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class UpdateStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = Admin::where('email', 'admin@admin.com')->first();

        if ($staff) {
            $staff->active_company_id = 1;
            $staff->active_country_id = 226;
            $staff->save();
        }
    }
}
