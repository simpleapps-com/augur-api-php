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
     * Known fields: clientsUid, clientId, clientSecret, usersUid, keyVersion, clientName, description, issuedById, ... (17 total)
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
     * POST /clients
     *
     * Response data type: object
     * Known fields: clientsUid, clientId, usersUid, keyVersion, clientName, description, issuedById, issuedByUsername, ... (10 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function create(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /clients/validate
     *
     * Response data type: object
     * Known fields: valid, siteId, tokenUse, clientUid, clientId, usersUid, username, roles, ... (10 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createValidate(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/validate', $data);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /clients/{clientsUid}
     *
     * Response data type: object
     * Known fields: clientsUid, clientId, clientSecret, usersUid, keyVersion, clientName, description, issuedById, ... (17 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /clients/{clientsUid}
     *
     * Response data type: object
     * Known fields: clientsUid, clientId, clientSecret, usersUid, keyVersion, clientName, description, issuedById, ... (17 total)
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /clients/{clientsUid}
     *
     * Response data type: object
     * Known fields: clientsUid, clientId, clientSecret, usersUid, keyVersion, clientName, description, issuedById, ... (17 total)
     *
     * @param array<string, mixed> $data
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

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
