<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Pricing\Resources;

use AugurApi\Services\Pricing\Resources\WebPricingResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for WebPricingResource.
 */
#[CoversClass(WebPricingResource::class)]
final class WebPricingResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['webPricingUid' => 1, 'itemId' => 'ITEM001', 'webPrice' => 99.00],
            ['webPricingUid' => 2, 'itemId' => 'ITEM002', 'webPrice' => 49.00],
        ]);

        $response = $this->api->pricing->webPricing->list();

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('ITEM001', $data[0]['itemId']);
        $this->assertRequestPath('/web-pricing');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['webPricingUid' => 1, 'itemId' => 'ITEM001'],
        ], 40);

        $response = $this->api->pricing->webPricing->list(['limit' => 10, 'itemId' => 'ITEM001']);

        $this->assertCount(1, $response->data);
        $this->assertEquals(40, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'webPricingUid' => 1,
            'itemId' => 'ITEM001',
            'webPrice' => 99.00,
            'listPrice' => 120.00,
        ]);

        $response = $this->api->pricing->webPricing->get(1);

        $this->assertEquals(1, $response->data['webPricingUid']);
        $this->assertEquals(99.00, $response->data['webPrice']);
        $this->assertRequestPath('/web-pricing/1');
        $this->assertRequestMethod('GET');
    }

    public function testListCustomers(): void
    {
        $this->mockListResponse([
            ['customerId' => 1001, 'webPricingUid' => 1, 'customerPrice' => 89.00],
        ]);

        $response = $this->api->pricing->webPricing->listCustomers(1);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/web-pricing/1/customers');
        $this->assertRequestMethod('GET');
    }

    public function testGetCustomers(): void
    {
        $this->mockResponse([
            'customerId' => 1001,
            'webPricingUid' => 1,
            'customerPrice' => 89.00,
        ]);

        $response = $this->api->pricing->webPricing->getCustomers(1, 1001);

        $this->assertEquals(1001, $response->data['customerId']);
        $this->assertEquals(89.00, $response->data['customerPrice']);
        $this->assertRequestPath('/web-pricing/1/customers/1001');
        $this->assertRequestMethod('GET');
    }
}
