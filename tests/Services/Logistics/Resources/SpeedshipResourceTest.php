<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Logistics\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class SpeedshipResourceTest extends AugurApiTestCase
{
    public function testGetFreight(): void
    {
        $this->mockResponse([
            'freightQuotes' => [
                [
                    'carrier' => 'ABF',
                    'rate' => 350.00,
                    'transitDays' => 5,
                    'serviceType' => 'Standard',
                ],
                [
                    'carrier' => 'ODFL',
                    'rate' => 400.00,
                    'transitDays' => 3,
                    'serviceType' => 'Priority',
                ],
            ],
            'origin' => ['zip' => '12345'],
            'destination' => ['zip' => '67890'],
        ]);

        $response = $this->api->logistics->speedship->getFreight([
            'originZip' => '12345',
            'destZip' => '67890',
            'totalWeight' => 500,
        ]);

        $this->assertCount(2, $response->data['freightQuotes']);
        $this->assertEquals('ABF', $response->data['freightQuotes'][0]['carrier']);
        $this->assertEquals(350.00, $response->data['freightQuotes'][0]['rate']);
        $this->assertRequestPath('/speedship/freight');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testGetFreightWithItems(): void
    {
        $this->mockResponse([
            'freightQuotes' => [
                ['carrier' => 'ABF', 'rate' => 450.00],
            ],
            'itemCount' => 3,
        ]);

        $response = $this->api->logistics->speedship->getFreight([
            'originZip' => '12345',
            'destZip' => '67890',
            'items' => [
                ['weight' => 100, 'class' => '50'],
                ['weight' => 200, 'class' => '70'],
                ['weight' => 150, 'class' => '50'],
            ],
        ]);

        $this->assertNotEmpty($response->data['freightQuotes']);
    }

    public function testGetFreightWithAccessorials(): void
    {
        $this->mockResponse([
            'freightQuotes' => [
                [
                    'carrier' => 'ABF',
                    'rate' => 550.00,
                    'accessorials' => ['liftgate', 'residential'],
                ],
            ],
        ]);

        $response = $this->api->logistics->speedship->getFreight([
            'originZip' => '12345',
            'destZip' => '67890',
            'totalWeight' => 500,
            'liftgate' => true,
            'residential' => true,
        ]);

        $this->assertContains('liftgate', $response->data['freightQuotes'][0]['accessorials']);
    }

    public function testGetFreightWithInsurance(): void
    {
        $this->mockResponse([
            'freightQuotes' => [
                [
                    'carrier' => 'ODFL',
                    'rate' => 425.00,
                    'insuranceIncluded' => true,
                    'declaredValue' => 5000,
                ],
            ],
        ]);

        $response = $this->api->logistics->speedship->getFreight([
            'originZip' => '12345',
            'destZip' => '67890',
            'totalWeight' => 300,
            'declaredValue' => 5000,
        ]);

        $this->assertTrue($response->data['freightQuotes'][0]['insuranceIncluded']);
    }

    public function testGetFreightEmpty(): void
    {
        $this->mockResponse([
            'freightQuotes' => [],
            'message' => 'No carriers available for this route.',
        ]);

        $response = $this->api->logistics->speedship->getFreight([
            'originZip' => '00000',
            'destZip' => '99999',
            'totalWeight' => 1,
        ]);

        $this->assertEmpty($response->data['freightQuotes']);
        $this->assertArrayHasKey('message', $response->data);
    }
}
