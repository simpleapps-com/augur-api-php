<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * shippingMethods resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://logistics.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://logistics.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://logistics.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py logistics
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ShippingMethodsListItem:
 * Returned by: $api->logistics->shippingMethods->list()
 * Returned by: $api->logistics->shippingMethods->get($shippingMethodsUid)
 * Returned by: $api->logistics->shippingMethods->update($shippingMethodsUid, $data)
 * Returned by: $api->logistics->shippingMethods->delete($shippingMethodsUid)
 *   shippingMethodsUid: int — Shipping method ID
 *   shippingMethodsId: float — Prophet 21 carrier address id (address.id with carrier_flag Y);
 *       written only by shipping_methods:sync_few
 *   nickname: string|null — Operator web display name for the carrier (max 255 chars)
 *   shippingType: string|null — Operator shipping type label (max 255 chars)
 *   handlingFee: float|null — Flat handling fee added to the rate
 *   handlingPercent: float|null — Handling charge as a percent of the rate
 *   price1: float|null — Tier 1 price
 *   price2: float|null — Tier 2 price
 *   price3: float|null — Tier 3 price
 *   price4: float|null — Tier 4 price
 *   price5: float|null — Tier 5 price
 *   cost1: float|null — Tier 1 cost
 *   cost2: float|null — Tier 2 cost
 *   cost3: float|null — Tier 3 cost
 *   cost4: float|null — Tier 4 cost
 *   cost5: float|null — Tier 5 cost
 *   weight1: float|null — Tier 1 weight break
 *   weight2: float|null — Tier 2 weight break
 *   weight3: float|null — Tier 3 weight break
 *   weight4: float|null — Tier 4 weight break
 *   weight5: float|null — Tier 5 weight break
 *   dateCreated: string — Date the record was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — Date the record was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code
 *   statusCd: int — Status code (704 = Active, 705 = Inactive, 700 = Deleted)
 *   processCd: int — Process code
 *   defaultCd: int — Default flag (704 = the site default shipping method, 705 = not default); at
 *       most one row per site is 704
 *   sequenceNo: int — Display order
 *   rateSource: string|null — How the storefront prices the carrier at checkout (ups, fedex, ltl,
 *       free); null means no rate (max 16 chars)
 *   serviceCode: string|null — Carrier service code (UPS 03, FedEx FEDEX_GROUND); null for ltl and
 *       free (max 64 chars)
 *   carrierName: string|null — Prophet 21 carrier name (address.name); written only by
 *       shipping_methods:sync_few (max 50 chars)
 *
 * ShippingMethodsUpdateBody: Partial update of a shipping method's operator-editable fields; an
 * absent field keeps its stored value
 * Request body of: $api->logistics->shippingMethods->update($shippingMethodsUid, $data)
 *   nickname?: string|null — Web display name for the carrier; "" or null clears it
 *   shippingType?: string|null — Shipping type label; "" or null clears it
 *   handlingFee?: float|null — Flat handling fee added to the rate; "" or null clears it
 *   handlingPercent?: float|null — Handling charge as a percent of the rate; "" or null clears it
 *   price1?: float|null — Tier 1 price; "" or null clears it
 *   price2?: float|null — Tier 2 price; "" or null clears it
 *   price3?: float|null — Tier 3 price; "" or null clears it
 *   price4?: float|null — Tier 4 price; "" or null clears it
 *   price5?: float|null — Tier 5 price; "" or null clears it
 *   cost1?: float|null — Tier 1 cost; "" or null clears it
 *   cost2?: float|null — Tier 2 cost; "" or null clears it
 *   cost3?: float|null — Tier 3 cost; "" or null clears it
 *   cost4?: float|null — Tier 4 cost; "" or null clears it
 *   cost5?: float|null — Tier 5 cost; "" or null clears it
 *   weight1?: float|null — Tier 1 weight break; "" or null clears it
 *   weight2?: float|null — Tier 2 weight break; "" or null clears it
 *   weight3?: float|null — Tier 3 weight break; "" or null clears it
 *   weight4?: float|null — Tier 4 weight break; "" or null clears it
 *   weight5?: float|null — Tier 5 weight break; "" or null clears it
 *   statusCd?: int|null — Status code [(704) active | (705) inactive | (700) deleted]; anything
 *       else is a 400
 *   processCd?: int|null — Process code
 *   defaultCd?: int|null — Default flag [(704) default | (705) not default]; 704 clears it on every
 *       other shipping method; anything other than 700, 704 or 705 is a 400
 *   sequenceNo?: int|null — Display order
 *   rateSource?: string|null — How the storefront prices the carrier at checkout (ups, fedex, ltl,
 *       free); "" or null clears it
 *   serviceCode?: string|null — Carrier service code (UPS 03, FedEx FEDEX_GROUND), sent as a string
 *       to keep leading zeros; "" or null clears it
 *
 * @phpstan-type ShippingMethodsListItem array{shippingMethodsUid: int, shippingMethodsId: float, nickname: string|null, shippingType: string|null, handlingFee: float|null, handlingPercent: float|null, price1: float|null, price2: float|null, price3: float|null, price4: float|null, price5: float|null, cost1: float|null, cost2: float|null, cost3: float|null, cost4: float|null, cost5: float|null, weight1: float|null, weight2: float|null, weight3: float|null, weight4: float|null, weight5: float|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, defaultCd: int, sequenceNo: int, rateSource: string|null, serviceCode: string|null, carrierName: string|null}
 * @phpstan-type ShippingMethodsUpdateBody array{nickname?: string|null, shippingType?: string|null, handlingFee?: float|null, handlingPercent?: float|null, price1?: float|null, price2?: float|null, price3?: float|null, price4?: float|null, price5?: float|null, cost1?: float|null, cost2?: float|null, cost3?: float|null, cost4?: float|null, cost5?: float|null, weight1?: float|null, weight2?: float|null, weight3?: float|null, weight4?: float|null, weight5?: float|null, statusCd?: int|null, processCd?: int|null, defaultCd?: int|null, sequenceNo?: int|null, rateSource?: string|null, serviceCode?: string|null}
 */
