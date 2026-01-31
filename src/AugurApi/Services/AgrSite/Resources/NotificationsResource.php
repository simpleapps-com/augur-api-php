<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Notifications resource.
 *
 * @fullPath api.agrSite.notifications
 * @service agr_site
 * @domain notification-management
 */
final class NotificationsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Create notification.
     *
     * @fullPath api.agrSite.notifications.create
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/notifications', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
