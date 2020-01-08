<?php

namespace MetricScripts\Tests\Compiler;

use MetricScripts\Compiler\Lexer;
use MetricScripts\Compiler\PhpMetricLoader;
use PHPUnit\Framework\TestCase;
use MetricScripts\Compiler\Compiler;

class CompilerTest extends TestCase
{
    public function testCompile()
    {
        $query = "2 + 4 * TST.str('-1 day', 123)";

        $compiler = new Compiler(new Lexer(), new PhpMetricLoader());

        $result = $compiler->compile($query);

        $this->assertEquals("2 + 4 * date is -1 day number is 123", $result);
    }

    public function testCompileNumbers()
    {
        $query = "2 + 4 * TST.avg(1, 2, 3, 4, 5, 6)";

        $compiler = new Compiler(new Lexer(), new PhpMetricLoader());

        $result = $compiler->compile($query);

        $this->assertEquals("2 + 4 * 3.5", $result);
    }

    public function testInvokeMethod()
    {
        $query = "2 + 4 * TST(argument)";

        $compiler = new Compiler(new Lexer(), new PhpMetricLoader());

        $result = $compiler->compile($query);

        $this->assertEquals('2 + 4 * name is argument', $result);
    }
}
