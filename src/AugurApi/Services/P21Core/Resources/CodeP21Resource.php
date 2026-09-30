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
     *   codeUid: int
     *   codeNo: int
     *   languageId: string
     *   codeDescription: string
     *   rowStatusFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   codeSubDescription: string|null
     *   updateCd: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /code-p21/{codeUid}
     *
     * Response data type: object
     *   codeUid: int
     *   codeNo: int
     *   languageId: string
     *   codeDescription: string
     *   rowStatusFlag: string
     *   dateCreated: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   codeSubDescription: string|null
     *   updateCd: int
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

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
