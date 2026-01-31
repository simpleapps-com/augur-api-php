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
        $this->mockResponse([
            'rates' => [
                [
                    'serviceCode' => '03',
                    'serviceName' => 'UPS Ground',
                    'totalCharge' => 15.50,
                    'currency' => 'USD',
                    'deliveryDays' => 5,
                ],
                [
                    'serviceCode' => '02',
                    'serviceName' => 'UPS 2nd Day Air',
                    'totalCharge' => 35.00,
                    'currency' => 'USD',
                    'deliveryDays' => 2,
                ],
            ],
            'billingWeight' => 10.0,
        ]);

        $response = $this->api->ups->ratesShop->get([
            'originPostalCode' => '90210',
            'originCountry' => 'US',
            'destinationPostalCode' => '10001',
            'destinationCountry' => 'US',
            'weight' => 10.0,
            'weightUnit' => 'LBS',
        ]);

        $this->assertCount(2, $response->data['rates']);
        $this->assertEquals('03', $response->data['rates'][0]['serviceCode']);
        $this->assertEquals('UPS Ground', $response->data['rates'][0]['serviceName']);
        $this->assertEquals(15.50, $response->data['rates'][0]['totalCharge']);
        $this->assertRequestPath('/rates-shop');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGetWithDimensions(): void
    {
        $this->mockResponse([
            'rates' => [
                [
                    'serviceCode' => '03',
                    'serviceName' => 'UPS Ground',
                    'totalCharge' => 18.75,
                    'currency' => 'USD',
                ],
            ],
            'billingWeight' => 12.0,
            'dimWeight' => 12.0,
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

        $this->assertEquals(12.0, $response->data['dimWeight']);
        $this->assertEquals(12.0, $response->data['billingWeight']);
    }

    public function testGetInternational(): void
    {
        $this->mockResponse([
            'rates' => [
                [
                    'serviceCode' => '07',
                    'serviceName' => 'UPS Worldwide Express',
                    'totalCharge' => 125.00,
                    'currency' => 'USD',
                    'deliveryDays' => 3,
                ],
            ],
            'international' => true,
        ]);

        $response = $this->api->ups->ratesShop->get([
            'originPostalCode' => '90210',
            'originCountry' => 'US',
            'destinationPostalCode' => 'SW1A 1AA',
            'destinationCountry' => 'GB',
            'weight' => 5.0,
        ]);

        $this->assertTrue($response->data['international']);
        $this->assertEquals('UPS Worldwide Express', $response->data['rates'][0]['serviceName']);
    }

    public function testGetReturnsBaseResponse(): void
    {
        $this->mockResponse([
            'rates' => [],
            'message' => 'No rates available for this route',
        ]);

        $response = $this->api->ups->ratesShop->get([
            'originPostalCode' => '00000',
            'destinationPostalCode' => '99999',
            'weight' => 1.0,
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data['rates']);
    }

    public function testGetWithResidentialFlag(): void
    {
        $this->mockResponse([
            'rates' => [
                [
                    'serviceCode' => '03',
                    'serviceName' => 'UPS Ground',
                    'totalCharge' => 18.50,
                    'residentialSurcharge' => 3.00,
                ],
            ],
        ]);

        $response = $this->api->ups->ratesShop->get([
            'originPostalCode' => '90210',
            'destinationPostalCode' => '10001',
            'weight' => 5.0,
            'residential' => true,
        ]);

        $this->assertEquals(18.50, $response->data['rates'][0]['totalCharge']);
        $this->assertEquals(3.00, $response->data['rates'][0]['residentialSurcharge']);
    }
}
