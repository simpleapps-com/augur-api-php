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

    /** @var array<string, EndpointEntry>|null Canonical and alias ids */
    private static ?array $byId = null;

    /**
     * @return list<EndpointEntry> Canonical entries, sorted by id
     */
    public static function entries(): array
    {
        return self::$entries ??= self::load();
    }

    /**
     * The canonical entry for a canonical id or an alias id (`service.chain.alias`).
     */
    public static function find(string $id): ?EndpointEntry
    {
        self::$byId ??= self::index();

        return self::$byId[$id] ?? null;
    }

    /**
     * @return array<string, EndpointEntry>
     */
    private static function index(): array
    {
        $index = [];
        foreach (self::entries() as $entry) {
            $index[$entry->id] = $entry;
            $chain = substr($entry->id, 0, (int) strrpos($entry->id, '.'));
            foreach ($entry->aliases as $alias) {
                $index[$chain . '.' . $alias] = $entry;
            }
        }

        return $index;
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
