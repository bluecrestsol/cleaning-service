<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\StaffService;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    protected $staffService;

    public function __construct(StaffService $staffService)
    {
        parent::__construct();
        $this->staffService = $staffService;
    }

    public function updateActive(Request $request)
    {
        $admin = app('shared')->get('admin');
        $this->staffService->update($admin->id, $request->except(['_token']));
        return redirect()->back();
    }
}
