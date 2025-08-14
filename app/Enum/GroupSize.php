<?php

namespace App\Enum;

enum GroupSize: int
{
    case SOLO_TRAVELER = 1;
    case COUPLE = 2;
    case SMALL_GROUP = 3;
    case FAMILY_OR_FRIENDS = 4;
    case LARGE_GROUP = 5;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::SOLO_TRAVELER => 'Solo Traveler',
            self::COUPLE => 'Couple (2 people)',
            self::SMALL_GROUP => 'Small Group (3-4 people)',
            self::FAMILY_OR_FRIENDS => 'Family/Friends (5-8 people)',
            self::LARGE_GROUP => 'Large Group (8+ people)',
        };
    }
}
