<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * clients resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-int
 */
final class ClientsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /clients
     *
     * Response data type: array
     *   clientsUid: int
     *   clientId: string
     *   usersUid: int
     *   keyVersion: int
     *   clientName: string
     *   description: string|null
     *   issuedById: int|null
     *   issuedByUsername: string|null
     *   retiredById: int|null
     *   retiredByUsername: string|null
     *   dateLastUsed: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
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
     * POST /clients
     *
     * Response data type: object
     *   clientsUid?: int
     *   clientId?: string
     *   usersUid?: int
     *   keyVersion?: int
     *   clientName?: string
     *   description?: string|null
     *   issuedById?: int|null
     *   issuedByUsername?: string|null
     *   statusCd?: int
     *   credential?: string
     *
     * @param array{usersUid: int, clientName: string, description?: string|null} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /clients/validate
     *
     * Response data type: object
     *   valid?: bool
     *   siteId?: string
     *   tokenUse?: string
     *   clientUid?: int
     *   clientId?: string
     *   usersUid?: int
     *   username?: string
     *   roles?: list<string>
     *   bundles?: list<string>
     *   resources?: list<string>
     *
     * @param array{credential?: string, clientId?: string, secret?: string} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createValidate(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/validate', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /clients/{clientsUid}
     *
     * Response data type: object
     *   clientsUid: int
     *   clientId: string
     *   usersUid: int
     *   keyVersion: int
     *   clientName: string
     *   description: string|null
     *   issuedById: int|null
     *   issuedByUsername: string|null
     *   retiredById: int|null
     *   retiredByUsername: string|null
     *   dateLastUsed: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $clientsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{clientsUid}',
            ['clientsUid' => (string) $clientsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /clients/{clientsUid}
     *
     * Response data type: object
     *   clientsUid?: int
     *   clientId?: string
     *   clientSecret?: string
     *   usersUid?: int
     *   keyVersion?: int
     *   clientName?: string
     *   description?: string|null
     *   issuedById?: int|null
     *   issuedByUsername?: string|null
     *   retiredById?: int|null
     *   retiredByUsername?: string|null
     *   dateLastUsed?: string|null
     *   dateCreated?: string
     *   dateLastModified?: string
     *   updateCd?: int
     *   statusCd?: int
     *   processCd?: int
     *   credential?: string
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $clientsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{clientsUid}',
            $params,
            ['clientsUid' => (string) $clientsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /clients/{clientsUid}
     *
     * Response data type: object
     *   clientsUid: int
     *   clientId: string
     *   usersUid: int
     *   keyVersion: int
     *   clientName: string
     *   description: string|null
     *   issuedById: int|null
     *   issuedByUsername: string|null
     *   retiredById: int|null
     *   retiredByUsername: string|null
     *   dateLastUsed: string|null
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *
     * @param array{clientName?: string|null, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $clientsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{clientsUid}',
            $data,
            ['clientsUid' => (string) $clientsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
