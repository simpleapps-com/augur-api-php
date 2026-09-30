<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * notifications resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 */
final class NotificationsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /notifications
     *
     * Response data type: object
     *   notificationsUid: int
     *   serviceName: string|null
     *   dataTypeName: string|null
     *   type: string|null
     *   dataTypeUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
