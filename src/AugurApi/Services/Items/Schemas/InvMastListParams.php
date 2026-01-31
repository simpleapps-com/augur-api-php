<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Schemas;

use AugurApi\Core\Schemas\EdgeCache;

/**
 * Parameters for listing inventory items.
 */
final class InvMastListParams
{
    public function __construct(
        public ?int $limit = null,
        public ?int $offset = null,
        public ?string $orderBy = null,
        public ?string $q = null,
        public ?int $itemCategoryUid = null,
        public ?int $onlineCd = null,
        public ?string $prefix = null,
        public ?int $statusCd = null,
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
            'itemCategoryUid' => $this->itemCategoryUid,
            'onlineCd' => $this->onlineCd,
            'prefix' => $this->prefix,
            'statusCd' => $this->statusCd,
            'edgeCache' => $this->edgeCache?->value,
        ], static fn ($v) => $v !== null);
    }
}
