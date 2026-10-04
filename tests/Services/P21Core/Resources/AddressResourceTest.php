<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Core\Resources;

use AugurApi\Services\P21Core\Resources\AddressResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for AddressResource.
 */
#[CoversClass(AddressResource::class)]
final class AddressResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['addressId' => 1, 'street' => '123 Main St', 'city' => 'New York'],
            ['addressId' => 2, 'street' => '456 Oak Ave', 'city' => 'Los Angeles'],
        ]);

        $response = $this->api->p21Core->address->list();

        $this->assertCount(2, self::arrayAt($response->data));

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1, $data[0]['addressId']);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('123 Main St', $data[0]['street']);
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

        $this->assertCount(1, self::arrayAt($response->data));
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

        $this->assertEquals(1, self::at($response->data, 'addressId'));
        $this->assertEquals('123 Main St', self::at($response->data, 'street'));
        $this->assertEquals('NY', self::at($response->data, 'state'));
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/address/1');
    }

    public function testGetCorpAddress(): void
    {
        $this->mockListResponse([
            ['corpAddressId' => 1, 'name' => 'Headquarters'],
            ['corpAddressId' => 2, 'name' => 'Branch Office'],
        ]);

        $response = $this->api->p21Core->address->listCorpAddress(1);

        $this->assertCount(2, self::arrayAt($response->data));

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Headquarters', $data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/address/1/corp-address');
    }

    public function testGetCorpAddressWithParams(): void
    {
        $this->mockListResponse([
            ['corpAddressId' => 1, 'name' => 'Headquarters'],
        ]);

        $response = $this->api->p21Core->address->listCorpAddress(1, ['active' => true]);

        $this->assertCount(1, self::arrayAt($response->data));
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

        $response = $this->api->p21Core->address->listDefault(1);

        $this->assertEquals(1, self::at($response->data, 'addressId'));
        $this->assertTrue(self::at($response->data, 'isDefault'));
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/address/1/default');
    }

    public function testEnable(): void
    {
        $this->mockResponse([
            'addressId' => 1,
            'enabled' => true,
        ]);

        $response = $this->api->p21Core->address->getEnable(1);

        $this->assertTrue(self::at($response->data, 'enabled'));
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/address/1/enable');
    }

    public function testEnableWithParams(): void
    {
        $this->mockResponse([
            'addressId' => 1,
            'enabled' => false,
        ]);

        $response = $this->api->p21Core->address->getEnable(1, ['enabled' => false]);

        $this->assertFalse(self::at($response->data, 'enabled'));
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
