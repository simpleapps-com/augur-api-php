<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Payment types resource.
 *
 * @fullPath api.p21Core.paymentTypes
 * @service p21-core
 * @domain payment-processing
 */
final class PaymentTypesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List payment types.
     *
     * @fullPath api.p21Core.paymentTypes.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/payment-types', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
