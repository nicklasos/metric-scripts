<?php

namespace MetricScripts\Compiler;

use MetricScripts\Metrics\Metric;

class LaravelMetricLoader implements MetricLoader
{
    public function load(string $name): Metric
    {
        return app("MetricScripts\\Metrics\\{$name}");
    }
}
