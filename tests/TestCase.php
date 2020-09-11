<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\CreatesApplication;
use Faker\Factory as Faker;

/**
 * Base test case abstract
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var Faker
     */
    protected $faker;

    /**
     * Setup
     *
     * @return void
     */
    public function setUp() :void
    {
        parent::setUp();
        if (config('app.env') === 'production') {
            throw new \Exception('Not allowed to run tests on production!');
        }
        $this->faker = Faker::create();
    }
}
