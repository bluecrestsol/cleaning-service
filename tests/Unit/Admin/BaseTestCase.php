<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;

/**
 * Base test case abstract for admin
 */
abstract class BaseTestCase extends TestCase
{
    /**
     * Initialization
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Setup
     *
     * @return void
     */
    public function setUp() :void
    {
        parent::setUp();
    }
}
