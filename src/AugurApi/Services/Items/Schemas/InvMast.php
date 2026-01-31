<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Schemas;

/**
 * Inventory master entity.
 */
final readonly class InvMast
{
    /**
     * @param array<string, mixed> $extra Additional properties (passthrough)
     */
    public function __construct(
        public ?int $invMastUid = null,
        public ?string $itemId = null,
        public ?string $itemDesc = null,
        public ?string $extendedDesc = null,
        public ?int $itemCategoryUid = null,
        public ?string $supplierPartNo = null,
        public ?float $weight = null,
        public ?string $defaultSellUom = null,
        public ?int $onlineCd = null,
        public ?int $statusCd = null,
        public array $extra = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $knownKeys = [
            'invMastUid', 'itemId', 'itemDesc', 'extendedDesc', 'itemCategoryUid',
            'supplierPartNo', 'weight', 'defaultSellUom', 'onlineCd', 'statusCd',
        ];
        $extra = array_diff_key($data, array_flip($knownKeys));

        return new self(
            invMastUid: isset($data['invMastUid']) ? (int) $data['invMastUid'] : null,
            itemId: $data['itemId'] ?? null,
            itemDesc: $data['itemDesc'] ?? null,
            extendedDesc: $data['extendedDesc'] ?? null,
            itemCategoryUid: isset($data['itemCategoryUid']) ? (int) $data['itemCategoryUid'] : null,
            supplierPartNo: $data['supplierPartNo'] ?? null,
            weight: isset($data['weight']) ? (float) $data['weight'] : null,
            defaultSellUom: $data['defaultSellUom'] ?? null,
            onlineCd: isset($data['onlineCd']) ? (int) $data['onlineCd'] : null,
            statusCd: isset($data['statusCd']) ? (int) $data['statusCd'] : null,
            extra: $extra,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'invMastUid' => $this->invMastUid,
            'itemId' => $this->itemId,
            'itemDesc' => $this->itemDesc,
            'extendedDesc' => $this->extendedDesc,
            'itemCategoryUid' => $this->itemCategoryUid,
            'supplierPartNo' => $this->supplierPartNo,
            'weight' => $this->weight,
            'defaultSellUom' => $this->defaultSellUom,
            'onlineCd' => $this->onlineCd,
            'statusCd' => $this->statusCd,
            ...$this->extra,
        ];
    }
}