final class ShippingMethodsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /shipping-methods
     *
     * List shipping methods
     * Call: $api->logistics->shippingMethods->list()
     *
     * List shipping methods for a site
     *
     * Errors:
     *   400: Invalid orderBy: MUST be one field|ASC or field|DESC, the field a shipping_methods
     *       column.
     *
     * GET https://logistics.augur-api.com/shipping-methods
     * Contract: https://logistics.augur-api.com/openapi.json#/paths/~1shipping-methods/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset (Default: 0)
     *   orderBy?: string — Order by field and direction (Default: shipping_methods_uid|ASC)
     *   shippingMethodsId?: float — Filter by carrier address id
     *   shippingType?: string — Filter by shipping type
     *   statusCd?: int — Status Code (status_cd) [(704)|(705)|(700)]
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ShippingMethodsListItem (fields listed on the class)
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
     * DELETE /shipping-methods/{shippingMethodsUid}
     *
     * Soft delete a shipping method
     * Call: $api->logistics->shippingMethods->delete($shippingMethodsUid)
     *
     * Soft delete a shipping method (status_cd 700)
     *
     * Errors:
     *   404: No record with this ID. Or Shipping method not found.
     *
     * DELETE https://logistics.augur-api.com/shipping-methods/{shippingMethodsUid}
     * Contract:
     * https://logistics.augur-api.com/openapi.json#/paths/~1shipping-methods~1{shippingMethodsUid}/delete
     *
     * Response data type: ShippingMethodsListItem (fields listed on the class)
     *
     * @param int $shippingMethodsUid shipping_methods.shipping_methods_uid
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $shippingMethodsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{shippingMethodsUid}',
            ['shippingMethodsUid' => (string) $shippingMethodsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /shipping-methods/{shippingMethodsUid}
     *
     * Get one shipping method
     * Call: $api->logistics->shippingMethods->get($shippingMethodsUid)
     *
     * Get one shipping method; pass 0 as the uid with shippingMethodsId to look up by carrier
     * address id
     *
     * Errors:
     *   404: Shipping method not found.
     *
     * GET https://logistics.augur-api.com/shipping-methods/{shippingMethodsUid}
     * Contract:
     * https://logistics.augur-api.com/openapi.json#/paths/~1shipping-methods~1{shippingMethodsUid}/get
     *
     * Query params ($params; `?` = optional):
     *   shippingMethodsId?: float — Carrier address id, used when the path uid is 0
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ShippingMethodsListItem (fields listed on the class)
     *
     * @param int $shippingMethodsUid shipping_methods.shipping_methods_uid
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $shippingMethodsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{shippingMethodsUid}',
            $params,
            ['shippingMethodsUid' => (string) $shippingMethodsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /shipping-methods/{shippingMethodsUid}
     *
     * Update a shipping method
     * Call: $api->logistics->shippingMethods->update($shippingMethodsUid, $data)
     *
     * Update the operator-editable fields of one shipping method
     *
     * Request body: Partial update of a shipping method's operator-editable fields; an absent field
     * keeps its stored value
     *
     * Errors:
     *   400: statusCd must be 700, 704 or 705. Or defaultCd must be 700, 704 or 705. Or Request
     *       body must be a JSON object.
     *   404: No record with this ID. Or Shipping method not found.
     *
     * PUT https://logistics.augur-api.com/shipping-methods/{shippingMethodsUid}
     * Contract:
     * https://logistics.augur-api.com/openapi.json#/paths/~1shipping-methods~1{shippingMethodsUid}/put
     *
     * Request body ($data): ShippingMethodsUpdateBody (fields listed on the class)
     *
     * Response data type: ShippingMethodsListItem (fields listed on the class)
     *
     * @param int $shippingMethodsUid shipping_methods.shipping_methods_uid
     * @param ShippingMethodsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $shippingMethodsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{shippingMethodsUid}',
            $data,
            ['shippingMethodsUid' => (string) $shippingMethodsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
