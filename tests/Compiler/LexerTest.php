<?php

namespace MetricScripts\Tests\Compiler;

use PHPUnit\Framework\TestCase;
use MetricScripts\Compiler\Lexer;

class LexerTest extends TestCase
{
    public function testParse()
    {
        $lexer = new Lexer();

        $query = "2 + 4 + CTR.avg('today', 'yesterday') * 0.9 * CTR.min(yesterday) * ROI.avg(0.3, month)";

        $parsedQuery = $lexer->parse($query);

        $this->assertEquals('2 + 4 + {0} * 0.9 * {1} * {2}', $parsedQuery['query']);

        $this->assertEquals('CTR.avg', $parsedQuery['tokens']['{0}']['name']);

        $this->assertEquals('today', $parsedQuery['tokens']['{0}']['params'][0]);
    }

    public function testParseWithoutMethod()
    {
        $lexer = new Lexer();

        $query = "2 + TST(name) * 0.9 * CTR.min(yesterday)";

        $parsedQuery = $lexer->parse($query);

        $this->assertEquals('__invoke', $parsedQuery['tokens']['{0}']['method']);
    }

    public function testParseEmptyParams()
    {
        $lexer = new Lexer();

        $query = "2 + TST()";

        $parsedQuery = $lexer->parse($query);

        $this->assertEquals('2 + {0}', $parsedQuery['query']);
    }
}
