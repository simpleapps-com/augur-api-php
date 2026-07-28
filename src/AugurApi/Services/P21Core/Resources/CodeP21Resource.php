<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * codeP21 resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 */
final class CodeP21Resource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /code-p21
     *
     * Response data type: array
     * Known fields: codeUid, codeNo, languageId, codeDescription, rowStatusFlag, dateCreated, dateLastModified, lastMaintainedBy, ... (10 total)
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
     * GET /code-p21/{codeUid}
     *
     * Response data type: object
     * Known fields: codeUid, codeNo, languageId, codeDescription, rowStatusFlag, dateCreated, dateLastModified, lastMaintainedBy, ... (10 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $codeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{codeUid}',
            $params,
            ['codeUid' => (string) $codeUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
