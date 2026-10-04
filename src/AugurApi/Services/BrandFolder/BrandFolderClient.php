<?php

declare(strict_types=1);

namespace AugurApi\Services\BrandFolder;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\BrandFolder\Resources\CategoriesResource;

/**
 * BrandFolder service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://brand-folder.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path,
 *       path params and query params, each with type and required flag. Grep it for a path; for a
 *       GET that line is all you need. Bodies are not in it.
 *   https://brand-folder.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://brand-folder.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py brand-folder
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /categories → $api->brandFolder->categories->list() → list of CategoriesListItem
 *   POST /categories/focus → $api->brandFolder->categories->createFocus($data) → bool
 *   GET /categories/{itemCategoryUid} → $api->brandFolder->categories->get($itemCategoryUid) →
 *       CategoriesListItem
 */
final class BrandFolderClient extends BaseServiceClient
{
    public readonly CategoriesResource $categories;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->categories = new CategoriesResource($this->client, $this->baseUrl . '/categories');
    }

    protected function getServiceName(): string
    {
        return 'brandFolder';
    }
}
