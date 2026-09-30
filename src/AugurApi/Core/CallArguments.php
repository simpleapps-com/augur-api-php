<?php

declare(strict_types=1);

namespace AugurApi\Core;

use AugurApi\Core\Exceptions\InvalidArgumentException;

/**
 * Checks AugurApiClient::call() arguments against an endpoint before any I/O.
 *
 * Violations throw InvalidArgumentException carrying the kebab service and
 * path template. Messages name keys, never values.
 *
 * @ensures (all checks return) ⇒ keys($pathParams) = $entry->pathParams as sets
 *          ∧ keys($query) ⊆ $entry->queryParams ∪ ({edgeCache} if $entry->edgeCache)
 *          ∧ ($body !== null ⇒ $entry->hasBody)
 * @ensures ∀ thrown e. e.message names keys only  (values may be card data or PII)
 */
final class CallArguments
{
    /**
     * Path params, keyed exactly as the entry declares them, as strings.
     *
     * @param array<array-key, mixed> $pathParams
     * @return array<string, string>
     * @throws InvalidArgumentException
     */
    public static function pathParams(EndpointEntry $entry, array $pathParams): array
    {
        $keys = array_map('strval', array_keys($pathParams));
        self::requireNone($entry, array_diff($entry->pathParams, $keys), 'Missing path params');
        self::requireNone($entry, array_diff($keys, $entry->pathParams), 'Unknown path params');

        $filled = [];
        foreach ($entry->pathParams as $name) {
            $value = $pathParams[$name];
            if (!is_int($value) && !is_string($value)) {
                throw self::invalid($entry, "Invalid path parameter '{$name}': expected a string or an integer");
            }
            $filled[$name] = (string) $value;
            PathValidator::validate($entry->path, $name, $filled[$name], $entry->service);
        }

        return $filled;
    }

    /**
     * Query keys MUST be declared by the entry; edgeCache is allowed when it caches.
     *
     * @param array<array-key, mixed> $query
     * @throws InvalidArgumentException
     */
    public static function query(EndpointEntry $entry, array $query): void
    {
        $allowed = $entry->edgeCache ? [...$entry->queryParams, 'edgeCache'] : $entry->queryParams;
        $keys = array_map('strval', array_keys($query));
        self::requireNone($entry, array_diff($keys, $allowed), 'Unknown query params');
    }

    /**
     * @param array<array-key, mixed>|null $body
     * @throws InvalidArgumentException
     */
    public static function body(EndpointEntry $entry, ?array $body): void
    {
        if ($body !== null && !$entry->hasBody) {
            throw self::invalid($entry, "{$entry->id} takes no body");
        }
    }

    /**
     * @param array<array-key, string> $keys
     * @throws InvalidArgumentException
     */
    private static function requireNone(EndpointEntry $entry, array $keys, string $problem): void
    {
        if ($keys !== []) {
            throw self::invalid($entry, "{$problem} for {$entry->id}: " . implode(', ', $keys));
        }
    }

    private static function invalid(EndpointEntry $entry, string $message): InvalidArgumentException
    {
        return new InvalidArgumentException($message, $entry->service, $entry->path);
    }
}
