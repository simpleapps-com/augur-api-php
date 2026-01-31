<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Element payment resource.
 *
 * @fullPath api.payments.element
 * @service payments
 * @domain payments
 */
final class ElementResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * Create payment account token from card data.
     *
     * @fullPath api.payments.element.createPayment
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createPayment(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/element/payment', $data);

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
