<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * MetaFiles resource.
 *
 * @fullPath api.agrSite.metaFiles
 * @service agr_site
 * @domain seo-management
 */
final class MetaFilesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Get robots.txt configuration.
     *
     * @fullPath api.agrSite.metaFiles.getRobots
     * @return BaseResponse<string>
     */
    public function getRobots(): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/meta-files/robots');

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
