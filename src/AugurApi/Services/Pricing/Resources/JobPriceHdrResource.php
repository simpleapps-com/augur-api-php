<?php

declare(strict_types=1);

namespace AugurApi\Services\Pricing\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * Job price header resource.
 *
 * @fullPath api.pricing.jobPriceHdr
 * @service pricing
 * @domain pricing
 */
final class JobPriceHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List job price headers.
     *
     * @fullPath api.pricing.jobPriceHdr.list
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/job-price-hdr', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get job price header details.
     *
     * @fullPath api.pricing.jobPriceHdr.get
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $jobPriceHdrUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/job-price-hdr/{jobPriceHdrUid}',
            [],
            ['jobPriceHdrUid' => (string) $jobPriceHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * List job price lines.
     *
     * @fullPath api.pricing.jobPriceHdr.getLines
     * @param array<string, mixed> $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getLines(int $jobPriceHdrUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/job-price-hdr/{jobPriceHdrUid}/lines',
            $params,
            ['jobPriceHdrUid' => (string) $jobPriceHdrUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get job price line details.
     *
     * @fullPath api.pricing.jobPriceHdr.getLine
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLine(int $jobPriceHdrUid, int $jobPriceLineUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/job-price-hdr/{jobPriceHdrUid}/lines/{jobPriceLineUid}',
            [],
            [
                'jobPriceHdrUid' => (string) $jobPriceHdrUid,
                'jobPriceLineUid' => (string) $jobPriceLineUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
