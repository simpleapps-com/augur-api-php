<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * sites resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-info.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-info.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-info.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-info
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * SitesP21ApiCreateData: Result of validating a caller for a site, with the site's Prophet 21 API
 * (middleware) credentials; never the SQL connection
 * Returned by: $api->agrInfo->sites->createP21Api($data)
 *   valid: bool — True when the caller is accepted for the site (validated exactly as POST
 *       /sites/validate)
 *   siteId: string — Site the caller was validated against
 *   error: string — Why the caller was refused, or why p21 is null; empty otherwise
 *   tokenType: string|null — site, user, agr-int-user or client; null when the token did not
 *       validate
 *   isAdmin: bool — True for a Joomla super user token
 *   user: SitesValidateCreateDataUser|null — The token's user; null for a site token or a refused
 *       caller
 *   p21: SitesP21ApiCreateDataP21|null — The site's P21 API credentials; null when the caller is
 *       refused or the site has no P21 API configured
 *
 * SitesValidateCreateDataUser: The token's user; null for a site token or a refused caller
 * Field `user` of SitesP21ApiCreateData
 * Field `user` of SitesValidateCreateData
 *   userId: int — User ID (a Joomla user, or an agr_int user for agr-int-user and client tokens)
 *   username: string — Username
 *   email: string — Email address; empty for a client credential
 *   name: string — Display name; empty for a client credential
 *   roles: list<string> — Roles granted to the user ("Super User" for a Joomla super user)
 *
 * SitesP21ApiCreateDataP21: The site's P21 API credentials; null when the caller is refused or the
 * site has no P21 API configured
 * Field `p21` of SitesP21ApiCreateData
 *   baseUrl: string — P21 API base URL (https://{host}:{port}); token endpoint is POST
 *       {baseUrl}/api/security/token/v2
 *   username: string — P21 API user name, sent to the token endpoint with the password
 *   password: string — P21 API password
 *   clientSecret: string|null — P21 consumer key for the token endpoint; null while sites use user
 *       credentials
 *   writable: bool — True when the site allows write-back through the P21 API; false until
 *       write-back exists
 *
 * SitesValidateCreateBody: Validate a site's token or client credential
 * Request body of: $api->agrInfo->sites->createP21Api($data)
 * Request body of: $api->agrInfo->sites->createValidate($data)
 *   siteId: string — Site the token was issued for
 *   token: string — JWT, or an agr_int client credential (agrc_...)
 *
 * SitesStaffTokenCreateData: A user token on the target site, issued to an augur_info staff member
 * as that site's mirror account
 * Returned by: $api->agrInfo->sites->createStaffToken($data)
 *   token: string — User-scope JWT for the mirror account on the target site
 *   siteId: string — Target site the token is bound to
 *   username: string — Mirror account username on the target site
 *
 * SitesStaffTokenCreateBody: Exchange an augur_info staff token for a token on a target site
 * Request body of: $api->agrInfo->sites->createStaffToken($data)
 *   siteId: string — Target site to issue the token for
 *
 * SitesValidateCreateData: Result of validating a site's token or client credential, with the
 * site's Prophet 21 connection when valid
 * Returned by: $api->agrInfo->sites->createValidate($data)
 *   valid: bool — True when the credential is valid and the site has a P21 connection
 *   siteId: string — Site the credential was validated against
 *   error: string — Why validation failed; empty when valid
 *   tokenType: string|null — site, user, agr-int-user or client; null when the token did not
 *       validate
 *   isAdmin: bool — True for a Joomla super user token
 *   user: SitesValidateCreateDataUser|null — The token's user; null for a site token or a failed
 *       validation
 *   connection: SitesValidateCreateDataConnection — The site's P21 database connection
 *
 * SitesValidateCreateDataConnection: The site's P21 database connection
 * Field `connection` of SitesValidateCreateData
 *   host: string|null — Database host
 *   port: int|null — Database port (1433 when not configured)
 *   database: string|null — Database name
 *   username: string|null — Database username
 *   password: string|null — Database password
 *
 * @phpstan-type SitesP21ApiCreateData array{valid: bool, siteId: string, error: string, tokenType: string|null, isAdmin: bool, user: SitesValidateCreateDataUser|null, p21: SitesP21ApiCreateDataP21|null}
 * @phpstan-type SitesValidateCreateDataUser array{userId: int, username: string, email: string, name: string, roles: list<string>}
 * @phpstan-type SitesP21ApiCreateDataP21 array{baseUrl: string, username: string, password: string, clientSecret: string|null, writable: bool}
 * @phpstan-type SitesValidateCreateBody array{siteId: string, token: string}
 * @phpstan-type SitesStaffTokenCreateData array{token: string, siteId: string, username: string}
 * @phpstan-type SitesStaffTokenCreateBody array{siteId: string}
 * @phpstan-type SitesValidateCreateData array{valid: bool, siteId: string, error: string, tokenType: string|null, isAdmin: bool, user: SitesValidateCreateDataUser|null, connection: SitesValidateCreateDataConnection}
 * @phpstan-type SitesValidateCreateDataConnection array{host: string|null, port: int|null, database: string|null, username: string|null, password: string|null}
 */
final class SitesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /sites/p21-api
     *
     * P21 API credentials
     * Call: $api->agrInfo->sites->createP21Api($data)
     *
     * Validate a caller for a site exactly as POST /sites/validate does, and return the site's
     * Prophet 21 API (middleware) credentials instead of the SQL connection. An accepted caller is
     * valid even when the site has no P21 API configured (p21 null). Sent with Cache-Control:
     * private, no-store
     *
     * Request body: Validate a site's token or client credential
     * Response data: Result of validating a caller for a site, with the site's Prophet 21 API
     * (middleware) credentials; never the SQL connection
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or siteId or token is missing.
     *   403: x-site-id is not augur_info: agr_info serves only the augur_info site.
     *
     * POST https://agr-info.augur-api.com/sites/p21-api
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1sites~1p21-api/post
     *
     * Request body ($data): SitesValidateCreateBody (fields listed on the class)
     *
     * Response data type: SitesP21ApiCreateData (fields listed on the class)
     *
     * @param SitesValidateCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createP21Api(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/p21-api', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /sites/staff-token
     *
     * Staff token for a target site
     * Call: $api->agrInfo->sites->createStaffToken($data)
     *
     * Exchange an augur_info Super User token for a token on a target site, as the mirror account
     * with the same username and email
     *
     * Request body: Exchange an augur_info staff token for a token on a target site
     * Response data: A user token on the target site, issued to an augur_info staff member as that
     * site's mirror account
     *
     * Errors:
     *   400: The body is not JSON or has no siteId.
     *   403: x-site-id is not augur_info; the caller is not an unblocked augur_info Super User; or
     *       the target site has no unblocked Super User with the same username and email
     *       (case-insensitive).
     *   404: The target siteId is not a known site.
     *   503: A site database or service did not respond while checking the caller, the target site
     *       or its mirror account, or while issuing the token. Retryable.
     *
     * POST https://agr-info.augur-api.com/sites/staff-token
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1sites~1staff-token/post
     *
     * Request body ($data): SitesStaffTokenCreateBody (fields listed on the class)
     *
     * Response data type: SitesStaffTokenCreateData (fields listed on the class)
     *
     * @param SitesStaffTokenCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createStaffToken(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/staff-token', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }

    /**
     * POST /sites/validate
     *
     * Validate credentials
     * Call: $api->agrInfo->sites->createValidate($data)
     *
     * Validate credentials and return P21 connection details
     *
     * Request body: Validate a site's token or client credential
     * Response data: Result of validating a site's token or client credential, with the site's
     * Prophet 21 connection when valid
     *
     * Errors:
     *   400: The body is missing or not a JSON object. Or siteId or token is missing.
     *   403: x-site-id is not augur_info: agr_info serves only the augur_info site.
     *
     * POST https://agr-info.augur-api.com/sites/validate
     * Contract: https://agr-info.augur-api.com/openapi.json#/paths/~1sites~1validate/post
     *
     * Request body ($data): SitesValidateCreateBody (fields listed on the class)
     *
     * Response data type: SitesValidateCreateData (fields listed on the class)
     *
     * @param SitesValidateCreateBody $data
     * @return BaseResponse<array<string, mixed>>
     */
    public function createValidate(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '/validate', $data);

        /** @var BaseResponse<array<string, mixed>> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
