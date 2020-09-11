<?php

namespace App\Listeners;

use App\Events\AdminLogin;
use App\Models\AdminsLogin;
use App\Services\StaffService;
use Jenssegers\Agent\Agent;

/**
 * Listener for admin login records
 */
class RecordAdminLogin
{
    /**
     * @var StaffService $staffService
     */
    protected $staffService;

    /**
     * Create the event listener.
     *
     * @param StaffService $staffService
     */
    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    /**
     * Handle the event.
     *
     * @param AdminLogin $event
     * @return void
     */
    public function handle(AdminLogin $event)
    {
        $agent = new Agent();
        $ip = request()->getClientIp();
        $admin = $event->admin;
        $this->staffService->recordLoginById($admin->id, [
            'is_successful' => $event->status,
            'ip' => $ip,
            'geo' => geoip($ip)->iso_code,
            'browser' => $agent->browser(),
            'os' => $agent->platform()
        ]);
    }
}
