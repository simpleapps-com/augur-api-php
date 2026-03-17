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
     * Known fields: geoCodesPostalCodesUid, countryCode, postalCode, placeName, adminName1, adminCode1, adminName2, adminCode2, ... (18 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /geo-codes-postal-codes/{geoCodesPostalCodesUid}
     *
     * Response data type: object
     * Known fields: geoCodesPostalCodesUid, countryCode, postalCode, placeName, adminName1, adminCode1, adminName2, adminCode2, ... (18 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
