<?php

namespace App\Services;
 
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
 
class RoleService
{
    protected $model;
    protected $permission;

    public function __construct(Role $model, Permission $permission)
	{
        $this->model = $model;
        $this->permission = $permission;
    }

    public function list(Request $request)
	{
        $orderable = [
            'roles.id',
            'name',
            'users_count'
        ];

        $searchable = [
            'name'
        ];
        
        $result = $this->model
            ->countUsersOfStaff()
            ->ofDatatable($request, $searchable, $orderable);

        $records = [
            'data' => $result['query']->get(),
            'draw' => intval($request->draw),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['total']
        ];
        return $records;
    }

    public function getAll($filter)
    {
        return $this->model
            ->get();
    }

    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    public function getOfStaff()
    {
        return $this->model->where('guard_name', 'staff')->get();
    }

    public function getStaffPermissions()
    {
        return $this->permission->where('guard_name', 'staff')->get();
    }

    public function create($data)
    {
        $permissions = Arr::pull($data, 'permissions');
        $role = $this->model->create($data);
        $role->syncPermissions($permissions);
        return $role;
    }

    public function update($id, $data)
    {
        $permissions = Arr::pull($data, 'permissions');
        $role = $this->getById($id);
        $role->update($data);
        $role->syncPermissions($permissions);
        return $role;
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}