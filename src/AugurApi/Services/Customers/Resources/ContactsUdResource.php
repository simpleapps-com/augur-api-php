<?php

declare(strict_types=1);

namespace AugurApi\Services\Customers\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * contactsUd resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://customers.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://customers.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://customers.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py customers
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ContactsUdGetData: A Prophet 21 contact's user-defined fields, each field name a top-level key
 * beside the fixed ones
 * Returned by: $api->customers->contactsUd->get($id)
 *   id: string — Prophet 21 contact ID
 *   contactsUdUid: int — Prophet 21 contacts_ud row
 *   dateCreated: string — When the row was created (Y-m-d H:i:s)
 *   dateLastModified: string — When the row was last modified (Y-m-d H:i:s)
 *   createdBy: string|null — Prophet 21 user who created the row
 *   lastMaintainedBy: string — Prophet 21 user who last changed the row
 *
 * @phpstan-type ContactsUdGetData array{id: string, contactsUdUid: int, dateCreated: string, dateLastModified: string, createdBy: string|null, lastMaintainedBy: string}
 */
final class ContactsUdResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /contacts-ud/{id}
     *
     * List user defined fields for a contact
     * Call: $api->customers->contactsUd->get($id)
     *
     * Response data: A Prophet 21 contact's user-defined fields, each field name a top-level key
     * beside the fixed ones
     *
     * Errors:
     *   404: No user-defined fields row for this contact.
     *
     * GET https://customers.augur-api.com/contacts-ud/{id}
     * Contract: https://customers.augur-api.com/openapi.json#/paths/~1contacts-ud~1{id}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ContactsUdGetData (fields listed on the class)
     *
     * @param int $id contacts.id
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
}
