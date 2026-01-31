<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Pricing\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class PriceEngineResourceTest extends AugurApiTestCase
{
    public function testGetPrice(): void
    {
        $this->mockResponse([
            'itemId' => 'ITEM001',
            'basePrice' => 100.00,
            'customerPrice' => 85.00,
            'quantity' => 10,
            'uom' => 'EA',
            'discountPercent' => 15,
            'priceSource' => 'Customer Contract',
        ]);

        $response = $this->api->pricing->priceEngine->getPrice([
            'itemId' => 'ITEM001',
            'customerId' => 'CUST001',
            'quantity' => 10,
        ]);

        $this->assertEquals('ITEM001', $response->data['itemId']);
        $this->assertEquals(85.00, $response->data['customerPrice']);
        $this->assertEquals(15, $response->data['discountPercent']);
        $this->assertRequestPath('/price-engine');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testGetPriceWithUom(): void
    {
        $this->mockResponse([
            'itemId' => 'ITEM001',
            'basePrice' => 1000.00,
            'customerPrice' => 950.00,
            'uom' => 'CS',
            'uomConversion' => 12,
        ]);

        $response = $this->api->pricing->priceEngine->getPrice([
            'itemId' => 'ITEM001',
            'customerId' => 'CUST001',
            'quantity' => 1,
            'uom' => 'CS',
        ]);

        $this->assertEquals('CS', $response->data['uom']);
        $this->assertEquals(12, $response->data['uomConversion']);
    }

    public function testGetPriceWithVolumePricing(): void
    {
        $this->mockResponse([
            'itemId' => 'ITEM002',
            'basePrice' => 50.00,
            'customerPrice' => 40.00,
            'quantity' => 100,
            'volumeBreak' => true,
            'breakPrice' => 40.00,
            'nextBreak' => 200,
            'nextBreakPrice' => 35.00,
        ]);

        $response = $this->api->pricing->priceEngine->getPrice([
            'itemId' => 'ITEM002',
            'customerId' => 'CUST002',
            'quantity' => 100,
        ]);

        $this->assertTrue($response->data['volumeBreak']);
        $this->assertEquals(40.00, $response->data['breakPrice']);
        $this->assertEquals(200, $response->data['nextBreak']);
    }

    public function testGetPriceWithLocationId(): void
    {
        $this->mockResponse([
            'itemId' => 'ITEM003',
            'locationId' => 'LOC01',
            'customerPrice' => 75.00,
            'inStock' => true,
            'availableQty' => 50,
        ]);

        $response = $this->api->pricing->priceEngine->getPrice([
            'itemId' => 'ITEM003',
            'customerId' => 'CUST001',
            'quantity' => 5,
            'locationId' => 'LOC01',
        ]);

        $this->assertEquals('LOC01', $response->data['locationId']);
        $this->assertTrue($response->data['inStock']);
    }

    public function testGetPriceWithDate(): void
    {
        $this->mockResponse([
            'itemId' => 'ITEM001',
            'customerPrice' => 80.00,
            'priceDate' => '2024-06-01',
            'futurePrice' => true,
        ]);

        $response = $this->api->pricing->priceEngine->getPrice([
            'itemId' => 'ITEM001',
            'customerId' => 'CUST001',
            'quantity' => 1,
            'priceDate' => '2024-06-01',
        ]);

        $this->assertEquals('2024-06-01', $response->data['priceDate']);
        $this->assertTrue($response->data['futurePrice']);
    }

    public function testGetPriceNoDiscount(): void
    {
        $this->mockResponse([
            'itemId' => 'ITEM004',
            'basePrice' => 25.00,
            'customerPrice' => 25.00,
            'discountPercent' => 0,
            'priceSource' => 'List Price',
        ]);

        $response = $this->api->pricing->priceEngine->getPrice([
            'itemId' => 'ITEM004',
            'customerId' => 'NEWCUST',
            'quantity' => 1,
        ]);

        $this->assertEquals($response->data['basePrice'], $response->data['customerPrice']);
        $this->assertEquals('List Price', $response->data['priceSource']);
    }
}
