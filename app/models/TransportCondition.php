<?php

namespace App\Models;

class TransportCondition
{
    public const OPERATIONAL = 'operational';
    public const REPAIR = 'repair';
    public const DECOMMISSIONED = 'decommissioned';

    public const LIST = [
        self::OPERATIONAL   => 'Исправен',
        self::REPAIR        => 'В ремонте',
        self::DECOMMISSIONED => 'Списан',
    ];

    public static function isValid(string $value): bool
    {
        return array_key_exists($value, self::LIST);
    }
}
