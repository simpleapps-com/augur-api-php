<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Logistics\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class ShipviaResourceTest extends AugurApiTestCase
{
    public function testGetRates(): void
    {
        $this->mockResponse([
            'rates' => [
                ['carrier' => 'UPS', 'service' => 'Ground', 'rate' => 12.99, 'days' => 5],
                ['carrier' => 'FedEx', 'service' => 'Express', 'rate' => 25.99, 'days' => 2],
            ],
            'fromZip' => '12345',
            'toZip' => '67890',
        ]);

        $response = $this->api->logistics->shipvia->getRates([
            'fromZip' => '12345',
            'toZip' => '67890',
            'weight' => 10,
        ]);

        $this->assertCount(2, $response->data['rates']);
        $this->assertEquals('UPS', $response->data['rates'][0]['carrier']);
        $this->assertEquals(12.99, $response->data['rates'][0]['rate']);
        $this->assertRequestPath('/shipvia/rates');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testGetRatesWithDimensions(): void
    {
        $this->mockResponse([
            'rates' => [
                ['carrier' => 'UPS', 'service' => 'Ground', 'rate' => 15.99, 'days' => 5],
            ],
        ]);

        $response = $this->api->logistics->shipvia->getRates([
            'fromZip' => '12345',
            'toZip' => '67890',
            'weight' => 10,
            'length' => 12,
            'width' => 8,
            'height' => 6,
        ]);

        $this->assertCount(1, $response->data['rates']);
    }

    public function testGetRatesWithResidential(): void
    {
        $this->mockResponse([
            'rates' => [
                ['carrier' => 'UPS', 'service' => 'Ground', 'rate' => 14.99, 'days' => 5],
            ],
        ]);

        $response = $this->api->logistics->shipvia->getRates([
            'fromZip' => '12345',
            'toZip' => '67890',
            'weight' => 10,
            'residential' => true,
        ]);

        $this->assertNotEmpty($response->data['rates']);
    }

    public function testGetLtlRates(): void
    {
        $this->mockResponse([
            'rates' => [
                [
                    'carrier' => 'ABF Freight',
                    'service' => 'LTL',
                    'rate' => 250.00,
                    'days' => 7,
                    'class' => '50',
                ],
                [
                    'carrier' => 'Old Dominion',
                    'service' => 'LTL',
                    'rate' => 275.00,
                    'days' => 5,
                    'class' => '50',
                ],
            ],
            'totalWeight' => 500,
        ]);

        $response = $this->api->logistics->shipvia->getLtlRates([
            'fromZip' => '12345',
            'toZip' => '67890',
            'weight' => 500,
            'class' => '50',
        ]);

        $this->assertCount(2, $response->data['rates']);
        $this->assertEquals('ABF Freight', $response->data['rates'][0]['carrier']);
        $this->assertEquals('LTL', $response->data['rates'][0]['service']);
        $this->assertRequestPath('/shipvia/rates/ltl');
        $this->assertRequestMethod('GET');
    }

    public function testGetLtlRatesWithMultiplePallets(): void
    {
        $this->mockResponse([
            'rates' => [
                ['carrier' => 'ABF Freight', 'rate' => 500.00],
            ],
            'palletCount' => 3,
        ]);

        $response = $this->api->logistics->shipvia->getLtlRates([
            'fromZip' => '12345',
            'toZip' => '67890',
            'weight' => 1500,
            'class' => '70',
            'palletCount' => 3,
        ]);

        $this->assertEquals(3, $response->data['palletCount']);
    }

    public function testGetLtlRatesWithLiftgate(): void
    {
        $this->mockResponse([
            'rates' => [
                ['carrier' => 'Old Dominion', 'rate' => 325.00, 'liftgate' => true],
            ],
        ]);

        $response = $this->api->logistics->shipvia->getLtlRates([
            'fromZip' => '12345',
            'toZip' => '67890',
            'weight' => 500,
            'liftgate' => true,
        ]);

        $this->assertTrue($response->data['rates'][0]['liftgate']);
    }
}
