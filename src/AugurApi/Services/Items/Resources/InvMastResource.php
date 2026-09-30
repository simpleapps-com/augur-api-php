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
     * POST /inv-mast/attributes/bulk
     *
     * Response data type: object
     *   items: list<array{itemId: string, invMastUid: int, attributes: list<array{attributeName: string, attributeValue: string|null}>}>
     *   notFound: list<string>
     *
     * @param array{itemIds: list<string>} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributesBulk(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/attributes/bulk', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/lookup
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getLookup(array $params = []): BaseResponse
    {
        $response = $this->client->get($this->baseUrl, '/lookup', $params);

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function get(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/alternate-code
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAlternateCode(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/alternate-code',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/attributes
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAttributes(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/attributes',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /inv-mast/{invMastUid}/attributes
     *
     * Response data type: object
     *   itemAttributeValueUid: int
     *   invMastUid: int
     *   attributeUid: int
     *   attributeValue: string|null
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   attributeValueUid: int
     *   onlineCd: int
     *
     * @param array{attributeUid?: int, attributeName?: string, attributeValue: string} $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributes(int $invMastUid, array $data): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/attributes',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/attributes/{attributeUid}/values
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listAttributesValues(int $invMastUid, int $attributeUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values',
            $params,
            ['invMastUid' => (string) $invMastUid, 'attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /inv-mast/{invMastUid}/attributes/{attributeUid}/values
     *
     * Response data type: object
     *   itemAttributeValueUid: int
     *   invMastUid: int
     *   attributeUid: int
     *   attributeValue: string|null
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   attributeValueUid: int
     *   onlineCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createAttributesValues(int $invMastUid, int $attributeUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values',
            $data,
            ['invMastUid' => (string) $invMastUid, 'attributeUid' => (string) $attributeUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}
     *
     * @return BaseResponse<mixed>
     */
    public function deleteAttributesValues(int $invMastUid, int $attributeUid, int $attributeValueUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}',
            ['invMastUid' => (string) $invMastUid, 'attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}
     *
     * Response data type: object
     *   itemAttributeValueUid: int
     *   invMastUid: int
     *   attributeUid: int
     *   attributeValue: string|null
     *   dateCreated: string
     *   createdBy: string
     *   dateLastModified: string
     *   lastMaintainedBy: string
     *   updateCd: int
     *   processCd: int
     *   statusCd: int
     *   attributeValueUid: int
     *   onlineCd: int
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateAttributesValues(int $invMastUid, int $attributeUid, int $attributeValueUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}/attributes/{attributeUid}/values/{attributeValueUid}',
            $data,
            ['invMastUid' => (string) $invMastUid, 'attributeUid' => (string) $attributeUid, 'attributeValueUid' => (string) $attributeValueUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listDoc(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/doc',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * Alias for listDoc — GET /inv-mast/{invMastUid}/doc
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getDoc(int $invMastUid, array $params = []): BaseResponse
    {
        return $this->listDoc($invMastUid, $params);
    }

    /**
     * GET /inv-mast/{invMastUid}/faq
     *
     * Response data type: array
     *   invMastFaqUid: int
     *   invMastUid: int
     *   question: string
     *   answer: string
     *   generatedAnswer: string
     *   sourceCount: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   relatedQuestionsUid: int
     *   generateCd: int
     *   extraPrompt: string
     *   accurateFlag: string
     *   qualityScore: float
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function listFaq(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/faq',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /inv-mast/{invMastUid}/faq
     *
     * Response data type: array
     *   invMastFaqUid: int
     *   invMastUid: int
     *   question: string
     *   answer: string
     *   generatedAnswer: string
     *   sourceCount: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   relatedQuestionsUid: int
     *   generateCd: int
     *   extraPrompt: string
     *   accurateFlag: string
     *   qualityScore: float
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<list<array<string, mixed>>>
     */
    public function createFaq(int $invMastUid, array $data = []): BaseResponse
    {
        $response = $this->client->post(
            $this->baseUrl,
            '/{invMastUid}/faq',
            $data,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<list<array<string, mixed>>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /inv-mast/{invMastUid}/faq/{invMastFaqUid}
     *
     * Response data type: object
     *   invMastFaqUid: int
     *   invMastUid: int
     *   question: string
     *   answer: string
     *   generatedAnswer: string
     *   sourceCount: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   relatedQuestionsUid: int
     *   generateCd: int
     *   extraPrompt: string
     *   accurateFlag: string
     *   qualityScore: float
     *
     * @return BaseResponse<array<string, mixed>>
     */
    public function deleteFaq(int $invMastUid, int $invMastFaqUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{invMastUid}/faq/{invMastFaqUid}',
            ['invMastUid' => (string) $invMastUid, 'invMastFaqUid' => (string) $invMastFaqUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/faq/{invMastFaqUid}
     *
     * Response data type: object
     *   invMastFaqUid: int
     *   invMastUid: int
     *   question: string
     *   answer: string
     *   generatedAnswer: string
     *   sourceCount: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   relatedQuestionsUid: int
     *   generateCd: int
     *   extraPrompt: string
     *   accurateFlag: string
     *   qualityScore: float
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function getFaq(int $invMastUid, int $invMastFaqUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/faq/{invMastFaqUid}',
            $params,
            ['invMastUid' => (string) $invMastUid, 'invMastFaqUid' => (string) $invMastFaqUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /inv-mast/{invMastUid}/faq/{invMastFaqUid}
     *
     * Response data type: object
     *   invMastFaqUid: int
     *   invMastUid: int
     *   question: string
     *   answer: string
     *   generatedAnswer: string
     *   sourceCount: int
     *   dateCreated: string
     *   dateLastModified: string
     *   updateCd: int
     *   statusCd: int
     *   processCd: int
     *   relatedQuestionsUid: int
     *   generateCd: int
     *   extraPrompt: string
     *   accurateFlag: string
     *   qualityScore: float
     *
     * @param array<string, mixed> $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function updateFaq(int $invMastUid, int $invMastFaqUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{invMastUid}/faq/{invMastFaqUid}',
            $data,
            ['invMastUid' => (string) $invMastUid, 'invMastFaqUid' => (string) $invMastFaqUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/inv-accessory
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listInvAccessory(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/inv-accessory',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/inv-sub
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listInvSub(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/inv-sub',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/locations/{locationId}/bins
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listLocationsBins(int $invMastUid, int $locationId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/locations/{locationId}/bins',
            $params,
            ['invMastUid' => (string) $invMastUid, 'locationId' => (string) $locationId],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/locations/{locationId}/bins/{bin}
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getLocationsBins(int $invMastUid, int $locationId, string $bin, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/locations/{locationId}/bins/{bin}',
            $params,
            ['invMastUid' => (string) $invMastUid, 'locationId' => (string) $locationId, 'bin' => (string) $bin],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/similar
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function listSimilar(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/similar',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /inv-mast/{invMastUid}/stock
     *
     * @param array<string, mixed> $params
     * @return BaseResponse<mixed>
     */
    public function getStock(int $invMastUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invMastUid}/stock',
            $params,
            ['invMastUid' => (string) $invMastUid],
        );

        /** @var BaseResponse<mixed> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
