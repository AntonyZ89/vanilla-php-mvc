<?php

function dd(...$args): void
{

    echo '<pre>';
    foreach ($args as $arg) {
        print_r($arg);
        echo '<br>';
    }
    echo '</pre>';
    die;
}

function camelize(string $string): string
{
    return (
        str_replace(
            ' ',
            '',
            ucwords(
                preg_replace('/[^a-zA-Z0-9\x7f-\xff]++/', ' ', $string)
            )
        )
    );
}
