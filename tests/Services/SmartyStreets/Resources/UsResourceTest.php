<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\SmartyStreets\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for SmartyStreets UsResource.
 */
final class UsResourceTest extends AugurApiTestCase
{
    public function testLookup(): void
    {
        $this->mockResponse([
            'street' => '1600 Pennsylvania Ave NW',
            'city' => 'Washington',
            'state' => 'DC',
            'zipcode' => '20500',
            'plus4Code' => '0004',
            'deliveryPoint' => '00',
            'valid' => true,
            'latitude' => 38.8977,
            'longitude' => -77.0365,
        ]);

        $response = $this->api->smartyStreets->us->lookup([
            'street' => '1600 Pennsylvania Ave',
            'city' => 'Washington',
            'state' => 'DC',
        ]);

        $this->assertEquals('1600 Pennsylvania Ave NW', $response->data['street']);
        $this->assertEquals('Washington', $response->data['city']);
        $this->assertEquals('DC', $response->data['state']);
        $this->assertEquals('20500', $response->data['zipcode']);
        $this->assertTrue($response->data['valid']);
        $this->assertRequestPath('/us/lookup');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testLookupWithZipcode(): void
    {
        $this->mockResponse([
            'street' => '350 5th Ave',
            'city' => 'New York',
            'state' => 'NY',
            'zipcode' => '10118',
            'valid' => true,
        ]);

        $response = $this->api->smartyStreets->us->lookup([
            'street' => '350 5th Ave',
            'zipcode' => '10118',
        ]);

        $this->assertEquals('350 5th Ave', $response->data['street']);
        $this->assertEquals('New York', $response->data['city']);
        $this->assertEquals('10118', $response->data['zipcode']);
        $this->assertTrue($response->data['valid']);
    }

    public function testLookupInvalidAddress(): void
    {
        $this->mockResponse([
            'street' => null,
            'city' => null,
            'state' => null,
            'zipcode' => null,
            'valid' => false,
            'errorMessage' => 'Address not found',
        ]);

        $response = $this->api->smartyStreets->us->lookup([
            'street' => '123 Fake Street',
            'city' => 'Nowhere',
            'state' => 'XX',
        ]);

        $this->assertFalse($response->data['valid']);
        $this->assertEquals('Address not found', $response->data['errorMessage']);
    }

    public function testLookupReturnsBaseResponse(): void
    {
        $this->mockResponse([
            'valid' => true,
            'street' => '123 Main St',
        ]);

        $response = $this->api->smartyStreets->us->lookup([
            'street' => '123 Main St',
            'zipcode' => '12345',
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertIsArray($response->data);
    }

    public function testLookupWithSecondaryAddress(): void
    {
        $this->mockResponse([
            'street' => '123 Main St',
            'secondary' => 'Apt 4B',
            'city' => 'Anytown',
            'state' => 'CA',
            'zipcode' => '90210',
            'valid' => true,
        ]);

        $response = $this->api->smartyStreets->us->lookup([
            'street' => '123 Main St',
            'secondary' => 'Apt 4B',
            'city' => 'Anytown',
            'state' => 'CA',
        ]);

        $this->assertEquals('Apt 4B', $response->data['secondary']);
        $this->assertTrue($response->data['valid']);
    }
}
