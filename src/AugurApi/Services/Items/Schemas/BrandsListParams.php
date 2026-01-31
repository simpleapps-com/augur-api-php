<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Schemas;

use AugurApi\Core\Schemas\EdgeCache;

/**
 * Parameters for listing brands.
 */
final class BrandsListParams
{
    public function __construct(
        public ?int $limit = null,
        public ?int $offset = null,
        public ?string $orderBy = null,
        public ?string $q = null,
        public ?EdgeCache $edgeCache = null,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array_filter([
            'limit' => $this->limit,
            'offset' => $this->offset,
            'orderBy' => $this->orderBy,
            'q' => $this->q,
            'edgeCache' => $this->edgeCache?->value,
        ], static fn ($v) => $v !== null);
    }
}
