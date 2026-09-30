<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * itemCategory resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py legacy
 */
final class ItemCategoryResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /item-category/{itemCategoryUid}
     *
     * Response data type: object
     *   itemCategoryUid: int
     *   itemCategoryId: string
     *   itemCategoryDesc: string
     *   article: string|null
     *   boxFolderId: string|null
     *   masterCategoryFlag: string
     *   parentCategoryFlag: string
     *   displayOnWebFlag: string
     *   deleteFlag: string
     *   customerApproval: string|null
     *   dateLastModified: string
     *   dateLastChecked: string
     *   article2: string|null
     *   article3: string|null
     *   article4: string|null
     *   article5: string|null
     *   sampleItemId: string|null
     *   metaDesc: string|null
     *   title: string|null
     *   updateCd: int
     *   subCategoryImageFile: string|null
     *   lastMaintainedBy: string
     *   dateCreated: string
     *   createdBy: string
     *   catalogPage: string|null
     *   displayMasterProductFlag: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $itemCategoryUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{itemCategoryUid}',
            $params,
            ['itemCategoryUid' => (string) $itemCategoryUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
