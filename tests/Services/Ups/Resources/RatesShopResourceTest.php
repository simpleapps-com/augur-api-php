<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Ups\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for Ups RatesShopResource.
 */
final class RatesShopResourceTest extends AugurApiTestCase
{
    public function testGet(): void
    {
        $this->mockListResponse([
            [
                'serviceCode' => '03',
                'serviceName' => 'UPS Ground',
                'totalCharges' => 15.50,
                'currencyCode' => 'USD',
                'businessDaysInTransit' => 5,
            ],
            [
                'serviceCode' => '02',
                'serviceName' => 'UPS 2nd Day Air',
                'totalCharges' => 35.00,
                'currencyCode' => 'USD',
                'businessDaysInTransit' => 2,
            ],
        ]);

        $response = $this->api->ups->ratesShop->get([
            'originPostalCode' => '90210',
            'originCountry' => 'US',
            'destinationPostalCode' => '10001',
            'destinationCountry' => 'US',
            'weight' => 10.0,
            'weightUnit' => 'LBS',
        ]);

        $this->assertCount(2, $response->data);
        $this->assertEquals('03', $response->data[0]['serviceCode']);
        $this->assertEquals('UPS Ground', $response->data[0]['serviceName']);
        $this->assertEquals(15.50, $response->data[0]['totalCharges']);
        $this->assertRequestPath('/rates-shop');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGetWithDimensions(): void
    {
        $this->mockListResponse([
            [
                'serviceCode' => '03',
                'serviceName' => 'UPS Ground',
                'totalCharges' => 18.75,
                'currencyCode' => 'USD',
                'billingWeight' => 12.0,
            ],
        ]);

        $response = $this->api->ups->ratesShop->get([
            'originPostalCode' => '90210',
            'originCountry' => 'US',
            'destinationPostalCode' => '10001',
            'destinationCountry' => 'US',
            'weight' => 5.0,
            'length' => 20,
            'width' => 15,
            'height' => 10,
        ]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(12.0, $response->data[0]['billingWeight']);
    }

    public function testGetInternational(): void
    {
        $this->mockListResponse([
            [
                'serviceCode' => '07',
                'serviceName' => 'UPS Worldwide Express',
                'totalCharges' => 125.00,
                'currencyCode' => 'USD',
                'businessDaysInTransit' => 3,
            ],
        ]);

        $response = $this->api->ups->ratesShop->get([
            'originPostalCode' => '90210',
            'originCountry' => 'US',
            'destinationPostalCode' => 'SW1A 1AA',
            'destinationCountry' => 'GB',
            'weight' => 5.0,
        ]);

        $this->assertCount(1, $response->data);
        $this->assertEquals('UPS Worldwide Express', $response->data[0]['serviceName']);
    }

    public function testGetReturnsBaseResponse(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->ups->ratesShop->get([
            'originPostalCode' => '00000',
            'destinationPostalCode' => '99999',
            'weight' => 1.0,
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }

    public function testGetWithResidentialFlag(): void
    {
        $this->mockListResponse([
            [
                'serviceCode' => '03',
                'serviceName' => 'UPS Ground',
                'totalCharges' => 18.50,
                'residentialSurcharge' => 3.00,
            ],
        ]);

        $response = $this->api->ups->ratesShop->get([
            'originPostalCode' => '90210',
            'destinationPostalCode' => '10001',
            'weight' => 5.0,
            'residential' => true,
        ]);

        $this->assertEquals(18.50, $response->data[0]['totalCharges']);
        $this->assertEquals(3.00, $response->data[0]['residentialSurcharge']);
    }
}
