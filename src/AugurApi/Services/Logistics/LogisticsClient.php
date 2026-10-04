<?php

declare(strict_types=1);

namespace AugurApi\Services\Logistics;

use AugurApi\Core\BaseServiceClient;
use AugurApi\Core\Client;
use AugurApi\Core\Config;
use AugurApi\Services\Logistics\Resources\FedexResource;
use AugurApi\Services\Logistics\Resources\RtsResource;
use AugurApi\Services\Logistics\Resources\ShippingMethodsResource;
use AugurApi\Services\Logistics\Resources\ShipviaResource;
use AugurApi\Services\Logistics\Resources\SpeedshipResource;
use AugurApi\Services\Logistics\Resources\UpsResource;

/**
 * Logistics service client — generated from spec.
 *
 * Public specs (the source of truth for every shape in this file):
 *   https://logistics.augur-api.com/endpoints.jsonl: one JSON line per endpoint: method, path, path
 *       params and query params, each with type and required flag. Grep it for a path; for a GET
 *       that line is all you need. Bodies are not in it.
 *   https://logistics.augur-api.com/openapi.json: the full contract: request and response bodies
 *       field by field, descriptions, formats and documented errors.
 *   https://logistics.augur-api.com/llms.txt: the plain-text endpoint list and the other Augur
 *       services.
 *
 * DO NOT EDIT — regenerate with: python shared/scripts/generate-php.py logistics
 *
 * Endpoints, in spec order: path → exact call → response data type (`untyped` = any JSON). Shapes
 * are documented on each resource class.
 *   GET /fedex/rates → $api->logistics->fedex->listRates() → list of FedexRatesListItem
 *   GET /rts/brands → $api->logistics->rts->listBrands() → untyped
 *   GET /rts/brands/{brandId}/machines → $api->logistics->rts->listBrandsMachines($brandId) →
 *       untyped
 *   GET /rts/machines/{machineId}/tracks → $api->logistics->rts->listMachinesTracks($machineId) →
 *       untyped
 *   GET /rts/search/machines → $api->logistics->rts->listSearchMachines() → untyped
 *   GET /rts/track/{trackId} → $api->logistics->rts->getTrack($trackId) → untyped
 *   GET /rts/tracks → $api->logistics->rts->listTracks() → untyped
 *   GET /shipping-methods → $api->logistics->shippingMethods->list() →
 *       list of ShippingMethodsListItem
 *   GET /shipping-methods/{shippingMethodsUid} →
 *       $api->logistics->shippingMethods->get($shippingMethodsUid) → ShippingMethodsListItem
 *   PUT /shipping-methods/{shippingMethodsUid} →
 *       $api->logistics->shippingMethods->update($shippingMethodsUid, $data) →
 *       ShippingMethodsListItem
 *   DELETE /shipping-methods/{shippingMethodsUid} →
 *       $api->logistics->shippingMethods->delete($shippingMethodsUid) → ShippingMethodsListItem
 *   GET /shipvia/rates → $api->logistics->shipvia->listRates() → list of ShipviaRatesListItem
 *   GET /shipvia/rates/ltl → $api->logistics->shipvia->listRatesLtl() →
 *       list of ShipviaRatesListItem
 *   GET /speedship/freight → $api->logistics->speedship->listFreight() → untyped
 *   GET /ups/rates → $api->logistics->ups->listRates() → list of FedexRatesListItem
 */
final class LogisticsClient extends BaseServiceClient
{
    public readonly FedexResource $fedex;
    public readonly RtsResource $rts;
    public readonly ShippingMethodsResource $shippingMethods;
    public readonly ShipviaResource $shipvia;
    public readonly SpeedshipResource $speedship;
    public readonly UpsResource $ups;

    public function __construct(Client $client, Config $config)
    {
        parent::__construct($client, $config);
        $this->fedex = new FedexResource($this->client, $this->baseUrl . '/fedex');
        $this->rts = new RtsResource($this->client, $this->baseUrl . '/rts');
        $this->shippingMethods = new ShippingMethodsResource($this->client, $this->baseUrl . '/shipping-methods');
        $this->shipvia = new ShipviaResource($this->client, $this->baseUrl . '/shipvia');
        $this->speedship = new SpeedshipResource($this->client, $this->baseUrl . '/speedship');
        $this->ups = new UpsResource($this->client, $this->baseUrl . '/ups');
    }

    protected function getServiceName(): string
    {
        return 'logistics';
    }
}
