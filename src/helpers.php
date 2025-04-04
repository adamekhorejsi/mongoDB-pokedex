<?php

use Symfony\Component\VarDumper\VarDumper;

// Dump and Die
if (!function_exists('dd')) {
    function dd(...$vars): void
    {
        foreach ($vars as $var) {
            VarDumper::dump($var);
        }
        die(1);
    }
}

// Dump, Die, and Debug (with stack trace)
if (!function_exists('ddd')) {
    function ddd(...$vars): void
    {
        foreach ($vars as $var) {
            Symfony\Component\VarDumper\VarDumper::dump($var);
        }

        foreach (debug_backtrace() as $trace) {
            if (isset($trace['file'], $trace['line'])) {
                echo sprintf("In %s:%d <br>", $trace['file'], $trace['line']);
            }
        }
        die(1);
    }
}
