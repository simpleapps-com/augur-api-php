<?php

declare(strict_types=1);

namespace AugurApi\Services\Payments\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * element resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://payments.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://payments.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://payments.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py payments
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ElementPaymentCreateData: Element tokenization result and AVS verdict; see
 * packages/payments/src/Helpers/Element-Error-Responses.md
 * Returned by: $api->payments->element->createPayment($data)
 *   processor: string — Always "element"
 *   cardData: array<string, mixed>|array{} — Element PaymentAccountCreate fields
 *       (ExpressResponseCode "0" means tokenized, PaymentAccountID is the token); [] when Element
 *       could not be reached ([] when empty)
 *   avs: array<string, mixed>|array{} — Address verification block; AvsVerdict is always present
 *       (match, partial, no_match, unavailable) ([] when empty)
 *
 * ElementPaymentCreateBody: Card and address to tokenize through Element; a missing card or address
 * is sent to Element as empty
 * Request body of: $api->payments->element->createPayment($data)
 *   card?: ElementPaymentCreateBodyCard|null — Card to tokenize
 *   address?: ElementPaymentCreateBodyAddress|null — Billing and shipping addresses; shipping picks
 *       the processor, billing feeds AVS
 *
 * ElementPaymentCreateBodyCard: Card to tokenize
 * Field `card` of ElementPaymentCreateBody
 *   ccNumber?: string|null — Card number
 *   cvv?: string|null — Card security code
 *   expMonth?: string|null — Expiration month
 *   expYear?: string|null — Expiration year
 *
 * ElementPaymentCreateBodyAddress: Billing and shipping addresses; shipping picks the processor,
 * billing feeds AVS
 * Field `address` of ElementPaymentCreateBody
 *   billing?: ElementPaymentCreateBodyAddressBilling|null — Billing address; address1 and
 *       postalCode feed the AVS check
 *   shipping?: ElementPaymentCreateBodyAddressBilling|null — Shipping address; state and postalCode
 *       pick the site's Element processor
 *
 * ElementPaymentCreateBodyAddressBilling: Billing address; address1 and postalCode feed the AVS
 * check
 * Field `billing` of ElementPaymentCreateBodyAddress
 * Field `shipping` of ElementPaymentCreateBodyAddress
 *   firstName?: string|null — First name; sent only together with lastName
 *   lastName?: string|null — Last name; sent only together with firstName
 *   address1?: string|null — Street address line 1
 *   address2?: string|null — Street address line 2
 *   city?: string|null — City
 *   state?: string|null — State or province code
 *   postalCode?: string|null — Postal or ZIP code
 *   email?: string|null — Email address
 *   phone?: string|null — Phone number
 *
 * @phpstan-type ElementPaymentCreateData array{processor: string, cardData: array<string, mixed>|array{}, avs: array<string, mixed>|array{}}
 * @phpstan-type ElementPaymentCreateBody array{card?: ElementPaymentCreateBodyCard|null, address?: ElementPaymentCreateBodyAddress|null}
 * @phpstan-type ElementPaymentCreateBodyCard array{ccNumber?: string|null, cvv?: string|null, expMonth?: string|null, expYear?: string|null}
 * @phpstan-type ElementPaymentCreateBodyAddress array{billing?: ElementPaymentCreateBodyAddressBilling|null, shipping?: ElementPaymentCreateBodyAddressBilling|null}
 * @phpstan-type ElementPaymentCreateBodyAddressBilling array{firstName?: string|null, lastName?: string|null, address1?: string|null, address2?: string|null, city?: string|null, state?: string|null, postalCode?: string|null, email?: string|null, phone?: string|null}
 */
final class ElementResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /element/payment
     *
     * Create payment account token
     * Call: $api->payments->element->createPayment($data)
     *
     * Create payment account token from card data
     *
     * Request body: Card and address to tokenize through Element; a missing card or address is sent
     * to Element as empty
     * Response data: Element tokenization result and AVS verdict; see
     * packages/payments/src/Helpers/Element-Error-Responses.md
     *
     * Errors:
     *   400: Invalid request body. Or Card and address are required. Or The card or address data
     *       could not be built from the body.
     *
     * POST https://payments.augur-api.com/element/payment
     * Contract: https://payments.augur-api.com/openapi.json#/paths/~1element~1payment/post
     *
     * Request body ($data): ElementPaymentCreateBody (fields listed on the class)
     *
     * Response data type: ElementPaymentCreateData (fields listed on the class)
     *
     * @param ElementPaymentCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createPayment(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/payment', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
