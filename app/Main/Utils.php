<?php

declare(strict_types=1);

namespace App\Main;

class Utils
{
    public static function dollarToCents(float $dolar): int
    {
        return (int) ($dolar * 100);
    }

    public static function centsToDollar(int $cents): float
    {
        return $cents / 100;
    }
}
