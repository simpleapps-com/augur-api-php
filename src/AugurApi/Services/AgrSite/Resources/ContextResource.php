<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * context resource — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://agr-site.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://agr-site.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://agr-site.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py agr-site
 *
 * Shapes used in this class, as PHPStan type aliases (`?` = optional key), each with where it is
 * used. Response shapes are the documented MINIMUM: the API MAY send more fields.
 *
 * ContextGetDataOption1: A site's configuration as the admin site (augur_info) sees it: every
 * service with its full config
 * Returned by: $api->agrSite->context->get($siteId)
 *   siteId: string — Site described
 *   domain: string|null — Site domain; null when the site is not provisioned
 *   uid: int — Site row in sites_table (dev port = 3000 + uid); 0 when the site is unknown
 *   services: list<ContextGetDataOption1ServicesItem> — Services the site is configured for, each
 *       with its config
 *     each item: ContextGetDataOption1ServicesItem — One service a site is configured for, with
 *         every value from its per-site config file
 *   serviceCount: int — Number of configured services
 *   inactiveServices: list<string> — Services the site is not configured for
 *
 * ContextGetDataOption1ServicesItem: One service a site is configured for, with every value from
 * its per-site config file
 * Field `services` of ContextGetDataOption1
 *   name: string — Service name (the config file name)
 *   prefix?: string|null — Table prefix for the site in this service; absent when the config sets
 *       none
 *
 * ContextGetDataOption2: A site's configuration as the site itself sees it: service names only
 * Returned by: $api->agrSite->context->get($siteId)
 *   siteId: string — Site described
 *   domain: string|null — Site domain; null when the site is not provisioned
 *   uid: int — Site row in sites_table (dev port = 3000 + uid); 0 when the site is unknown
 *   services: list<string> — Services the site is configured for
 *   serviceCount: int — Number of configured services
 *   inactiveServices: list<string> — Services the site is not configured for
 *
 * @phpstan-type ContextGetDataOption1 array{siteId: string, domain: string|null, uid: int, services: list<ContextGetDataOption1ServicesItem>, serviceCount: int, inactiveServices: list<string>}
 * @phpstan-type ContextGetDataOption1ServicesItem array{name: string, prefix?: string|null}
 * @phpstan-type ContextGetDataOption2 array{siteId: string, domain: string|null, uid: int, services: list<string>, serviceCount: int, inactiveServices: list<string>}
 */
final class ContextResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * GET /context/{siteId}
     *
     * Get site context
     * Call: $api->agrSite->context->get($siteId)
     *
     * get the context for a site
     *
     * Auth: bearer token; spec scopes: none listed (most endpoints list `public`)
     *
     * Errors:
     *   403: The siteId in the path does not match x-site-id.
     *
     * GET https://agr-site.augur-api.com/context/{siteId}
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1context~1{siteId}/get
     *
     * $params also takes edgeCache, the Cloudflare edge cache time: '30s', '1m', '5m', or 1-5 or 8
     * (hours).
     *
     * Response data type: ContextGetDataOption1|ContextGetDataOption2
     *   one of:
     *     ContextGetDataOption1 — A site's configuration as the admin site (augur_info) sees it:
     *         every service with its full config
     *     ContextGetDataOption2 — A site's configuration as the site itself sees it: service names
     *         only
     *
     * @param string $siteId target site ID to get context for
     * @param array<string, mixed> $params
     * @return BaseResponse<ContextGetDataOption1|ContextGetDataOption2>
     */
    public function get(string $siteId, array $params = []): BaseResponse
    {
        $response = $this->client->get(
            $this->baseUrl,
            '/{siteId}',
            $params,
            ['siteId' => (string) $siteId],
        );

        /** @var BaseResponse<ContextGetDataOption1|ContextGetDataOption2> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
