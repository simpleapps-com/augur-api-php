<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * distributors resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://vmi.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://vmi.augur-api.com/openapi.json: the full contract: request and response bodies field by
 *       field, descriptions, formats and documented errors.
 *   https://vmi.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py vmi
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * DistributorsListItem:
 * Returned by: $api->vmi->distributors->list()
 * Returned by: $api->vmi->distributors->create($data)
 * Returned by: $api->vmi->distributors->get($distributorsUid)
 *   distributorsUid: int — Distributor ID
 *   customerId: float — Prophet 21 customer the record belongs to
 *   distributorsId: string — Distributor key derived from the name (max 255 chars)
 *   distributorsName: string — Distributor name (max 255 chars)
 *   distributorsDesc: string — Distributor description (max 255 chars)
 *   distributorsEmail: string — Distributor contact email (max 255 chars)
 *   distributorsAccount: string — Customer's account number with the distributor (max 255 chars)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *
 * DistributorsCreateBody: Create a distributor for a customer, or return the one whose derived
 * distributors_id already exists
 * Request body of: $api->vmi->distributors->create($data)
 *   customerId: float|null — Prophet 21 customer the distributor belongs to; without it nothing is
 *       created
 *   distributorsName: string|null — Distributor name; distributors_id is derived from it. Without
 *       it nothing is created
 *   distributorsDesc?: string|null — Distributor description
 *   distributorsEmail?: string|null — Distributor contact email
 *   distributorsAccount?: string|null — Customer's account number with the distributor
 *
 * DistributorsUpdateBody: Change a distributor; an absent field keeps its current value
 * Request body of: $api->vmi->distributors->update($distributorsUid, $data)
 *   customerId?: float|null — Prophet 21 customer the distributor belongs to
 *   distributorsName?: string|null — Distributor name; distributors_id is re-derived from it
 *   distributorsDesc?: string|null — Distributor description
 *   distributorsEmail?: string|null — Distributor contact email
 *   distributorsAccount?: string|null — Customer's account number with the distributor
 *
 * DistributorsEnableUpdateData: Outcome of an enable, disable, or delete request
 * Returned by: $api->vmi->distributors->updateEnable($distributorsUid, $data)
 *   statusCd: int — Status applied: 704 (enable), 705 (disable), or 700 (delete)
 *   statusName: string — enable, disable, or delete, matching statusCd
 *   updated: bool — true when the record's status changed; false when it already had this status
 *   originalStatusCd: int — Status before the request
 *
 * DistributorsEnableUpdateBody: Enable, disable, or delete a record; with neither field the record
 * is enabled
 * Request body of: $api->vmi->distributors->updateEnable($distributorsUid, $data)
 *   statusName?: string|null — enable, disable, or delete; used only when statusCd is absent
 *   statusCd?: int|null — 704 (enable), 705 (disable), or 700 (delete); any other value enables
 *
 * DistributorsProductsCreateData:
 * Returned by: $api->vmi->distributors->createProducts($distributorsUid, $data)
 *   productsUid: int — Product ID
 *   distributorsUid: int — Distributor that supplies the product
 *   productsId: string — Product ID within the distributor (max 255 chars)
 *   productsDesc: string — Product description (max 255 chars)
 *   defaultSellingUnit: string — Default selling unit (max 255 chars)
 *   dateCreated: string — When the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the record last changed (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code (704 = Active, 1185 = Import Complete)
 *   upcOrEanId: string|null — UPC or EAN id (max 15 chars)
 *   imageUrl: string|null — image url (max 255 chars)
 *   partNumber: string|null — manufacturer part number (max 255 chars)
 *
 * DistributorsProductsCreateBody: Create a distributor product, or return the one with the same
 * products_id; the distributor comes from the path
 * Request body of: $api->vmi->distributors->createProducts($distributorsUid, $data)
 *   productsId: string|null — Product ID within the distributor; without it nothing is created
 *   productsDesc?: string|null — Product description; defaults to the product ID
 *   defaultSellingUnit?: string|null — Default selling unit; defaults to EA
 *   imageUrl?: string|null — Product image URL
 *   partNumber?: string|null — Manufacturer part number
 *   upcOrEanId?: string|null — UPC or EAN code
 *
 * @phpstan-type DistributorsListItem array{distributorsUid: int, customerId: float, distributorsId: string, distributorsName: string, distributorsDesc: string, distributorsEmail: string, distributorsAccount: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type DistributorsCreateBody array{customerId: float|null, distributorsName: string|null, distributorsDesc?: string|null, distributorsEmail?: string|null, distributorsAccount?: string|null}
 * @phpstan-type DistributorsUpdateBody array{customerId?: float|null, distributorsName?: string|null, distributorsDesc?: string|null, distributorsEmail?: string|null, distributorsAccount?: string|null}
 * @phpstan-type DistributorsEnableUpdateData array{statusCd: int, statusName: string, updated: bool, originalStatusCd: int}
 * @phpstan-type DistributorsEnableUpdateBody array{statusName?: string|null, statusCd?: int|null}
 * @phpstan-type DistributorsProductsCreateData array{productsUid: int, distributorsUid: int, productsId: string, productsDesc: string, defaultSellingUnit: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, upcOrEanId: string|null, imageUrl: string|null, partNumber: string|null}
 * @phpstan-type DistributorsProductsCreateBody array{productsId: string|null, productsDesc?: string|null, defaultSellingUnit?: string|null, imageUrl?: string|null, partNumber?: string|null, upcOrEanId?: string|null}
 */
final class DistributorsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /distributors
     *
     * List distributors
     * Call: $api->vmi->distributors->list()
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://vmi.augur-api.com/distributors
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1distributors/get
     *
     * Query params ($params; `?` = optional):
     *   customerId: int — Prophet 21 customer to filter by
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: distributors_uid|ASC)
     *   statusCd?: int — Status Code (status_cd) [(704)|705,700]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of DistributorsListItem (fields listed on the class)
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
     * POST /distributors
     *
     * Create distributor
     * Call: $api->vmi->distributors->create($data)
     *
     * Request body: Create a distributor for a customer, or return the one whose derived
     * distributors_id already exists
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * POST https://vmi.augur-api.com/distributors
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1distributors/post
     *
     * Request body ($data): DistributorsCreateBody (fields listed on the class)
     *
     * Response data type: DistributorsListItem (fields listed on the class)
     *
     * @param DistributorsCreateBody $data
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
     * DELETE /distributors/{distributorsUid}
     *
     * DELETE distributor
     * Call: $api->vmi->distributors->delete($distributorsUid)
     *
     * Errors:
     *   404: No row exists with this ID.
     *
     * DELETE https://vmi.augur-api.com/distributors/{distributorsUid}
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1distributors~1{distributorsUid}/delete
     *
     * Response data type: bool
     *
     * @param int $distributorsUid Distributor ID
     * @return BaseResponse<bool>
     */
    public function delete(int $distributorsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{distributorsUid}',
            ['distributorsUid' => (string) $distributorsUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /distributors/{distributorsUid}
     *
     * Get distributor Details
     * Call: $api->vmi->distributors->get($distributorsUid)
     *
     * GET https://vmi.augur-api.com/distributors/{distributorsUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1distributors~1{distributorsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: DistributorsListItem (fields listed on the class)
     *
     * @param int $distributorsUid Distributor ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $distributorsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{distributorsUid}',
            $params,
            ['distributorsUid' => (string) $distributorsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /distributors/{distributorsUid}
     *
     * Update distributor
     * Call: $api->vmi->distributors->update($distributorsUid, $data)
     *
     * Request body: Change a distributor; an absent field keeps its current value
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No row exists with this ID.
     *
     * PUT https://vmi.augur-api.com/distributors/{distributorsUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1distributors~1{distributorsUid}/put
     *
     * Request body ($data): DistributorsUpdateBody (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param int $distributorsUid Distributor ID
     * @param DistributorsUpdateBody $data
     * @return BaseResponse<bool>
     */
    public function update(int $distributorsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{distributorsUid}',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /distributors/{distributorsUid}/enable
     *
     * Enable/Disable/Delete distributor
     * Call: $api->vmi->distributors->updateEnable($distributorsUid, $data)
     *
     * Request body: Enable, disable, or delete a record; with neither field the record is enabled
     * Response data: Outcome of an enable, disable, or delete request
     *
     * Errors:
     *   404: No row exists with this ID.
     *
     * PUT https://vmi.augur-api.com/distributors/{distributorsUid}/enable
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1distributors~1{distributorsUid}~1enable/put
     *
     * Request body ($data): DistributorsEnableUpdateBody (fields listed on the class)
     *
     * Response data type: DistributorsEnableUpdateData (fields listed on the class)
     *
     * @param int $distributorsUid Distributor ID
     * @param DistributorsEnableUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateEnable(int $distributorsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{distributorsUid}/enable',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /distributors/{distributorsUid}/products
     *
     * Create Product
     * Call: $api->vmi->distributors->createProducts($distributorsUid, $data)
     *
     * Request body: Create a distributor product, or return the one with the same products_id; the
     * distributor comes from the path
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * POST https://vmi.augur-api.com/distributors/{distributorsUid}/products
     * Contract:
     * https://vmi.augur-api.com/openapi.json#/paths/~1distributors~1{distributorsUid}~1products/post
     *
     * Request body ($data): DistributorsProductsCreateBody (fields listed on the class)
     *
     * Response data type: DistributorsProductsCreateData (fields listed on the class)
     *
     * @param int $distributorsUid Distributor ID
     * @param DistributorsProductsCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createProducts(int $distributorsUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{distributorsUid}/products',
            $data,
            ['distributorsUid' => (string) $distributorsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
