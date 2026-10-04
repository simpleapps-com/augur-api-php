<?php

declare(strict_types=1);

namespace AugurApi\Services\P21Pim;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\P21Pim\Resources\InvMastExtResource;
use AugurApi\Services\P21Pim\Resources\InvMastFilesResource;
use AugurApi\Services\P21Pim\Resources\InvMastTextResource;
use AugurApi\Services\P21Pim\Resources\ItemsResource;
use AugurApi\Services\P21Pim\Resources\PodcastsResource;

/**
 * P21Pim service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://p21-pim.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://p21-pim.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://p21-pim.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py p21-pim
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /inv-mast-ext → $api->p21Pim->invMastExt->list() → list of InvMastExtListItem
 *   POST /inv-mast-ext → $api->p21Pim->invMastExt->create($data) → InvMastExtListItem
 *   GET /inv-mast-ext/{invMastExtUid} → $api->p21Pim->invMastExt->get($invMastExtUid) →
 *       InvMastExtListItem
 *   PUT /inv-mast-ext/{invMastExtUid} → $api->p21Pim->invMastExt->update($invMastExtUid, $data) →
 *       InvMastExtListItem
 *   DELETE /inv-mast-ext/{invMastExtUid} → $api->p21Pim->invMastExt->delete($invMastExtUid) →
 *       InvMastExtListItem
 *   GET /inv-mast-files → $api->p21Pim->invMastFiles->list() → list of InvMastFilesListItem
 *   POST /inv-mast-files → $api->p21Pim->invMastFiles->create($data) → InvMastFilesListItem
 *   GET /inv-mast-files/{invMastFilesUid} → $api->p21Pim->invMastFiles->get($invMastFilesUid) →
 *       InvMastFilesListItem
 *   PUT /inv-mast-files/{invMastFilesUid} →
 *       $api->p21Pim->invMastFiles->update($invMastFilesUid, $data) → InvMastFilesListItem
 *   DELETE /inv-mast-files/{invMastFilesUid} →
 *       $api->p21Pim->invMastFiles->delete($invMastFilesUid) → InvMastFilesListItem
 *   GET /inv-mast-text → $api->p21Pim->invMastText->list() → list of InvMastTextListItem
 *   POST /inv-mast-text → $api->p21Pim->invMastText->create($data) → InvMastTextListItem
 *   GET /inv-mast-text/{invMastTextUid} → $api->p21Pim->invMastText->get($invMastTextUid) →
 *       InvMastTextListItem
 *   PUT /inv-mast-text/{invMastTextUid} →
 *       $api->p21Pim->invMastText->update($invMastTextUid, $data) → InvMastTextListItem
 *   DELETE /inv-mast-text/{invMastTextUid} → $api->p21Pim->invMastText->delete($invMastTextUid) →
 *       InvMastTextListItem
 *   GET /items/{invMastUid}/suggest-display-desc →
 *       $api->p21Pim->items->listSuggestDisplayDesc($invMastUid) →
 *       list<ItemsSuggestDisplayDescListDataOption1Item>|false
 *   GET /items/{invMastUid}/suggest-web-desc →
 *       $api->p21Pim->items->listSuggestWebDesc($invMastUid) →
 *       list<ItemsSuggestDisplayDescListDataOption1Item>|false
 *   GET /podcasts → $api->p21Pim->podcasts->list() → list of PodcastsListItem
 *   POST /podcasts → $api->p21Pim->podcasts->create($data) → PodcastsListItem
 *   GET /podcasts/{podcastsUid} → $api->p21Pim->podcasts->get($podcastsUid) → PodcastsListItem
 *   PUT /podcasts/{podcastsUid} → $api->p21Pim->podcasts->update($podcastsUid, $data) →
 *       PodcastsListItem
 *   DELETE /podcasts/{podcastsUid} → $api->p21Pim->podcasts->delete($podcastsUid) →
 *       PodcastsListItem
 */
final class P21PimClient extends BaseServiceClient
{
    public readonly InvMastExtResource $invMastExt;
    public readonly InvMastFilesResource $invMastFiles;
    public readonly InvMastTextResource $invMastText;
    public readonly ItemsResource $items;
    public readonly PodcastsResource $podcasts;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->invMastExt = new InvMastExtResource($this->client, $this->baseUrl . '/inv-mast-ext');
        $this->invMastFiles = new InvMastFilesResource($this->client, $this->baseUrl . '/inv-mast-files');
        $this->invMastText = new InvMastTextResource($this->client, $this->baseUrl . '/inv-mast-text');
        $this->items = new ItemsResource($this->client, $this->baseUrl . '/items');
        $this->podcasts = new PodcastsResource($this->client, $this->baseUrl . '/podcasts');
    }

    protected function getServiceName(): string
    {
        return 'p21Pim';
    }
}
