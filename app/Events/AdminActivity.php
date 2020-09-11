<?php

namespace App\Events;

use App\Models\Admin;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Event for admin activity
 */
class AdminActivity
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Admin $admin
     */
    public $admin;

    /**
     * Create a new event instance.
     *
     * @param Admin $admin
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }
}
