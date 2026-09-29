<?php

declare(strict_types=1);

namespace AugurApi\Core;

/**
 * Loads the package-local endpoint registry (registry.json, generated).
 *
 * @phpstan-import-type EndpointEntryArray from EndpointEntry
 */
final class Registry
{
    /** @var list<EndpointEntry>|null */
    private static ?array $entries = null;

    /**
     * @return list<EndpointEntry> Canonical entries, sorted by id
     */
    public static function entries(): array
    {
        return self::$entries ??= self::load();
    }

    /**
     * @return list<EndpointEntry>
     */
    private static function load(): array
    {
        /** @var list<EndpointEntryArray> $rows */
        $rows = json_decode(
            (string) file_get_contents(__DIR__ . '/registry.json'),
            true,
            flags: JSON_THROW_ON_ERROR,
        );
        return array_map(EndpointEntry::fromArray(...), $rows);
    }
}
