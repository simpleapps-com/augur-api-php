<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Core\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AddressResource.
 *
 * @covers \AugurApi\Services\P21Core\Resources\AddressResource
 */
final class AddressResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['addressId' => 1, 'street' => '123 Main St', 'city' => 'New York'],
            ['addressId' => 2, 'street' => '456 Oak Ave', 'city' => 'Los Angeles'],
        ]);

        $response = $this->api->p21Core->address->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['addressId']);
        $this->assertEquals('123 Main St', $response->data[0]['street']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/address');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['addressId' => 1, 'street' => '123 Main St'],
        ], 100);

        $response = $this->api->p21Core->address->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(100, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'addressId' => 1,
            'street' => '123 Main St',
            'city' => 'New York',
            'state' => 'NY',
            'zipCode' => '10001',
        ]);

        $response = $this->api->p21Core->address->get(1);

        $this->assertEquals(1, $response->data['addressId']);
        $this->assertEquals('123 Main St', $response->data['street']);
        $this->assertEquals('NY', $response->data['state']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/address/1');
    }

    public function testGetCorpAddress(): void
    {
        $this->mockListResponse([
            ['corpAddressId' => 1, 'name' => 'Headquarters'],
            ['corpAddressId' => 2, 'name' => 'Branch Office'],
        ]);

        $response = $this->api->p21Core->address->getCorpAddress(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Headquarters', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/address/1/corp-address');
    }

    public function testGetCorpAddressWithParams(): void
    {
        $this->mockListResponse([
            ['corpAddressId' => 1, 'name' => 'Headquarters'],
        ]);

        $response = $this->api->p21Core->address->getCorpAddress(1, ['active' => true]);

        $this->assertCount(1, $response->data);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGetDefault(): void
    {
        $this->mockResponse([
            'addressId' => 1,
            'street' => '123 Main St',
            'isDefault' => true,
        ]);

        $response = $this->api->p21Core->address->getDefault(1);

        $this->assertEquals(1, $response->data['addressId']);
        $this->assertTrue($response->data['isDefault']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/address/1/default');
    }

    public function testEnable(): void
    {
        $this->mockResponse([
            'addressId' => 1,
            'enabled' => true,
        ]);

        $response = $this->api->p21Core->address->enable(1);

        $this->assertTrue($response->data['enabled']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/address/1/enable');
    }

    public function testEnableWithParams(): void
    {
        $this->mockResponse([
            'addressId' => 1,
            'enabled' => false,
        ]);

        $response = $this->api->p21Core->address->enable(1, ['enabled' => false]);

        $this->assertFalse($response->data['enabled']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testRefresh(): void
    {
        $this->mockResponse([
            'success' => true,
            'message' => 'Address data refresh triggered',
        ]);

        $response = $this->api->p21Core->address->refresh();

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/address/refresh');
    }
}
