<?php

namespace App\Application\Utils;

final class Util
{
    public static function numbersOnly(string $string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }
}
