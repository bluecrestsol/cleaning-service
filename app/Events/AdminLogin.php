<?php

namespace App\Events;

use App\Models\Admin;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Event for admin login records
 */
class AdminLogin
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Admin $admin
     * @var int $status
     */
    public $admin, $status;

    /**
     * Create a new event instance.
     *
     * @param Admin $admin
     * @param int $status
     */
    public function __construct($admin, $status)
    {
        $this->admin = $admin;
        $this->status = $status;
    }
}
