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
        $this->mockListResponse([
            ['shipperName' => 'UPS', 'serviceType' => 'Ground', 'listAmount' => 12.50],
            ['shipperName' => 'FedEx', 'serviceType' => 'Ground', 'listAmount' => 11.75],
        ]);

        $response = $this->api->shipping->rates->create([
            'shippers' => ['UPS', 'FedEx'],
            'fromAddress' => ['postalCode' => '90210', 'countryCode' => 'US'],
            'toAddress' => ['postalCode' => '10001', 'countryCode' => 'US'],
            'package' => ['weight' => 5],
        ]);

        $this->assertCount(2, $response->data);
        $this->assertEquals('UPS', self::at($response->data, 0, 'shipperName'));
        $this->assertRequestPath('/rates');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreateReturnsBaseResponse(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->shipping->rates->create([
            'shippers' => ['UPS'],
            'fromAddress' => ['postalCode' => '00000'],
            'toAddress' => ['postalCode' => '99999'],
            'package' => [],
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertEmpty($response->data);
    }
}
