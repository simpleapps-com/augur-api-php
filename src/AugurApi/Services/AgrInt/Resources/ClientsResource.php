<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInt\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * clients resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-int.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-int.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-int.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-int
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ClientsListItem:
 * Returned by: $api->agrInt->clients->list()
 * Returned by: $api->agrInt->clients->update($clientsUid, $data)
 * Returned by: $api->agrInt->clients->delete($clientsUid)
 *   clientsUid: int — Client credential unique ID
 *   clientId: string — Public client identifier (agrc_ prefix), encrypted under the site secret key
 *       (max 255 chars)
 *   usersUid: int — agr_int user the credential acts as; it gets exactly this user's resources
 *   keyVersion: int — Site secret key version the client_id was issued under; MUST match on verify
 *   clientName: string — Admin-facing label, e.g. the connector name (max 255 chars)
 *   description: string|null — Admin-facing notes (max 1000 chars)
 *   issuedById: int|null — ID of the admin whose bearer issued the credential; null when issued
 *       from the CLI
 *   issuedByUsername: string|null — Username of the admin who issued the credential; null when
 *       issued from the CLI (max 255 chars)
 *   retiredById: int|null — ID of the admin who retired the credential; null while active or when
 *       retired from the CLI
 *   retiredByUsername: string|null — Username of the admin who retired the credential; null while
 *       active or when retired from the CLI (max 255 chars)
 *   dateLastUsed: string|null — When the credential last authenticated; null if never used
 *       (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateCreated: string — When the row was created (mysql-datetime, e.g. 2025-07-30 15:50:49)
 *   dateLastModified: string — When the row was last modified (mysql-datetime, e.g. 2025-07-30
 *       15:50:49)
 *   updateCd: int — Update code: 1185 = Import Complete, 704 = needs processing
 *   statusCd: int — Status code: 704 = Active, 705 = Inactive, 700 = Deleted
 *   processCd: int — Process code: 704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete
 *
 * ClientsCreateData: Result of issuing an agr_int client credential (GH#114).
 * Returned by: $api->agrInt->clients->create($data)
 *   clientsUid: int — Client credential unique ID; 0 when issuing failed
 *   clientId: string — Public client identifier (agrc_ prefix)
 *   usersUid: int — agr_int user the credential acts as
 *   keyVersion: int — Site secret key version the client_id was issued under
 *   clientName: string — Admin-facing label, e.g. the connector name
 *   description: string|null — Admin-facing notes
 *   issuedById: int|null — ID of the admin who issued the credential; null when issued from the CLI
 *   issuedByUsername: string|null — Username of the admin who issued the credential
 *   statusCd: int — Status code: 704 = Active
 *   credential: string — Full bearer string agrc_<clientId>.<secret><crc32>
 *
 * ClientsCreateBody: Issue a client credential for an existing ACTIVE agr_int user; issuedById and
 * issuedByUsername come from the admin bearer, never the body
 * Request body of: $api->agrInt->clients->create($data)
 *   usersUid: int|null — Owning agr_int user; MUST exist and be ACTIVE, and the credential gets
 *       exactly this user's resources
 *   clientName: string|null — Admin-facing label, e.g. the connector name; MUST NOT be blank
 *   description?: string|null — Admin-facing notes
 *
 * ClientsValidateCreateData: Result of validating a presented agr_int client credential (GH#114).
 * Returned by: $api->agrInt->clients->createValidate($data)
 *   valid: bool — True only when the credential decrypts, matches, and its client and user are
 *       ACTIVE
 *   siteId: string — Site decrypted from the client_id; consumers MUST scope the connection to it
 *   tokenUse: string — Always "client" for a valid credential
 *   clientUid: int — Client credential unique ID
 *   clientId: string — Public client identifier (agrc_ prefix)
 *   usersUid: int — agr_int user the credential acts as
 *   username: string — Username of that user
 *   roles: list<string> — Active role ids the owning user holds
 *   bundles: list<string> — Active bundle ids granted through those roles
 *   resources: list<string> — P21 table set (resources.resource_path) the credential may query
 *
 * ClientsValidateCreateBody: Introspect a client credential: send either credential (bearer form)
 * or clientId plus secret (Basic form)
 * Request body of: $api->agrInt->clients->createValidate($data)
 *   credential?: string — Bearer form agrc_<clientId>.<secret><crc32>; when non-blank it wins over
 *       clientId and secret
 *   clientId?: string — The client_id, with or without the agrc_ prefix
 *   secret?: string — The cleartext secret; MAY carry the trailing 8-hex checksum
 *
 * ClientsGetData: A single agr_int client credential with its recoverable secret (GH#115).
 * Returned by: $api->agrInt->clients->get($clientsUid)
 *   clientsUid: int — Client credential unique ID
 *   clientId: string — Public client identifier (agrc_ prefix)
 *   clientSecret: string — Re-derived 43-char client secret; '' when the credential is not
 *       revealable
 *   usersUid: int — agr_int user the credential acts as
 *   keyVersion: int — Site secret key version the client_id was issued under
 *   clientName: string — Admin-facing label, e.g. the connector name
 *   description: string|null — Admin-facing notes
 *   issuedById: int|null — ID of the admin who issued the credential; null when issued from the CLI
 *   issuedByUsername: string|null — Username of the admin who issued the credential
 *   retiredById: int|null — ID of the admin who retired the credential; null while active
 *   retiredByUsername: string|null — Username of the admin who retired the credential
 *   dateLastUsed: string|null — When the credential last authenticated (Y-m-d H:i:s); null if never
 *       used
 *   dateCreated: string — When the credential was issued (Y-m-d H:i:s)
 *   dateLastModified: string — When the credential was last modified (Y-m-d H:i:s)
 *   updateCd: int — Update code (1185 = Import Complete)
 *   statusCd: int — Status code: 704 = Active, 705 = Inactive, 700 = Retired
 *   processCd: int — Process code
 *   credential: string — Full bearer string agrc_<clientId>.<secret><crc32>; '' when not revealable
 *
 * ClientsUpdateBody: Partial update of a client credential; usersUid, clientId, clientSecret and
 * keyVersion are immutable, and a retired (700) client refuses every update
 * Request body of: $api->agrInt->clients->update($clientsUid, $data)
 *   clientName?: string|null — New admin-facing label; blank is ignored
 *   description?: string|null — New admin-facing notes; blank clears it
 *   statusCd?: int|null — Status code: 704 = Active, 705 = Inactive, 700 = Retire (terminal); any
 *       other value refuses the update
 *   processCd?: int|null — Process code (704 = Active, 705 = Inactive, 700 = Deleted, 1185 = Import
 *       Complete); any other value refuses the update
 *   updateCd?: int|null — Update code (1185 = Import Complete, 704 = Active, 705 = Inactive, 700 =
 *       Deleted); any other value refuses the update
 *
 * @phpstan-type ClientsListItem array{clientsUid: int, clientId: string, usersUid: int, keyVersion: int, clientName: string, description: string|null, issuedById: int|null, issuedByUsername: string|null, retiredById: int|null, retiredByUsername: string|null, dateLastUsed: string|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int}
 * @phpstan-type ClientsCreateData array{clientsUid: int, clientId: string, usersUid: int, keyVersion: int, clientName: string, description: string|null, issuedById: int|null, issuedByUsername: string|null, statusCd: int, credential: string}
 * @phpstan-type ClientsCreateBody array{usersUid: int|null, clientName: string|null, description?: string|null}
 * @phpstan-type ClientsValidateCreateData array{valid: bool, siteId: string, tokenUse: string, clientUid: int, clientId: string, usersUid: int, username: string, roles: list<string>, bundles: list<string>, resources: list<string>}
 * @phpstan-type ClientsValidateCreateBody array{credential?: string, clientId?: string, secret?: string}
 * @phpstan-type ClientsGetData array{clientsUid: int, clientId: string, clientSecret: string, usersUid: int, keyVersion: int, clientName: string, description: string|null, issuedById: int|null, issuedByUsername: string|null, retiredById: int|null, retiredByUsername: string|null, dateLastUsed: string|null, dateCreated: string, dateLastModified: string, updateCd: int, statusCd: int, processCd: int, credential: string}
 * @phpstan-type ClientsUpdateBody array{clientName?: string|null, description?: string|null, statusCd?: int|null, processCd?: int|null, updateCd?: int|null}
 */
final class ClientsResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /clients
     *
     * List clients
     * Call: $api->agrInt->clients->list()
     *
     * List client credentials with pagination and filtering. client_secret is never returned.
     *
     * Errors:
     *   400: Bad request: the body is missing or a parameter is invalid; message says which.
     *   403: The bearer token does not belong to an admin user.
     *
     * GET https://agr-int.augur-api.com/clients
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1clients/get
     *
     * Query params ($params; `?` = optional):
     *   limit?: int — Limit number of results (Default: 10)
     *   offset?: int — Starting offset for results (Default: 0)
     *   orderBy?: string — Order By (Default: clients_uid|ASC)
     *   statusCd?: int|int[] — Status code or list of codes (700=DELETE, 704=ACTIVE, 705=INACTIVE),
     *       sent comma-joined (704,705); -1 for every status. Default: 704
     *   usersUid?: int — Filter by owning users_uid
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: list of ClientsListItem (fields listed on the class)
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
     * POST /clients
     *
     * Issue a client
     * Call: $api->agrInt->clients->create($data)
     *
     * Issue a client credential for an existing ACTIVE agr_int user. The response carries the
     * credential; GET /api/clients/{clientsUid} re-reads it while the client is active.
     *
     * Request body: Issue a client credential for an existing ACTIVE agr_int user; issuedById and
     * issuedByUsername come from the admin bearer, never the body
     * Response data: Result of issuing an agr_int client credential (GH#114).
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or The client could not be issued. A
     *       non-empty "clientName" and an ACTIVE "usersUid" are required.
     *   403: The bearer token does not belong to an admin user.
     *
     * POST https://agr-int.augur-api.com/clients
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1clients/post
     *
     * Request body ($data): ClientsCreateBody (fields listed on the class)
     *
     * Response data type: ClientsCreateData (fields listed on the class)
     *
     * @param ClientsCreateBody $data
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
     * POST /clients/validate
     *
     * Validate a client credential
     * Call: $api->agrInt->clients->createValidate($data)
     *
     * Introspect a client credential. Reads {credential} or {clientId, secret} from the body. Only
     * the augur_info system bearer is accepted. Always 200; returns {valid, siteId, tokenUse,
     * clientUid, clientId, usersUid, username, roles, bundles, resources}.
     *
     * Request body: Introspect a client credential: send either credential (bearer form) or
     * clientId plus secret (Basic form)
     * Response data: Result of validating a presented agr_int client credential (GH#114).
     *
     * Errors:
     *   403: The bearer token is not a system token.
     *
     * POST https://agr-int.augur-api.com/clients/validate
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1clients~1validate/post
     *
     * Request body ($data): ClientsValidateCreateBody (fields listed on the class)
     *
     * Response data type: ClientsValidateCreateData (fields listed on the class)
     *
     * @param ClientsValidateCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createValidate(array $data = []): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/validate', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * DELETE /clients/{clientsUid}
     *
     * Retire a client
     * Call: $api->agrInt->clients->delete($clientsUid)
     *
     * Retire a client credential by UID (status_cd 700, terminal). Stamps retired_by from the admin
     * bearer.
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: No record with this ID. Or Client not found.
     *
     * DELETE https://agr-int.augur-api.com/clients/{clientsUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1clients~1{clientsUid}/delete
     *
     * Response data type: ClientsListItem (fields listed on the class)
     *
     * @param int $clientsUid Unique ID of the API client
     * @return BaseResponse<array<string, mixed>>
     */
    public function delete(int $clientsUid): BaseResponse
    {
        $response = $this->client->delete(
            $this->baseUrl,
            '/{clientsUid}',
            ['clientsUid' => (string) $clientsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * GET /clients/{clientsUid}
     *
     * Get a client
     * Call: $api->agrInt->clients->get($clientsUid)
     *
     * Get a client credential by UID, including its secret and bearer credential while the client
     * and its user are active. The client_secret HMAC is never returned.
     *
     * Response data: A single agr_int client credential with its recoverable secret (GH#115).
     *
     * Errors:
     *   403: The bearer token does not belong to an admin user.
     *   404: Client not found.
     *
     * GET https://agr-int.augur-api.com/clients/{clientsUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1clients~1{clientsUid}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ClientsGetData (fields listed on the class)
     *
     * @param int $clientsUid Unique ID of the API client
     * @param array<string, mixed> $params
     * @return BaseResponse<array<string, mixed>>
     */
    public function get(int $clientsUid, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{clientsUid}',
            $params,
            ['clientsUid' => (string) $clientsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * PUT /clients/{clientsUid}
     *
     * Update a client
     * Call: $api->agrInt->clients->update($clientsUid, $data)
     *
     * Update a client by UID. Only clientName, description, statusCd, processCd, updateCd are
     * writable. A retired (700) client refuses every update.
     *
     * Request body: Partial update of a client credential; usersUid, clientId, clientSecret and
     * keyVersion are immutable, and a retired (700) client refuses every update
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or The client could not be updated. It does
     *       not exist, is retired (700, terminal), or a _cd value is invalid.
     *   403: The bearer token does not belong to an admin user.
     *   404: No record with this ID.
     *
     * PUT https://agr-int.augur-api.com/clients/{clientsUid}
     * Contract: https://agr-int.augur-api.com/openapi.json#/paths/~1clients~1{clientsUid}/put
     *
     * Request body ($data): ClientsUpdateBody (fields listed on the class)
     *
     * Response data type: ClientsListItem (fields listed on the class)
     *
     * @param int $clientsUid Unique ID of the API client
     * @param ClientsUpdateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function update(int $clientsUid, array $data = []): BaseResponse
    {
        $response = $this->client->put(
            $this->baseUrl,
            '/{clientsUid}',
            $data,
            ['clientsUid' => (string) $clientsUid],
        );

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
