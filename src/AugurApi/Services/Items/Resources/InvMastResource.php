<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;
use AugurApi\Services\Items\Schemas\InvMast;
use AugurApi\Services\Items\Schemas\InvMastListParams;

/**
 * Inventory master resource.
 *
 * @fullPath api.items.invMast
 * @service items
 * @domain inventory-management
 */
final class InvMastResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * List inventory items.
     *
     * @fullPath api.items.invMast.list
     * @param InvMastListParams|array<string, mixed>|null $params
     * @return BaseResponse<array<InvMast>>
     */
    public function list(InvMastListParams|array|null $params = null): BaseResponse
    {
        $queryParams = match (true) {
            $params instanceof InvMastListParams => $params->toArray(),
            is_array($params) => $params,
            default => [],
        };

        $response = $this->client->get($this->baseUrl, '/inv-mast', $queryParams);

        return BaseResponse::fromArray($response, static function ($data): array {
            if (!is_array($data)) {
                return [];
            }
            return array_map(static fn ($item) => InvMast::fromArray($item), $data);
        });
    }

    /**
     * Get an inventory item by UID.
     *
     * @fullPath api.items.invMast.get
     * @return BaseResponse<InvMast>
     */
    public function get(int $invMastUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}',
            [],
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray(
            $response,
            static fn ($data) => InvMast::fromArray($data),
        );
    }

    /**
     * Lookup inventory items.
     *
     * @fullPath api.items.invMast.lookup
     * @param array<string, mixed> $params
     * @return BaseResponse<array<InvMast>>
     */
    public function lookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/inv-mast/lookup', $params);

        return BaseResponse::fromArray($response, static function ($data): array {
            if (!is_array($data)) {
                return [];
            }
            return array_map(static fn ($item) => InvMast::fromArray($item), $data);
        });
    }

    /**
     * Get inventory item document.
     *
     * @fullPath api.items.invMast.getDoc
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $invMastUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/doc',
            [],
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Get inventory item stock.
     *
     * @fullPath api.items.invMast.getStock
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getStock(int $invMastUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/stock',
            [],
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get alternate codes for an inventory item.
     *
     * @fullPath api.items.invMast.getAlternateCode
     * @param array<string, mixed>|null $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getAlternateCode(int $invMastUid, ?array $params = null): BaseResponse
    {
        $queryParams = $params ?? [];

        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/alternate-code',
            $queryParams,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get attributes for an inventory item.
     *
     * @fullPath api.items.invMast.getAttributes
     * @param array<string, mixed>|null $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getAttributes(int $invMastUid, ?array $params = null): BaseResponse
    {
        $queryParams = $params ?? [];

        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/attributes',
            $queryParams,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Create attributes for an inventory item.
     *
     * @fullPath api.items.invMast.createAttributes
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributes(int $invMastUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/attributes',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get attribute values for an inventory item attribute.
     *
     * @fullPath api.items.invMast.getAttributeValues
     * @param array<string, mixed>|null $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getAttributeValues(
        int $invMastUid,
        int $attributeUid,
        ?array $params = null,
    ): BaseResponse {
        $queryParams = $params ?? [];

        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/attributes/{attributeUid}/values',
            $queryParams,
            [
                'invMastUid' => (string) $invMastUid,
                'attributeUid' => (string) $attributeUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Create attribute values for an inventory item attribute.
     *
     * @fullPath api.items.invMast.createAttributeValues
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributeValues(
        int $invMastUid,
        int $attributeUid,
        array $data,
    ): BaseResponse {
        $response = $this->client->post(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/attributes/{attributeUid}/values',
            $data,
            [
                'invMastUid' => (string) $invMastUid,
                'attributeUid' => (string) $attributeUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Update an attribute value for an inventory item attribute.
     *
     * @fullPath api.items.invMast.updateAttributeValue
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateAttributeValue(
        int $invMastUid,
        int $attributeUid,
        int $attributeValueUid,
        array $data,
    ): BaseResponse {
        $response = $this->client->put(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}',
            $data,
            [
                'invMastUid' => (string) $invMastUid,
                'attributeUid' => (string) $attributeUid,
                'attributeValueUid' => (string) $attributeValueUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Delete an attribute value for an inventory item attribute.
     *
     * @fullPath api.items.invMast.deleteAttributeValue
     * @return BaseResponse<bool>
     */
    public function deleteAttributeValue(
        int $invMastUid,
        int $attributeUid,
        int $attributeValueUid,
    ): BaseResponse {
        $response = $this->client->delete(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}',
            [
                'invMastUid' => (string) $invMastUid,
                'attributeUid' => (string) $attributeUid,
                'attributeValueUid' => (string) $attributeValueUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * List FAQs for an inventory item.
     *
     * @fullPath api.items.invMast.listFaq
     * @param array<string, mixed>|null $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function listFaq(int $invMastUid, ?array $params = null): BaseResponse
    {
        $queryParams = $params ?? [];

        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/faq',
            $queryParams,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get a specific FAQ for an inventory item.
     *
     * @fullPath api.items.invMast.getFaq
     * @return BaseResponse<array<string, mixed>>
     */
    public function getFaq(int $invMastUid, int $invMastFaqUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/faq/{invMastFaqUid}',
            [],
            [
                'invMastUid' => (string) $invMastUid,
                'invMastFaqUid' => (string) $invMastFaqUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Create a FAQ for an inventory item.
     *
     * @fullPath api.items.invMast.createFaq
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createFaq(int $invMastUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/faq',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Update a FAQ for an inventory item.
     *
     * @fullPath api.items.invMast.updateFaq
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateFaq(int $invMastUid, int $invMastFaqUid, array $data): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/faq/{invMastFaqUid}',
            $data,
            [
                'invMastUid' => (string) $invMastUid,
                'invMastFaqUid' => (string) $invMastFaqUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Delete a FAQ for an inventory item.
     *
     * @fullPath api.items.invMast.deleteFaq
     * @return BaseResponse<bool>
     */
    public function deleteFaq(int $invMastUid, int $invMastFaqUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/faq/{invMastFaqUid}',
            [
                'invMastUid' => (string) $invMastUid,
                'invMastFaqUid' => (string) $invMastFaqUid,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => (bool) $data);
    }

    /**
     * Get accessories for an inventory item.
     *
     * @fullPath api.items.invMast.getAccessories
     * @param array<string, mixed>|null $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getAccessories(int $invMastUid, ?array $params = null): BaseResponse
    {
        $queryParams = $params ?? [];

        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/inv-accessory',
            $queryParams,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get substitutes for an inventory item.
     *
     * @fullPath api.items.invMast.getSubstitutes
     * @param array<string, mixed>|null $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getSubstitutes(int $invMastUid, ?array $params = null): BaseResponse
    {
        $queryParams = $params ?? [];

        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/inv-sub',
            $queryParams,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get bins for an inventory item at a location.
     *
     * @fullPath api.items.invMast.getLocationBins
     * @param array<string, mixed>|null $params
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getLocationBins(
        int $invMastUid,
        int $locationId,
        ?array $params = null,
    ): BaseResponse {
        $queryParams = $params ?? [];

        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/locations/{locationId}/bins',
            $queryParams,
            [
                'invMastUid' => (string) $invMastUid,
                'locationId' => (string) $locationId,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get a specific bin for an inventory item at a location.
     *
     * @fullPath api.items.invMast.getLocationBin
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLocationBin(int $invMastUid, int $locationId, string $bin): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/locations/{locationId}/bins/{bin}',
            [],
            [
                'invMastUid' => (string) $invMastUid,
                'locationId' => (string) $locationId,
                'bin' => $bin,
            ],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }

    /**
     * Get similar items for an inventory item.
     *
     * @fullPath api.items.invMast.getSimilar
     * @return BaseResponse<array<array<string, mixed>>>
     */
    public function getSimilar(int $invMastUid): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/inv-mast/{invMastUid}/similar',
            [],
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data ?? []);
    }
}
