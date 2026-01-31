<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Sism\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Import order entry line resource.
 *
 * @fullPath api.p21Sism.impOeLine
 * @service p21-sism
 * @domain order-entry-processing
 */
final class ImpOeLineResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List import order entry lines with filtering capabilities.
     *
     * @fullPath api.p21Sism.impOeLine.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/imp_oe_line', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get order entry line details by composite key (importUid, lineNo).
     *
     * @fullPath api.p21Sism.impOeLine.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $importUid, int $lineNo): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/imp_oe_line/{importUid}/{lineNo}',
            [],
            [
                'importUid' => (string) $importUid,
                'lineNo' => (string) $lineNo,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Update order entry line by composite key (importUid, lineNo).
     *
     * @fullPath api.p21Sism.impOeLine.update
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $importUid, int $lineNo, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/imp_oe_line/{importUid}/{lineNo}',
            $data,
            [
                'importUid' => (string) $importUid,
                'lineNo' => (string) $lineNo,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($d) => $d);
    }
}
