<?php

declare(strict_types=1);

namespace AugurApi\Core;

/**
 * One endpoint in the language-neutral endpoint registry.
 *
 * Mirrors a single entry of registry.json (see wiki Endpoint-Registry).
 *
 * @phpstan-type EndpointEntryArray array{
 *     id: string,
 *     service: string,
 *     method: string,
 *     path: string,
 *     pathParams: list<string>,
 *     queryParams: list<string>,
 *     aliases: list<string>,
 *     hasBody: bool,
 *     auth: string,
 *     edgeCache: bool,
 *     readOnly?: bool
 * }
 */
final class EndpointEntry
{
    /**
     * @param list<string> $pathParams Path params in URL order
     * @param list<string> $queryParams
     * @param list<string> $aliases
     */
    public function __construct(
        public readonly string $id,
        public readonly string $service,
        public readonly string $method,
        public readonly string $path,
        public readonly array $pathParams,
        public readonly array $queryParams,
        public readonly array $aliases,
        public readonly bool $hasBody,
        public readonly string $auth,
        public readonly bool $edgeCache,
        public readonly ?bool $readOnly = null,
    ) {
    }

    /**
     * @param EndpointEntryArray $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['service'],
            $data['method'],
            $data['path'],
            $data['pathParams'],
            $data['queryParams'],
            $data['aliases'],
            $data['hasBody'],
            $data['auth'],
            $data['edgeCache'],
            $data['readOnly'] ?? null,
        );
    }

    /**
     * Contract key order; readOnly is omitted unless set.
     *
     * @return EndpointEntryArray
     */
    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'service' => $this->service,
            'method' => $this->method,
            'path' => $this->path,
            'pathParams' => $this->pathParams,
            'queryParams' => $this->queryParams,
            'aliases' => $this->aliases,
            'hasBody' => $this->hasBody,
            'auth' => $this->auth,
            'edgeCache' => $this->edgeCache,
        ];
        if ($this->readOnly !== null) {
            $data['readOnly'] = $this->readOnly;
        }
        return $data;
    }
}
