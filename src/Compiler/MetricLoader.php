<?php

namespace MetricScripts\Compiler;

use MetricScripts\Metrics\Metric;

interface MetricLoader
{
    public function load(string $name): Metric;
}
