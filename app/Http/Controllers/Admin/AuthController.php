<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\StaffService;
use App\Http\Requests\StaffLoginRequest;
use App\Traits\ThrottlesRequests;

/**
 * Controller for admin authentication
 */
class AuthController extends BaseController
{
    use ThrottlesRequests;

    /**
     * Attempts per cycle
     *
     * @var int
     */
    protected $maxAttempts = 10;

    /**
     * Decay minutes for throttling
     *
     * @var int
     */
    protected $decayMinutes = 10;

    /**
     * @var StaffService $staffService
     */
    private $staffService;

    /**
     * Initialization
     *
     * @param StaffService $staffService
     */
    public function __construct(StaffService $staffService)
    {
        parent::__construct();
        $this->staffService = $staffService;
    }

    /**
     * Admin login
     *
     * @param StaffLoginRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function login(StaffLoginRequest $request)
    {
        $this->checkThrottling($request);
        if(!$this->staffService->login($request->validated())) {
            $this->incrementAttempts($request);
            return redirect()->back()->withErrors([__('staff/notifications.login_error')]);
        }
        return redirect()->route('admin.dashboard');
    }

    /**
     * Admin logout
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $this->staffService->logout();
        return redirect()->route('admin.login');
    }
}
