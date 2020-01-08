<?php

namespace MetricScripts\Compiler;

use MetricScripts\Metrics\Metric;

class PhpMetricLoader implements MetricLoader
{
    public function load(string $name): Metric
    {
        $class = "MetricScripts\\Metrics\\{$name}";

        return new $class;
    }
}
