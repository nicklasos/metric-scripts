<?php

namespace MetricScripts\Compiler;

class Compiler
{
    /**
     * @var Lexer
     */
    private $lexer;

    /**
     * @var MetricLoader
     */
    private $loader;

    public function __construct(Lexer $lexer, MetricLoader $loader)
    {
        $this->lexer = $lexer;
        $this->loader = $loader;
    }

    public function compile(string $query): string
    {
        $parsedQuery = $this->lexer->parse($query);

        $compiledQuery = $parsedQuery['query'];

        foreach ($parsedQuery['tokens'] as $index => $token) {
            $metric = $this->loader->load($token['class']);

            $result = $metric->{$token['method']}(...$token['params']);

            $compiledQuery = str_replace($index, $result, $compiledQuery);
        }

        return $compiledQuery;
    }
}
