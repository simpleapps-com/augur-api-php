<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * internal resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://items.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://items.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://items.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 */
final class InternalResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /internal/pdf
     *
     * Generate PDF
     * Call: $api->items->internal->createPdf($data)
     *
     * POST https://items.augur-api.com/internal/pdf
     * Contract: https://items.augur-api.com/openapi.json#/paths/~1internal~1pdf/post
     *
     * Response data type: string
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<string>
     */
    public function createPdf(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/pdf', $data);

        /** @var BaseResponse<string> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
