<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Geo codes postal codes resource.
 *
 * @fullPath api.agrSite.geoCodesPostalCodes
 * @service agr_site
 * @domain augur
 */
final class GeoCodesPostalCodesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List postal codes.
     *
     * @fullPath api.agrSite.geoCodesPostalCodes.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/geo-codes-postal-codes', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get postal code details.
     *
     * @fullPath api.agrSite.geoCodesPostalCodes.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $geoCodesPostalCodesUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/geo-codes-postal-codes/{geoCodesPostalCodesUid}',
            [],
            ['geoCodesPostalCodesUid' => (string) $geoCodesPostalCodesUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
