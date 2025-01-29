<?php

namespace App\Enums;

enum Product: string
{
    case GOLD = 'Gold Coffee';

    public function markup()
    {
        return match ($this) {
            self::GOLD => 0.25,
        };
    }

    public function shipping()
    {
        return match ($this) {
            self::GOLD => 10,
        };
    }

}
