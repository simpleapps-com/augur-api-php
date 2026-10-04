<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrSite\Resources;

use AugurApi\Core\BaseResponse;
use AugurApi\Core\Client;

/**
 * datafiles resource — generated from spec.
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
 * DatafilesCreateBody: Write one file into the calling site's public (www) or private (datafiles)
 * folder
 * Request body of: $api->agrSite->datafiles->create($data)
 *   location: string — public (www) or private (datafiles); anything else is rejected
 *   path: string — Relative file path; MUST NOT be empty, absolute, or contain .. segments, and
 *       MUST end in an allowed extension
 *   content: string — File content, base64-encoded; MUST NOT be empty or contain a PHP open tag
 *
 * @phpstan-type DatafilesCreateBody array{location: string, path: string, content: string}
 */
final class DatafilesResource
{
    public function __construct(
        private readonly Client $client,
        private readonly string $baseUrl,
    ) {
    }

    /**
     * POST /datafiles
     *
     * Write a file to a site web folder
     * Call: $api->agrSite->datafiles->create($data)
     *
     * Request body: Write one file into the calling site's public (www) or private (datafiles)
     * folder
     *
     * Success status: 201 (not 200)
     *
     * Errors:
     *   400: Request rejected: location, path or content is missing or invalid.
     *   403: Request rejected: the file extension is not allowed, or the content contains a PHP
     *       open tag.
     *
     * POST https://agr-site.augur-api.com/datafiles
     * Contract: https://agr-site.augur-api.com/openapi.json#/paths/~1datafiles/post
     *
     * Request body ($data): DatafilesCreateBody (fields listed on the class)
     *
     * Response data type: string
     *
     * @param DatafilesCreateBody $data
     * @return BaseResponse<string>
     */
    public function create(array $data): BaseResponse
    {
        $response = $this->client->post($this->baseUrl, '', $data);

        /** @var BaseResponse<string> $result */
        $result = BaseResponse::fromArray($response, static fn (mixed $data): mixed => $data);

        return $result;
    }
}
