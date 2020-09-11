<?php

namespace App\Listeners;

use App\Events\AdminActivity;
use App\Services\StaffService;

/**
 * Listener for updating admin's last activity
 */
class UpdateAdminLastActivity
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
     * @param AdminActivity $event
     * @return void
     */
    public function handle(AdminActivity $event)
    {
        $this->staffService->updateLastActivity($event->admin);
    }
}
