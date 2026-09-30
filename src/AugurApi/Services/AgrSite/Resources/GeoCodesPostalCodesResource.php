<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * geoCodesPostalCodes resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 */
final class GeoCodesPostalCodesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /geo-codes-postal-codes
     *
     * Response data type: array
     *   geoCodesPostalCodesUid: int
     *   countryCode: string
     *   postalCode: string
     *   placeName: string
     *   adminName1: string
     *   adminCode1: string
     *   adminName2: string|null
     *   adminCode2: string|null
     *   adminName3: string|null
     *   adminCode3: string|null
     *   latitude: float
     *   longitude: float
     *   accuracy: int|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /geo-codes-postal-codes/{geoCodesPostalCodesUid}
     *
     * Response data type: object
     *   geoCodesPostalCodesUid: int
     *   countryCode: string
     *   postalCode: string
     *   placeName: string
     *   adminName1: string
     *   adminCode1: string
     *   adminName2: string|null
     *   adminCode2: string|null
     *   adminName3: string|null
     *   adminCode3: string|null
     *   latitude: float
     *   longitude: float
     *   accuracy: int|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $geoCodesPostalCodesUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{geoCodesPostalCodesUid}',
            $params,
            ['geoCodesPostalCodesUid' => (string) $geoCodesPostalCodesUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
