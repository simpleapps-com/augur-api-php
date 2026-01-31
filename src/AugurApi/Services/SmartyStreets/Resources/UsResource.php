<?php

declare(strict_types=1);

namespace AugurApi\Services\SmartyStreets\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * US resource.
 *
 * @fullPath api.smartyStreets.us
 * @service smarty_streets
 * @domain address-validation-and-geocoding
 */
final class UsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Validate and standardize US addresses.
     *
     * @fullPath api.smartyStreets.us.lookup.get
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function lookup(array $params): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/us/lookup', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
