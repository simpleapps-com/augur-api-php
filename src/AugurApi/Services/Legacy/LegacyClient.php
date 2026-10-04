<?php

declare(strict_types=1);

namespace AugurApi\Services\Legacy;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Legacy\Resources\InvMastResource;
use AugurApi\Services\Legacy\Resources\ItemCategoryResource;
use AugurApi\Services\Legacy\Resources\LegacyResource;

/**
 * Legacy service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://legacy.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://legacy.augur-api.com/openapi.json: the full contract: request and response bodies field
 *       by field, descriptions, formats and documented errors.
 *   https://legacy.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py legacy
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /inv-mast/{invMastUid}/also-bought → $api->legacy->invMast->listAlsoBought($invMastUid) →
 *       list of InvMastAlsoBoughtListItem
 *   GET /inv-mast/{invMastUid}/tags → $api->legacy->invMast->listTags($invMastUid) →
 *       list of InvMastTagsListItem
 *   POST /inv-mast/{invMastUid}/tags → $api->legacy->invMast->createTags($invMastUid, $data) →
 *       InvMastTagsListItem
 *   GET /inv-mast/{invMastUid}/tags/{invMastTagsUid} →
 *       $api->legacy->invMast->getTags($invMastUid, $invMastTagsUid) → InvMastTagsListItem
 *   PUT /inv-mast/{invMastUid}/tags/{invMastTagsUid} →
 *       $api->legacy->invMast->updateTags($invMastUid, $invMastTagsUid, $data) →
 *       InvMastTagsListItem
 *   DELETE /inv-mast/{invMastUid}/tags/{invMastTagsUid} →
 *       $api->legacy->invMast->deleteTags($invMastUid, $invMastTagsUid) → InvMastTagsListItem
 *   GET /inv-mast/{invMastUid}/web-desc → $api->legacy->invMast->listWebDesc($invMastUid) →
 *       list of InvMastWebDescListItem
 *   POST /inv-mast/{invMastUid}/web-desc →
 *       $api->legacy->invMast->createWebDesc($invMastUid, $data) → InvMastWebDescListItem
 *   GET /inv-mast/{invMastUid}/web-desc/{invMastWebDescUid} →
 *       $api->legacy->invMast->getWebDesc($invMastUid, $invMastWebDescUid) → InvMastWebDescListItem
 *   PUT /inv-mast/{invMastUid}/web-desc/{invMastWebDescUid} →
 *       $api->legacy->invMast->updateWebDesc($invMastUid, $invMastWebDescUid, $data) →
 *       InvMastWebDescListItem
 *   DELETE /inv-mast/{invMastUid}/web-desc/{invMastWebDescUid} →
 *       $api->legacy->invMast->deleteWebDesc($invMastUid, $invMastWebDescUid) →
 *       InvMastWebDescListItem
 *   GET /item-category/{itemCategoryUid} → $api->legacy->itemCategory->get($itemCategoryUid) →
 *       ItemCategoryGetData
 *   GET /legacy/state → $api->legacy->legacy->listState() → list of LegacyStateListItem
 *   POST /legacy/state → $api->legacy->legacy->createState($data) → LegacyStateListItem
 *   GET /legacy/state/{stateUid} → $api->legacy->legacy->getState($stateUid) → LegacyStateListItem
 *   PUT /legacy/state/{stateUid} → $api->legacy->legacy->updateState($stateUid, $data) →
 *       LegacyStateListItem
 *   DELETE /legacy/state/{stateUid} → $api->legacy->legacy->deleteState($stateUid) →
 *       LegacyStateListItem
 */
final class LegacyClient extends BaseServiceClient
{
    public readonly InvMastResource $invMast;
    public readonly ItemCategoryResource $itemCategory;
    public readonly LegacyResource $legacy;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->invMast = new InvMastResource($this->client, $this->baseUrl . '/inv-mast');
        $this->itemCategory = new ItemCategoryResource($this->client, $this->baseUrl . '/item-category');
        $this->legacy = new LegacyResource($this->client, $this->baseUrl . '/legacy');
    }

    protected function getServiceName(): string
    {
        return 'legacy';
    }
}
