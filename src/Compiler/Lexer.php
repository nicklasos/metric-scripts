<?php

namespace MetricScripts\Compiler;

use MetricScripts\Exception\LexerException;

class Lexer
{
    /**
     * @param string $query example: "2 + 4 (CTR.avg(today, yesterday)"
     * @return ['query', 'tokens']
     */
    public function parse(string $query): array
    {
        $parsedTokens = $this->parseTokens($query);

        $tokenIndex = 0;
        $tokens = [];
        foreach ($parsedTokens as $token) {
            $index = '{' . $tokenIndex++ . '}';
            $query = str_replace($token, $index, $query);

            $params = $this->parseTokenNameAndParams($token);

            $tokens[$index] = $params;
        }

        return compact('query', 'tokens');
    }

    private function parseTokens(string $query): array
    {
        $regex = '/([\w.]+)\([\w 0-9\-.,\'"]*\)/i';

        preg_match_all($regex, $query, $matches);

        if (!isset($matches[0])) {
            throw new LexerException('No tokens found');
        }

        return $matches[0];
    }

    private function parseTokenNameAndParams(string $token): array
    {
        preg_match('/^([\w.]+)/i', $token, $nameMatches);
        $name = $nameMatches[0];

        $signature = explode('.', $name);
        if (count($signature) === 1) {
            $signature[] = '__invoke';
        }

        [$class, $method] = $signature;

        preg_match('/(?<=\().*?(?=\))/i', $token, $paramsMatches);

        $params = array_map(function ($item) {
            return trim($item, " \t\n\r\0\x0B'\"");
        }, explode(',', $paramsMatches[0]));

        return compact('name', 'class', 'method', 'params');
    }
}
