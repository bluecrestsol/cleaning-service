<?php

namespace Tests\Unit\Admin;

use App\Models\Admin;
use App\Services\StaffService;

/**
 * Unit test for staff
 */
class StaffTest extends BaseTestCase
{
    /**
     * @var StaffService
     */
    protected $staffService;

    /**
     * Initialization
     */
    public function __construct()
    {
        parent::__construct();
        $this->staffService = app()->make('App\Services\StaffService');
    }

    /**
     * test for creating staff
     *
     * @return void
     */
    public function test_can_create_staff()
    {
        // generate and check data
        $data = factory(Admin::class)->raw();
        $this->assertNotNull($data);
        $this->assertNotEmpty($data);
        $this->assertIsArray($data);
        // attempting to create data
        $staff = $this->staffService->create($data);
        $this->assertNotNull($staff);
    }
}
