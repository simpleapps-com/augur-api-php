<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Shipping\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for Shipping RatesResource.
 */
final class RatesResourceTest extends AugurApiTestCase
{
    public function testCreate(): void
    {
        $this->mockResponse([
            'rates' => [
                [
                    'carrier' => 'UPS',
                    'service' => 'Ground',
                    'rate' => 12.50,
                    'deliveryDays' => 5,
                ],
                [
                    'carrier' => 'FedEx',
                    'service' => 'Ground',
                    'rate' => 11.75,
                    'deliveryDays' => 4,
                ],
            ],
            'cheapest' => 'FedEx Ground',
            'fastest' => 'FedEx Ground',
        ]);

        $response = $this->api->shipping->rates->create([
            'origin' => [
                'postalCode' => '90210',
                'country' => 'US',
            ],
            'destination' => [
                'postalCode' => '10001',
                'country' => 'US',
            ],
            'packages' => [
                [
                    'weight' => 5.0,
                    'dimensions' => [
                        'length' => 10,
                        'width' => 8,
                        'height' => 6,
                    ],
                ],
            ],
        ]);

        $this->assertCount(2, $response->data['rates']);
        $this->assertEquals('UPS', $response->data['rates'][0]['carrier']);
        $this->assertEquals('FedEx Ground', $response->data['cheapest']);
        $this->assertRequestPath('/rates');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreateWithMultiplePackages(): void
    {
        $this->mockResponse([
            'rates' => [
                ['carrier' => 'UPS', 'service' => 'Ground', 'rate' => 25.00],
            ],
            'totalWeight' => 15.0,
        ]);

        $response = $this->api->shipping->rates->create([
            'origin' => ['postalCode' => '90210', 'country' => 'US'],
            'destination' => ['postalCode' => '10001', 'country' => 'US'],
            'packages' => [
                ['weight' => 5.0],
                ['weight' => 5.0],
                ['weight' => 5.0],
            ],
        ]);

        $this->assertEquals(15.0, $response->data['totalWeight']);
        $this->assertCount(1, $response->data['rates']);
    }

    public function testCreateReturnsBaseResponse(): void
    {
        $this->mockResponse([
            'rates' => [],
            'message' => 'No rates available',
        ]);

        $response = $this->api->shipping->rates->create([
            'origin' => ['postalCode' => '00000'],
            'destination' => ['postalCode' => '99999'],
            'packages' => [],
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data['rates']);
    }
}
