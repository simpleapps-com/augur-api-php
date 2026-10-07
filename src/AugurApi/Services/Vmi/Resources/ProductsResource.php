<?php

declare(strict_types=1);

namespace AugurApi\Services\Vmi\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * products resource — generated from spec.
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
 * DistributorsProductsCreateData:
 * Returned by: $api->vmi->products->list()
 * Returned by: $api->vmi->products->get($productsUid)
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
 * ProductsFindListItem: One product search match, from VMI products or Prophet 21 items
 * Returned by: $api->vmi->products->listFind()
 *   defaultSellingUnit: string|null — Default selling unit
 *   description: string|null — Product or item description
 *   invMastUid: int — products_uid for a VMI product, inv_mast_uid for a Prophet 21 item
 *   itemId: string — Product or item ID
 *   type: string — Source of the match: products or prophet21
 *
 * ProductsUpdateBody: Change a distributor product; an absent field keeps its current value
 * Request body of: $api->vmi->products->update($productsUid, $data)
 *   distributorsUid?: int|null — Distributor the product belongs to
 *   productsId?: string|null — Product ID; trimmed and upper-cased
 *   productsDesc?: string|null — Product description
 *   defaultSellingUnit?: string|null — Default selling unit
 *   imageUrl?: string|null — Product image URL
 *   partNumber?: string|null — Manufacturer part number
 *   upcOrEanId?: string|null — UPC or EAN code
 *   updateCd?: int|null — Update code
 *   statusCd?: int|null — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd?: int|null — Process code
 *
 * DistributorsEnableUpdateData: Outcome of an enable, disable, or delete request
 * Returned by: $api->vmi->products->updateEnable($productsUid, $data)
 *   statusCd: int — Status applied: 704 (enable), 705 (disable), or 700 (delete)
 *   statusName: string — enable, disable, or delete, matching statusCd
 *   updated: bool — true when the record's status changed; false when it already had this status
 *   originalStatusCd: int — Status before the request
 *
 * DistributorsEnableUpdateBody: Enable, disable, or delete a record; with neither field the record
 * is enabled
 * Request body of: $api->vmi->products->updateEnable($productsUid, $data)
 *   statusName?: string|null — enable, disable, or delete; used only when statusCd is absent
 *   statusCd?: int|null — 704 (enable), 705 (disable), or 700 (delete); any other value enables
 *
 * @phpstan-type DistributorsProductsCreateData array{productsUid: int, distributorsUid: int, productsId: string, productsDesc: string, defaultSellingUnit: string, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, upcOrEanId: string|null, imageUrl: string|null, partNumber: string|null}
 * @phpstan-type ProductsFindListItem array{defaultSellingUnit: string|null, description: string|null, invMastUid: int, itemId: string, type: string}
 * @phpstan-type ProductsUpdateBody array{distributorsUid?: int|null, productsId?: string|null, productsDesc?: string|null, defaultSellingUnit?: string|null, imageUrl?: string|null, partNumber?: string|null, upcOrEanId?: string|null, updateCd?: int|null, statusCd?: int|null, processCd?: int|null}
 * @phpstan-type DistributorsEnableUpdateData array{statusCd: int, statusName: string, updated: bool, originalStatusCd: int}
 * @phpstan-type DistributorsEnableUpdateBody array{statusName?: string|null, statusCd?: int|null}
 */
final class ProductsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /products
     *
     * List Products
     * Call: $api->vmi->products->list()
     *
     * List products
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *
     * GET https://vmi.augur-api.com/products
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1products/get
     *
     * Query params ($params; `?` = optional):
     *   customerId: int — customer.customer_id
     *   distributorsUid: int — Distributor to filter by
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   orderBy?: string — Order By (Default: products_uid|ASC)
     *   prefix?: string — Product Id Prefix
     *   q?: string — Query String
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of DistributorsProductsCreateData (fields listed on the class)
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
     * GET /products/find
     *
     * Find Products
     * Call: $api->vmi->products->listFind()
     *
     * Find products and items
     *
     * Response data, each item: One product search match, from VMI products or Prophet 21 items
     *
     * GET https://vmi.augur-api.com/products/find
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1products~1find/get
     *
     * Query params ($params; `?` = optional):
     *   customerId: int — customer.customer_id
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset results (Default: 0)
     *   prefix?: string — Product Id Prefix
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ProductsFindListItem (fields listed on the class)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listFind(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/find', $params);

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /products/{productsUid}
     *
     * DELETE Product
     * Call: $api->vmi->products->delete($productsUid)
     *
     * Errors:
     *   400: productsUid is below 1.
     *   404: No row exists with this ID.
     *
     * DELETE https://vmi.augur-api.com/products/{productsUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1products~1{productsUid}/delete
     *
     * Response data type: bool
     *
     * @param int $productsUid Product ID
     * @return BaseResponse<bool>
     */
    public function delete(int $productsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{productsUid}',
            ['productsUid' => (string) $productsUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /products/{productsUid}
     *
     * Get Product Details
     * Call: $api->vmi->products->get($productsUid)
     *
     * Errors:
     *   400: productsUid is below 1.
     *   404: No product with this productsUid.
     *
     * GET https://vmi.augur-api.com/products/{productsUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1products~1{productsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: DistributorsProductsCreateData (fields listed on the class)
     *
     * @param int $productsUid Product ID
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $productsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{productsUid}',
            $params,
            ['productsUid' => (string) $productsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /products/{productsUid}
     *
     * Update Product
     * Call: $api->vmi->products->update($productsUid, $data)
     *
     * Request body: Change a distributor product; an absent field keeps its current value
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   404: No row exists with this ID.
     *
     * PUT https://vmi.augur-api.com/products/{productsUid}
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1products~1{productsUid}/put
     *
     * Request body ($data): ProductsUpdateBody (fields listed on the class)
     *
     * Response data type: bool
     *
     * @param int $productsUid Product ID
     * @param ProductsUpdateBody $data
     * @return BaseResponse<bool>
     */
    public function update(int $productsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{productsUid}',
            $data,
            ['productsUid' => (string) $productsUid],
        );

        /** @var BaseResponse<bool> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /products/{productsUid}/enable
     *
     * Enable/Disable/Delete Product
     * Call: $api->vmi->products->updateEnable($productsUid, $data)
     *
     * Request body: Enable, disable, or delete a record; with neither field the record is enabled
     * Response data: Outcome of an enable, disable, or delete request
     *
     * Errors:
     *   400: productsUid is below 1.
     *   404: No row exists with this ID.
     *
     * PUT https://vmi.augur-api.com/products/{productsUid}/enable
     * Contract: https://vmi.augur-api.com/openapi.json#/paths/~1products~1{productsUid}~1enable/put
     *
     * Request body ($data): DistributorsEnableUpdateBody (fields listed on the class)
     *
     * Response data type: DistributorsEnableUpdateData (fields listed on the class)
     *
     * @param int $productsUid Product ID
     * @param DistributorsEnableUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateEnable(int $productsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{productsUid}/enable',
            $data,
            ['productsUid' => (string) $productsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
