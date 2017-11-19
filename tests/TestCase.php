<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;

class TestCase extends BaseTestCase
{
    use MockeryPHPUnitIntegration;
}
