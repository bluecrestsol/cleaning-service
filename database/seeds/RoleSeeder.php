<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'guard_name' => 'staff',
                'name' => 'Admin',
            ]
        ];

        DB::table('roles')->delete();
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
        foreach ($roles as $key => $role) {
            Role::create($role);
        }
    }
}
