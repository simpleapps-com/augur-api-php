<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Logistics\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class ShipviaResourceTest extends AugurApiTestCase
{
    public function testListRates(): void
    {
        $this->mockResponse([
            'rates' => [
                ['carrier' => 'UPS', 'service' => 'Ground', 'rate' => 12.99, 'days' => 5],
                ['carrier' => 'FedEx', 'service' => 'Express', 'rate' => 25.99, 'days' => 2],
            ],
        ]);

        $response = $this->api->logistics->shipvia->listRates([
            'fromPostalCode' => '12345',
            'toPostalCode' => '67890',
            'totalWeight' => 10,
            'weightUnit' => 'LB',
            'locationId' => 1,
        ]);

        $this->assertCount(2, $response->data['rates']);
        $this->assertEquals('UPS', $response->data['rates'][0]['carrier']);
        $this->assertRequestPath('/shipvia/rates');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListRatesLtl(): void
    {
        $this->mockResponse([
            'rates' => [
                ['carrier' => 'ABF Freight', 'service' => 'LTL', 'rate' => 250.00],
            ],
        ]);

        $response = $this->api->logistics->shipvia->listRatesLtl([
            'fromPostalCode' => '12345',
            'toPostalCode' => '67890',
            'totalWeight' => 500,
            'weightUnit' => 'LB',
            'locationId' => 1,
            'commodityClass' => '50',
            'commodityDescription' => 'General freight',
            'packagingType' => 'PALLET',
        ]);

        $this->assertCount(1, $response->data['rates']);
        $this->assertEquals('ABF Freight', $response->data['rates'][0]['carrier']);
        $this->assertRequestPath('/shipvia/rates/ltl');
        $this->assertRequestMethod('GET');
    }
}
