<?php

namespace MetricScripts\Metrics;

use MetricScripts\Metrics\Metric;

class TST implements Metric
{
    public function str(string $date, int $number): string
    {
        return 'date is ' . $date . ' number is ' . $number;
    }

    public function avg(float ...$numbers): float
    {
        return array_sum($numbers) / count($numbers);
    }

    public function true()
    {
        return true;
    }

    public function false()
    {
        return false;
    }

    public function number42()
    {
        return 42;
    }

    public function __invoke(string $name = 'empty')
    {
        return 'name is ' . $name;
    }
}
