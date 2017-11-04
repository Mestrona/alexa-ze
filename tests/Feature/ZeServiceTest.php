<?php

namespace Tests\Feature;

use App\Services\ZeService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZeServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetRange()
    {
        $instance = new ZeService();
        $this->assertNotFalse($instance->getBatteryStatus(config('ze.username'), config('ze.password')));
    }
}
