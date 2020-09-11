<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use App\Traits\HasDatatable;
use Illuminate\Support\Facades\DB;

class Role extends SpatieRole
{
    use HasDatatable;

    public function scopeCountUsersOfStaff($query)
    {
        return $query
                ->select(['roles.*', DB::raw('COUNT(DISTINCT model_has_roles.model_id, model_has_roles.model_type) AS users_count')])
                ->leftJoin('model_has_roles', 'model_has_roles.role_id', 'roles.id')
                ->where('roles.guard_name', 'staff')
                ->groupBy('roles.id');
    }
}