<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Core\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * address resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-core.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-core.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-core.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-core
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * AddressListItem: A Prophet 21 address with its mailing and physical lines and Augur's status,
 * enabled and default flags
 * Returned by: $api->p21Core->address->list()
 * Returned by: $api->p21Core->address->get($id)
 * Returned by: $api->p21Core->address->listCorpAddress($id)
 * Returned by: $api->p21Core->address->listDefault($id)
 * Returned by: $api->p21Core->address->getEnable($id)
 *   id: float — Prophet 21 address ID
 *   name: string — Address name
 *   mailAddress1: string|null — Mailing address line 1
 *   mailAddress2: string|null — Mailing address line 2
 *   mailCity: string|null — Mailing city
 *   mailState: string|null — Mailing state or province
 *   mailPostalCode: string|null — Mailing postal code
 *   mailCountry: string|null — Mailing country
 *   physAddress1: string|null — Physical address line 1
 *   physAddress2: string|null — Physical address line 2
 *   physCity: string|null — Physical city
 *   physState: string|null — Physical state or province
 *   physPostalCode: string|null — Physical postal code
 *   physCountry: string|null — Physical country
 *   carrierFlag: string|null — Y when the address is a carrier
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code
 *   enabledCd: int — 704 when the address is enabled for the site, 705 when not
 *   defaultCd: int — 704 for the site's default address, 705 otherwise
 *
 * @phpstan-type AddressListItem array{id: float, name: string, mailAddress1: string|null, mailAddress2: string|null, mailCity: string|null, mailState: string|null, mailPostalCode: string|null, mailCountry: string|null, physAddress1: string|null, physAddress2: string|null, physCity: string|null, physState: string|null, physPostalCode: string|null, physCountry: string|null, carrierFlag: string|null, statusCd: int, processCd: int, enabledCd: int, defaultCd: int}
 */
final class AddressResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /address
     *
     * List Addresses
     * Call: $api->p21Core->address->list()
     *
     * Response data, each item: A Prophet 21 address with its mailing and physical lines and
     * Augur's status, enabled and default flags
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an address column.
     *
     * GET https://p21-core.augur-api.com/address
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1address/get
     *
     * Query params ($params; `?` = optional):
     *   carrierFlag?: string — Carrier Flag [(Y)|N|Blank]
     *   defaultCd?: int — Shipping Method default Code (default_cd) [704|705|700|Blank]
     *   enabledCd?: int — Shipping Method Enabled Code (enabled_cd) [704|705|700|Blank]
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: id|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of AddressListItem (fields listed on the class)
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
     * GET /address/{id}
     *
     * Get Address Details
     * Call: $api->p21Core->address->get($id)
     *
     * Response data: A Prophet 21 address with its mailing and physical lines and Augur's status,
     * enabled and default flags
     *
     * GET https://p21-core.augur-api.com/address/{id}
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1address~1{id}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: AddressListItem (fields listed on the class)
     *
     * @param int $id Prophet 21 address ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /address/{id}/corp-address
     *
     * Get Corporate Address List
     * Call: $api->p21Core->address->listCorpAddress($id)
     *
     * Response data, each item: A Prophet 21 address with its mailing and physical lines and
     * Augur's status, enabled and default flags
     *
     * Errors:
     *   400: orderBy is not column|ASC or column|DESC on an address column.
     *
     * GET https://p21-core.augur-api.com/address/{id}/corp-address
     * Contract:
     * https://p21-core.augur-api.com/openapi.json#/paths/~1address~1{id}~1corp-address/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: id|ASC)
     *   q?: string — Search Query
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: every status
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of AddressListItem (fields listed on the class)
     *
     * @param int $id Prophet 21 address ID
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listCorpAddress(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/corp-address',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /address/{id}/default
     *
     * Set Address as default Shipping Method
     * Call: $api->p21Core->address->listDefault($id)
     *
     * Response data: A Prophet 21 address with its mailing and physical lines and Augur's status,
     * enabled and default flags
     *
     * GET https://p21-core.augur-api.com/address/{id}/default
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1address~1{id}~1default/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: AddressListItem (fields listed on the class)
     *
     * @param int $id Prophet 21 address ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDefault(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/default',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /address/{id}/enable
     *
     * Enable/disable Address as Shipping Method
     * Call: $api->p21Core->address->getEnable($id)
     *
     * Response data: A Prophet 21 address with its mailing and physical lines and Augur's status,
     * enabled and default flags
     *
     * GET https://p21-core.augur-api.com/address/{id}/enable
     * Contract: https://p21-core.augur-api.com/openapi.json#/paths/~1address~1{id}~1enable/get
     *
     * Query params ($params; `?` = optional):
     *   enabledCd?: int — Shipping Method Enabled Code (enabled_cd) [(704)|705|Blank]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: AddressListItem (fields listed on the class)
     *
     * @param int $id Prophet 21 address ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getEnable(int $id, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{id}/enable',
            $params,
            ['id' => (string) $id],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
