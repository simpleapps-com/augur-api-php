<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Sism\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * import resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-sism
 */
final class ImportResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /import
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function list(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/daily-summary
     *
     * Response data type: object
     *   date: string
     *   total: int
     *   initial: int
     *   processing: int
     *   processingCoupon: int
     *   processCoupon: int
     *   validate: int
     *   validating: int
     *   validated: int
     *   processed: int
     *   hold: int
     *   delivering: int
     *   delivered: int
     *   importing: int
     *   imported: int
     *   redelivered: int
     *   invalid: int
     *   failed: int
     *   error: int
     *   cancelled: int
     *   stopped: int
     *   skipped: int
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDailySummary(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/daily-summary', $params);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/recent
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listRecent(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/recent', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/stuck
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listStuck(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/stuck', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /import/{importUid}
     *
     * Response data type: object
     *   importUid: int
     *   scheduledImportMasterUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   sourceName: string|null
     *   sourceId: int
     *   importState: string
     *   jsonData: string|null
     *   importStatusCd: int
     *   importResults: string|null
     *   referenceNo: string|null
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(string $importUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{importUid}',
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/{importUid}
     *
     * Response data type: object
     *   importUid: int
     *   scheduledImportMasterUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   sourceName: string|null
     *   sourceId: int
     *   importState: string
     *   jsonData: string|null
     *   importStatusCd: int
     *   importResults: string|null
     *   referenceNo: string|null
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}',
            $params,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /import/{importUid}
     *
     * Response data type: object
     *   importUid: int
     *   scheduledImportMasterUid: int
     *   dateCreated: string
     *   dateLastModified: string
     *   sourceName: string|null
     *   sourceId: int
     *   importState: string
     *   jsonData: string|null
     *   importStatusCd: int
     *   importResults: string|null
     *   referenceNo: string|null
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(string $importUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{importUid}',
            $data,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/{importUid}/imp-oe-hdr
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listImpOeHdr(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr',
            $params,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /import/{importUid}/imp-oe-hdr
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function updateImpOeHdr(string $importUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr',
            $data,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/{importUid}/imp-oe-hdr-salesrep
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listImpOeHdrSalesrep(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr-salesrep',
            $params,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /import/{importUid}/imp-oe-hdr-salesrep
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<mixed>
     */
    public function updateImpOeHdrSalesrep(string $importUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr-salesrep',
            $data,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /import/{importUid}/imp-oe-hdr-web
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listImpOeHdrWeb(string $importUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{importUid}/imp-oe-hdr-web',
            $params,
            ['importUid' => (string) $importUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
