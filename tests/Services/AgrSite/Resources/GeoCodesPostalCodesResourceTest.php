<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for GeoCodesPostalCodesResource.
 */
final class GeoCodesPostalCodesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['geoCodesPostalCodesUid' => 1, 'postalCode' => '12345', 'city' => 'Test City', 'state' => 'TC'],
            ['geoCodesPostalCodesUid' => 2, 'postalCode' => '67890', 'city' => 'Another City', 'state' => 'AC'],
        ]);

        $response = $this->api->agrSite->geoCodesPostalCodes->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('12345', $response->data[0]['postalCode']);
        $this->assertEquals('Test City', $response->data[0]['city']);
        $this->assertRequestPath('/geo-codes-postal-codes');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['geoCodesPostalCodesUid' => 1, 'postalCode' => '12345'],
        ]);

        $response = $this->api->agrSite->geoCodesPostalCodes->list(['limit' => 10, 'state' => 'TC']);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'geoCodesPostalCodesUid' => 1,
            'postalCode' => '12345',
            'city' => 'Test City',
            'state' => 'TC',
            'latitude' => 40.7128,
            'longitude' => -74.0060,
        ]);

        $response = $this->api->agrSite->geoCodesPostalCodes->get(1);

        $this->assertEquals(1, $response->data['geoCodesPostalCodesUid']);
        $this->assertEquals('12345', $response->data['postalCode']);
        $this->assertEquals('Test City', $response->data['city']);
        $this->assertRequestPath('/geo-codes-postal-codes/1');
        $this->assertRequestMethod('GET');
    }
}
