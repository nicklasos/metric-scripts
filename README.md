# metric-scripts
Skeleton for scripting language lib

### New metric example
```php

class CTR implements Metric
{
    public function __invoke()
    {
        return 42;
    }
    
    public function avg()
    {
        return 69;
    }
}

$compiler = new Compiler(new Lexer(), new PhpMetricLoader());

$result = $compiler->compiler('CTR() + CTR.avg()');

// $result = '42 + 69';

```
