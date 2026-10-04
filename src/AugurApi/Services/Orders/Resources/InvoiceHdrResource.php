<?php

declare(strict_types=1);

namespace AugurApi\Services\Orders\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * invoiceHdr resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://orders.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://orders.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://orders.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py orders
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * InvoiceHdrReprintListDataOption1: An invoice re-rendered by Prophet 21's document service
 * Returned by: $api->orders->invoiceHdr->listReprint($invoiceNo)
 *   documentId: string|null — Prophet 21 form the document was rendered from
 *   fileName: string|null — File name of the rendered document
 *   documentName: string|null — Document name
 *   documentContentType: string|null — MIME type of documentData (e.g. application/pdf)
 *   documentData: string|null — The rendered document, base64 encoded
 *
 * @phpstan-type InvoiceHdrReprintListDataOption1 array{documentId: string|null, fileName: string|null, documentName: string|null, documentContentType: string|null, documentData: string|null}
 */
final class InvoiceHdrResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /invoice-hdr/{invoiceNo}/reprint
     *
     * Reprint the invoice
     * Call: $api->orders->invoiceHdr->listReprint($invoiceNo)
     *
     * Render the invoice as a PDF through Prophet 21's document service
     *
     * Errors:
     *   404: No invoice with this number.
     *
     * GET https://orders.augur-api.com/invoice-hdr/{invoiceNo}/reprint
     * Contract:
     * https://orders.augur-api.com/openapi.json#/paths/~1invoice-hdr~1{invoiceNo}~1reprint/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: InvoiceHdrReprintListDataOption1|false
     *   one of:
     *     InvoiceHdrReprintListDataOption1 — An invoice re-rendered by Prophet 21's document
     *         service
     *     false — false when the operation failed
     *
     * @param int $invoiceNo Prophet 21 invoice number
     * @param array<string, mixed> $params
     * @return BaseResponse<InvoiceHdrReprintListDataOption1|false>
     */
    public function listReprint(int $invoiceNo, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{invoiceNo}/reprint',
            $params,
            ['invoiceNo' => (string) $invoiceNo],
        );

        /** @var BaseResponse<InvoiceHdrReprintListDataOption1|false> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
