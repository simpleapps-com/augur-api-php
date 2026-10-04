<?php

declare(strict_types=1);

namespace AugurApi\Services\AgrInfo;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\AgrInfo\Resources\AkashaResource;
use AugurApi\Services\AgrInfo\Resources\ContextResource;
use AugurApi\Services\AgrInfo\Resources\JoomlaResource;
use AugurApi\Services\AgrInfo\Resources\MicroservicesResource;
use AugurApi\Services\AgrInfo\Resources\RubricsResource;
use AugurApi\Services\AgrInfo\Resources\SitesResource;
use AugurApi\Services\AgrInfo\Resources\WorkflowsResource;

/**
 * AgrInfo service client — generated from spec.
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
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   POST /akasha/generate → $api->agrInfo->akasha->createGenerate($data) → string
 *   GET /context/{siteId} → $api->agrInfo->context->get($siteId) →
 *       ContextGetDataOption1|ContextGetDataOption2
 *   POST /joomla/generate → $api->agrInfo->joomla->createGenerate($data) → string
 *   GET /microservices → $api->agrInfo->microservices->list() → list of MicroservicesListItem
 *   POST /microservices → $api->agrInfo->microservices->create($data) → MicroservicesListItem
 *   GET /microservices/{microservicesUid} → $api->agrInfo->microservices->get($microservicesUid) →
 *       MicroservicesListItem
 *   PUT /microservices/{microservicesUid} →
 *       $api->agrInfo->microservices->update($microservicesUid, $data) → MicroservicesListItem
 *   DELETE /microservices/{microservicesUid} →
 *       $api->agrInfo->microservices->delete($microservicesUid) → MicroservicesListItem
 *   GET /rubrics → $api->agrInfo->rubrics->list() → list of RubricsListItem
 *   POST /rubrics → $api->agrInfo->rubrics->create($data) → RubricsListItem
 *   GET /rubrics/{rubricsUid} → $api->agrInfo->rubrics->get($rubricsUid) → RubricsListItem
 *   PUT /rubrics/{rubricsUid} → $api->agrInfo->rubrics->update($rubricsUid, $data) →
 *       RubricsListItem
 *   DELETE /rubrics/{rubricsUid} → $api->agrInfo->rubrics->delete($rubricsUid) → RubricsListItem
 *   POST /sites/staff-token → $api->agrInfo->sites->createStaffToken($data) →
 *       SitesStaffTokenCreateData
 *   POST /sites/validate → $api->agrInfo->sites->createValidate($data) → SitesValidateCreateData
 *   GET /workflows → $api->agrInfo->workflows->list() → list of WorkflowsListItem
 *   POST /workflows → $api->agrInfo->workflows->create($data) → WorkflowsListItem
 *   GET /workflows/{workflowsUid} → $api->agrInfo->workflows->get($workflowsUid) →
 *       WorkflowsListItem
 *   PUT /workflows/{workflowsUid} → $api->agrInfo->workflows->update($workflowsUid, $data) →
 *       WorkflowsListItem
 *   DELETE /workflows/{workflowsUid} → $api->agrInfo->workflows->delete($workflowsUid) →
 *       WorkflowsListItem
 */
final class AgrInfoClient extends BaseServiceClient
{
    public readonly AkashaResource $akasha;
    public readonly ContextResource $context;
    public readonly JoomlaResource $joomla;
    public readonly MicroservicesResource $microservices;
    public readonly RubricsResource $rubrics;
    public readonly SitesResource $sites;
    public readonly WorkflowsResource $workflows;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->akasha = new AkashaResource($this->client, $this->baseUrl . '/akasha');
        $this->context = new ContextResource($this->client, $this->baseUrl . '/context');
        $this->joomla = new JoomlaResource($this->client, $this->baseUrl . '/joomla');
        $this->microservices = new MicroservicesResource($this->client, $this->baseUrl . '/microservices');
        $this->rubrics = new RubricsResource($this->client, $this->baseUrl . '/rubrics');
        $this->sites = new SitesResource($this->client, $this->baseUrl . '/sites');
        $this->workflows = new WorkflowsResource($this->client, $this->baseUrl . '/workflows');
    }

    protected function getServiceName(): string
    {
        return 'agrInfo';
    }
}
