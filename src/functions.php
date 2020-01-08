<?php

function dd(...$what)
{
    echo '<pre>';
    foreach ($what as $w) {
        print_r($w);
        echo ' ';
    }
    echo '</pre>';

    exit(0);
}
