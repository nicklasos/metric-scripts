<?php

namespace MetricScripts\Compiler;

class Runtime
{
    public function evaluate(string $query)
    {
        $result = null;

        eval("\$result = $query;");

        return $result;
    }
}
