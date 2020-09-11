<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\RoleService;
use App\Http\Requests\RoleStoreRequest;

class RoleController extends BaseController
{
    private $roleService;

    public function __construct(RoleService $roleService)
    {
        parent::__construct();
        $this->roleService = $roleService;
        $this->middleware('permission:roles-list|roles-create|roles-edit|roles-delete', ['only' => ['index', 'store', 'show']]);
        $this->middleware('permission:roles-list', ['only' => ['index']]);
        $this->middleware('permission:roles-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:roles-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:roles-delete', ['only' => ['destroy']]);
        $this->middleware('permission:roles-view', ['only' => ['show']]);
    }
    
    public function index()
    {
        return view('admin.roles.index');
    }

    public function create()
    {
        $permissions = $this->roleService->getStaffPermissions();
        return view('admin.roles.crud', compact('permissions'));
    }

    public function store(RoleStoreRequest $request)
    {
        $this->roleService->create($request->validated());
        return redirect()->route('admin.roles.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.roles_created_successfully') ]
        ]);
    }

    public function edit($id)
    {
        $permissions = $this->roleService->getStaffPermissions();
        $role = $this->roleService->getById($id);
        return view('admin.roles.crud', compact('permissions', 'role'));
    }

    public function update(RoleStoreRequest $request, $id)
    {
        $this->roleService->update($id, $request->validated());
        return redirect()->route('admin.roles.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.roles_updated_successfully') ]
        ]);
    }

    public function show($id)
    {
        $role = $this->roleService->getById($id);
        return view('admin.roles.show', compact('role'));
    }

    public function destroy($id)
    {
        $success = $this->roleService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
