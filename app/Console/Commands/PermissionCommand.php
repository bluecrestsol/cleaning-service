<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class PermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name  = 'permissions:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update admin permissions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {   
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('cache:forget spatie.permission.cache');

        DB::table('permissions')->delete();

        function createPermissions($permissions) {
            foreach ($permissions as $permission) {
                Permission::create([
                        'parent_id' => $permission['parent_id'],
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                        'slug' => $permission['slug'],
                        'description' => $permission['description'],
                    ]);
            }
        }

        $modules = [
            'staff',
            'customers',
            'customers notes',
            'roles',
            'countries',
            'countries languages',
            'countries currencies',
            'states',
            'cities',
            'districts',
            'languages',
            'currencies',
            'companies',
            'companies countries',
            'places',
            'places categories',
            'crew members',
            'bookings',
            'appointments',
            'faqs questions',
            'faqs categories',
            'contracts',
            'agents',
            'services',
            'contact requests'
        ];

        $actions = [
            'list',
            'create',
            'edit',
            'delete',
            'view',
        ];
        
        // set main action permissions
        foreach ($modules as $key => $module) {

            $name = str_replace(' ', '-', $module);
            $slug = str_replace(' ', '.', $module);
            $base = [
                'parent_id' => 0,
                'name' => $name,
                'guard_name' => 'staff',
                'slug' => $slug,
                'description' =>
                'Access '.$name .' Module'
            ];
            
            $id = DB::table('permissions')
                    ->insertGetId($base, 'id');
            
            $permissions = [];
            foreach ($actions as $key => $action) {
                $permissions[] = [
                    'parent_id' => $id,
                    'name' => $name . '-' . str_replace(' ', '.', $action),
                    'guard_name' => $base['guard_name'],
                    'slug' => $slug . '.' . str_replace(' ', '.', $action),
                    'description' => 'Access ' . ucwords($module . ' '. $action) . ' Module'
                ];
            }
            createPermissions($permissions);
        }

        //set all permissions to staff by default
        $role = Role::where('guard_name', 'staff')->first();
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        
        $admin = Admin::where('email', 'admin@mistershield.com')->first();
        $admin->assignRole($role->id);
        $this->info('Permissions updated.');
    }
}