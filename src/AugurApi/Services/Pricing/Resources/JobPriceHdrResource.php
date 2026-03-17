<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * jobPriceHdr resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py pricing
 */
final class JobPriceHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /job-price-hdr
     *
     * Response data type: array
     * Known fields: jobPriceHdrUid, jobNo, jobDescription, companyId, customerId, salesLocId, contractNo, contactId, ... (35 total)
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
     * GET /job-price-hdr/{jobPriceHdrUid}
     *
     * Response data type: object
     * Known fields: jobPriceHdrUid, jobNo, jobDescription, companyId, customerId, salesLocId, contractNo, contactId, ... (35 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $jobPriceHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobPriceHdrUid}',
            $params,
            ['jobPriceHdrUid' => (string) $jobPriceHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /job-price-hdr/{jobPriceHdrUid}/lines
     *
     * Response data type: array
     * Known fields: jobPriceLineUid, jobPriceHdrUid, invMastUid, uom, unitSize, pricingMethod, sourcePrice, price, ... (54 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listLines(int $jobPriceHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobPriceHdrUid}/lines',
            $params,
            ['jobPriceHdrUid' => (string) $jobPriceHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /job-price-hdr/{jobPriceHdrUid}/lines/{jobPriceLineUid}
     *
     * Response data type: object
     * Known fields: jobPriceLineUid, jobPriceHdrUid, invMastUid, uom, unitSize, pricingMethod, sourcePrice, price, ... (54 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLines(int $jobPriceHdrUid, int $jobPriceLineUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{jobPriceHdrUid}/lines/{jobPriceLineUid}',
            $params,
            ['jobPriceHdrUid' => (string) $jobPriceHdrUid, 'jobPriceLineUid' => (string) $jobPriceLineUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
