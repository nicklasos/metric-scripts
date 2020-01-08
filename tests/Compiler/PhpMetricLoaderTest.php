<?php

namespace MetricScripts\Tests\Compiler;

use MetricScripts\Compiler\PhpMetricLoader;
use MetricScripts\Metrics\Metric;
use PHPUnit\Framework\TestCase;

class PhpMetricLoaderTest extends TestCase
{
    public function testLoad()
    {
        $loader = new PhpMetricLoader();

        $metric = $loader->load('TST');

        $this->assertInstanceOf(Metric::class, $metric);
    }
}
