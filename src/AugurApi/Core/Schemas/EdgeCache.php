<?php

declare(strict_types=1);

namespace AugurApi\Core\Schemas;

/**
 * Edge cache duration options.
 */
enum EdgeCache: string
{
    case ThirtySeconds = '30s';
    case OneMinute = '1m';
    case FiveMinutes = '5m';
    case OneHour = '1h';
    case TwoHours = '2h';
    case ThreeHours = '3h';
    case FourHours = '4h';
    case FiveHours = '5h';
    case EightHours = '8h';
}
