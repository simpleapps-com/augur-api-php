<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * legacy resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py legacy
 */
final class LegacyResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /legacy/state
     *
     * Response data type: array
     *   stateUid: int
     *   countryUid: int|null
     *   twoLetterCode: string|null
     *   stateName: string|null
     *   dateCreated: string|null
     *   createdBy: string|null
     *   dateLastModified: string|null
     *   lastMaintainedBy: string|null
     *   combinedFederalState1099No: int|null
     *   telecheckStateCode: int|null
     *   updateCd: int
     *   active: int|null
     *   taxRate: float|null
     *   dateLastChecked: string|null
     *   taxShipping: int|null
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listState(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/state', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /legacy/state
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function createState(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/state', $data);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /legacy/state/{stateUid}
     *
     * @return BaseResponse<mixed>
     */
    public function deleteState(int $stateUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/state/{stateUid}',
            ['stateUid' => (string) $stateUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /legacy/state/{stateUid}
     *
     * Response data type: object
     *   stateUid: int
     *   countryUid: int|null
     *   twoLetterCode: string|null
     *   stateName: string|null
     *   dateCreated: string|null
     *   createdBy: string|null
     *   dateLastModified: string|null
     *   lastMaintainedBy: string|null
     *   combinedFederalState1099No: int|null
     *   telecheckStateCode: int|null
     *   updateCd: int
     *   active: int|null
     *   taxRate: float|null
     *   dateLastChecked: string|null
     *   taxShipping: int|null
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getState(int $stateUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/state/{stateUid}',
            $params,
            ['stateUid' => (string) $stateUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /legacy/state/{stateUid}
     *
     * Response data type: object
     *   stateUid: int
     *   countryUid: int|null
     *   twoLetterCode: string|null
     *   stateName: string|null
     *   dateCreated: string|null
     *   createdBy: string|null
     *   dateLastModified: string|null
     *   lastMaintainedBy: string|null
     *   combinedFederalState1099No: int|null
     *   telecheckStateCode: int|null
     *   updateCd: int
     *   active: int|null
     *   taxRate: float|null
     *   dateLastChecked: string|null
     *   taxShipping: int|null
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateState(int $stateUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/state/{stateUid}',
            $data,
            ['stateUid' => (string) $stateUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
