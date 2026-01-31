<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Schemas;

/**
 * Brand entity.
 */
final readonly class Brand
{
    /**
     * @param array<string, mixed> $extra Additional properties (passthrough)
     */
    public function __construct(
        public ?int $brandsUid = null,
        public ?string $brandName = null,
        public ?string $brandDescription = null,
        public ?string $brandLogo = null,
        public ?string $brandUrl = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public array $extra = [],
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $knownKeys = ['brandsUid', 'brandName', 'brandDescription', 'brandLogo', 'brandUrl', 'createdAt', 'updatedAt'];
        $extra = array_diff_key($data, array_flip($knownKeys));

        return new self(
            brandsUid: isset($data['brandsUid']) ? (int) $data['brandsUid'] : null,
            brandName: $data['brandName'] ?? null,
            brandDescription: $data['brandDescription'] ?? null,
            brandLogo: $data['brandLogo'] ?? null,
            brandUrl: $data['brandUrl'] ?? null,
            createdAt: $data['createdAt'] ?? null,
            updatedAt: $data['updatedAt'] ?? null,
            extra: $extra,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'brandsUid' => $this->brandsUid,
            'brandName' => $this->brandName,
            'brandDescription' => $this->brandDescription,
            'brandLogo' => $this->brandLogo,
            'brandUrl' => $this->brandUrl,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            ...$this->extra,
        ];
    }
}
