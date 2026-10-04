<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Vmi\Resources;

use AugurApi\Services\Vmi\Resources\WarehouseResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for WarehouseResource.
 */
#[CoversClass(WarehouseResource::class)]
final class WarehouseResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['warehouseUid' => 1, 'name' => 'Warehouse A', 'active' => true],
            ['warehouseUid' => 2, 'name' => 'Warehouse B', 'active' => true],
        ]);

        $response = $this->api->vmi->warehouse->list();

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1, $data[0]['warehouseUid']);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Warehouse A', $data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/warehouse');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['warehouseUid' => 1, 'name' => 'Warehouse A'],
        ], 50);

        $response = $this->api->vmi->warehouse->list(['active' => true, 'limit' => 25]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'name' => 'Warehouse A',
            'active' => true,
            'address' => '123 Storage Blvd',
        ]);

        $response = $this->api->vmi->warehouse->get(1);

        $this->assertEquals(1, $response->data['warehouseUid']);
        $this->assertEquals('Warehouse A', $response->data['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/warehouse/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'warehouseUid' => 3,
            'name' => 'New Warehouse',
            'active' => true,
        ]);

        $response = $this->api->vmi->warehouse->create([
            'customerId' => 100,
            'warehouseName' => 'New Warehouse',
            'warehouseDesc' => 'Main',
        ]);

        $this->assertEquals(3, $response->data['warehouseUid']);
        $this->assertEquals('New Warehouse', $response->data['name']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/warehouse');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'name' => 'Updated Warehouse',
        ]);

        $response = $this->api->vmi->warehouse->update(1, [
            'name' => 'Updated Warehouse',
        ]);

        $this->assertEquals('Updated Warehouse', $response->data['name']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/warehouse/1');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->vmi->warehouse->delete(1);

        $this->assertIsArray($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/warehouse/1');
    }

    public function testGetAvailability(): void
    {
        $this->mockListResponse([
            ['productId' => 'PROD001', 'available' => 100, 'reserved' => 10],
            ['productId' => 'PROD002', 'available' => 50, 'reserved' => 5],
        ]);

        $response = $this->api->vmi->warehouse->listAvailability(1);

        $this->assertCount(2, self::arrayAt($response->data));

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('PROD001', $data[0]['productId']);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(100, $data[0]['available']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/warehouse/1/availability');
    }

    public function testGetAvailabilityWithParams(): void
    {
        $this->mockListResponse([
            ['productId' => 'PROD001', 'available' => 100],
        ]);

        $response = $this->api->vmi->warehouse->listAvailability(1, ['productId' => 'PROD001']);

        $this->assertCount(1, self::arrayAt($response->data));
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testReceive(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 1000, 'qtyReceived' => 25],
        ]);

        $response = $this->api->vmi->warehouse->createReceive(1, [
            'items' => [
                ['invMastUid' => 1000, 'invProfileLineType' => 'products', 'qtyReceived' => 25.0],
            ],
        ]);

        $this->assertEquals(1000, self::at($response->data, 0, 'invMastUid'));
        $this->assertEquals(25, self::at($response->data, 0, 'qtyReceived'));
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/warehouse/1/receive');
    }

    public function testAdjust(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 1000, 'qtyAdjusted' => -25],
        ]);

        $response = $this->api->vmi->warehouse->createAdjust(1, [
            'items' => [
                ['invMastUid' => 1000, 'invProfileLineType' => 'products', 'qtyAdjusted' => -25.0],
            ],
        ]);

        $this->assertEquals(1000, self::at($response->data, 0, 'invMastUid'));
        $this->assertEquals(-25, self::at($response->data, 0, 'qtyAdjusted'));
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/warehouse/1/adjust');
    }

    public function testUsage(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'usageId' => 'USG001',
            'itemsUsed' => 10,
        ]);

        $response = $this->api->vmi->warehouse->createUsage(1, [
            'jobDescription' => 'Production',
            'usageItems' => [
                ['invMastUid' => 1000, 'qtyUsed' => 10.0],
            ],
        ]);

        $this->assertEquals('USG001', self::at($response->data, 'usageId'));
        $this->assertEquals(10, self::at($response->data, 'itemsUsed'));
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/warehouse/1/usage');
    }

    public function testEnable(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'active' => true,
        ]);

        $response = $this->api->vmi->warehouse->updateEnable(1);

        $this->assertTrue(self::at($response->data, 'active'));
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/warehouse/1/enable');
    }

    public function testEnableWithData(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'active' => false,
        ]);

        $response = $this->api->vmi->warehouse->updateEnable(1, ['active' => false]);

        $this->assertFalse(self::at($response->data, 'active'));
    }

    public function testGetReplenish(): void
    {
        $this->mockListResponse([
            ['productId' => 'PROD001', 'currentQty' => 5, 'reorderQty' => 50],
            ['productId' => 'PROD002', 'currentQty' => 3, 'reorderQty' => 30],
        ]);

        $response = $this->api->vmi->warehouse->listReplenish(1);

        $this->assertCount(2, self::arrayAt($response->data));

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('PROD001', $data[0]['productId']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/warehouse/1/replenish');
    }

    public function testGetReplenishWithParams(): void
    {
        $this->mockListResponse([
            ['productId' => 'PROD001', 'currentQty' => 5, 'reorderQty' => 50],
        ]);

        $response = $this->api->vmi->warehouse->listReplenish(1, ['belowMin' => true]);

        $this->assertCount(1, self::arrayAt($response->data));
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListUsers(): void
    {
        $this->mockListResponse([
            ['usersId' => 1, 'username' => 'user1', 'role' => 'admin'],
            ['usersId' => 2, 'username' => 'user2', 'role' => 'operator'],
        ]);

        $response = $this->api->vmi->warehouse->listUsers(1);

        $this->assertCount(2, self::arrayAt($response->data));

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1, $data[0]['usersId']);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('user1', $data[0]['username']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/warehouse/1/users');
    }

    public function testListUsersWithParams(): void
    {
        $this->mockListResponse([
            ['usersId' => 1, 'username' => 'user1', 'role' => 'admin'],
        ]);

        $response = $this->api->vmi->warehouse->listUsers(1, ['role' => 'admin']);

        $this->assertCount(1, self::arrayAt($response->data));
    }

    public function testGetUser(): void
    {
        $this->mockResponse([
            'usersId' => 1,
            'username' => 'user1',
            'role' => 'admin',
            'email' => 'user1@example.com',
        ]);

        $response = $this->api->vmi->warehouse->getUsers(1, 1);

        $this->assertEquals(1, self::at($response->data, 'usersId'));
        $this->assertEquals('user1', self::at($response->data, 'username'));
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/warehouse/1/users/1');
    }

    public function testCreateUser(): void
    {
        $this->mockResponse([
            'usersId' => 3,
            'warehouseUid' => 1,
        ]);

        $response = $this->api->vmi->warehouse->createUsers(1, [
            'usersId' => 3,
        ]);

        $this->assertEquals(3, self::at($response->data, 'usersId'));
        $this->assertEquals(1, self::at($response->data, 'warehouseUid'));
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/warehouse/1/users');
    }

    public function testUpdateUser(): void
    {
        $this->mockResponse([
            'usersId' => 1,
            'username' => 'user1',
            'role' => 'manager',
        ]);

        $response = $this->api->vmi->warehouse->updateUsers(1, 1, [
            'role' => 'manager',
        ]);

        $this->assertEquals('manager', self::at($response->data, 'role'));
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/warehouse/1/users/1');
    }

    public function testDeleteUser(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->vmi->warehouse->deleteUsers(1, 1);

        $this->assertIsArray($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/warehouse/1/users/1');
    }
}
