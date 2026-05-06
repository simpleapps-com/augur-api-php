<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for PostalCodesXShiptosResource.
 */
final class PostalCodesXShiptosResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['postalCodesXShiptosUid' => 1, 'postalCode' => '90210', 'shipToId' => 'A1'],
            ['postalCodesXShiptosUid' => 2, 'postalCode' => '10001', 'shipToId' => 'B2'],
        ]);

        $response = $this->api->agrSite->postalCodesXShiptos->list();

        $this->assertCount(2, $response->data);
        $this->assertRequestPath('/postal-codes-x-shiptos');
        $this->assertRequestMethod('GET');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['postalCodesXShiptosUid' => 1, 'postalCode' => '90210'],
        ]);

        $response = $this->api->agrSite->postalCodesXShiptos->list(['limit' => 10]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'postalCodesXShiptosUid' => 1,
            'postalCode' => '90210',
            'shipToId' => 'A1',
        ]);

        $response = $this->api->agrSite->postalCodesXShiptos->get(1);

        $this->assertEquals(1, $response->data['postalCodesXShiptosUid']);
        $this->assertRequestPath('/postal-codes-x-shiptos/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'postalCodesXShiptosUid' => 3,
            'postalCode' => '94103',
            'shipToId' => 'C3',
        ], 201);

        $response = $this->api->agrSite->postalCodesXShiptos->create([
            'postalCode' => '94103',
            'shipToId' => 'C3',
        ]);

        $this->assertEquals(3, $response->data['postalCodesXShiptosUid']);
        $this->assertRequestPath('/postal-codes-x-shiptos');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'postalCodesXShiptosUid' => 1,
            'shipToId' => 'updated',
        ]);

        $response = $this->api->agrSite->postalCodesXShiptos->update(
            1,
            ['shipToId' => 'updated'],
        );

        $this->assertEquals('updated', $response->data['shipToId']);
        $this->assertRequestPath('/postal-codes-x-shiptos/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->agrSite->postalCodesXShiptos->delete(1);

        $this->assertTrue($response->data['deleted']);
        $this->assertRequestPath('/postal-codes-x-shiptos/1');
        $this->assertRequestMethod('DELETE');
    }
}
