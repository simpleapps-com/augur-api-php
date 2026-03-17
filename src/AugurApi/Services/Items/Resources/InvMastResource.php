<?php

declare(strict_types=1);

namespace AugurApi\Services\Items\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invMast resource — generated from spec.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py items
 */
final class InvMastResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /inv-mast
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
     * GET /inv-mast/lookup
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/alternate-code
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAlternateCode(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/alternate-code',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/attributes
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAttributes(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/attributes',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /inv-mast/{invMastUid}/attributes
     *
     * Response data type: object
     * Known fields: itemAttributeValueUid, invMastUid, attributeUid, attributeValue, dateCreated, createdBy, dateLastModified, lastMaintainedBy, ... (13 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributes(int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/attributes',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/attributes/{attributeUid}/values
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listAttributesValues(int $attributeUid, int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values',
            $params,
            ['attributeUid' => (string) $attributeUid, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /inv-mast/{invMastUid}/attributes/{attributeUid}/values
     *
     * Response data type: object
     * Known fields: itemAttributeValueUid, invMastUid, attributeUid, attributeValue, dateCreated, createdBy, dateLastModified, lastMaintainedBy, ... (13 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributesValues(int $attributeUid, int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values',
            $data,
            ['attributeUid' => (string) $attributeUid, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteAttributesValues(int $attributeUid, int $attributeValueUid, int $invMastUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}',
            ['attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}
     *
     * Response data type: object
     * Known fields: itemAttributeValueUid, invMastUid, attributeUid, attributeValue, dateCreated, createdBy, dateLastModified, lastMaintainedBy, ... (13 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateAttributesValues(int $attributeUid, int $attributeValueUid, int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}',
            $data,
            ['attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listDoc(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/doc',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * Alias for listDoc — GET /inv-mast/{invMastUid}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getDoc(int $invMastUid, array $params = []): BaseResponse
    {
        return $this->listDoc($invMastUid, $params);
    }

    /**
     * GET /inv-mast/{invMastUid}/faq
     *
     * Response data type: array
     * Known fields: invMastFaqUid, invMastUid, question, answer, generatedAnswer, sourceCount, dateCreated, dateLastModified, ... (16 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listFaq(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/faq',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * POST /inv-mast/{invMastUid}/faq
     *
     * Response data type: array
     * Known fields: invMastFaqUid, invMastUid, question, answer, generatedAnswer, sourceCount, dateCreated, dateLastModified, ... (16 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createFaq(int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/faq',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * DELETE /inv-mast/{invMastUid}/faq/{invMastFaqUid}
     *
     * Response data type: object
     * Known fields: invMastFaqUid, invMastUid, question, answer, generatedAnswer, sourceCount, dateCreated, dateLastModified, ... (16 total)
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteFaq(int $invMastFaqUid, int $invMastUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastUid}/faq/{invMastFaqUid}',
            ['invMastFaqUid' => (string) $invMastFaqUid, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/faq/{invMastFaqUid}
     *
     * Response data type: object
     * Known fields: invMastFaqUid, invMastUid, question, answer, generatedAnswer, sourceCount, dateCreated, dateLastModified, ... (16 total)
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getFaq(int $invMastFaqUid, int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/faq/{invMastFaqUid}',
            $params,
            ['invMastFaqUid' => (string) $invMastFaqUid, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * PUT /inv-mast/{invMastUid}/faq/{invMastFaqUid}
     *
     * Response data type: object
     * Known fields: invMastFaqUid, invMastUid, question, answer, generatedAnswer, sourceCount, dateCreated, dateLastModified, ... (16 total)
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateFaq(int $invMastFaqUid, int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}/faq/{invMastFaqUid}',
            $data,
            ['invMastFaqUid' => (string) $invMastFaqUid, 'invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/inv-accessory
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listInvAccessory(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/inv-accessory',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/inv-sub
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listInvSub(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/inv-sub',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/locations/{locationId}/bins
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listLocationsBins(int $invMastUid, int $locationId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/locations/{locationId}/bins',
            $params,
            ['invMastUid' => (string) $invMastUid, 'locationId' => (string) $locationId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/locations/{locationId}/bins/{bin}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getLocationsBins(string $bin, int $invMastUid, int $locationId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/locations/{locationId}/bins/{bin}',
            $params,
            ['bin' => (string) $bin, 'invMastUid' => (string) $invMastUid, 'locationId' => (string) $locationId],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/similar
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function listSimilar(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/similar',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }

    /**
     * GET /inv-mast/{invMastUid}/stock
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getStock(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/stock',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        return BaseResponse::fromArray($response, static fn ($data) => $data);
    }
}
