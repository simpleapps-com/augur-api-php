<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Vmi\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for WarehouseResource.
 *
 * @covers \AugurApi\Services\Vmi\Resources\WarehouseResource
 */
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
        $this->assertEquals(1, $response->data[0]['warehouseUid']);
        $this->assertEquals('Warehouse A', $response->data[0]['name']);
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
            'name' => 'New Warehouse',
            'active' => true,
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

        $this->assertTrue($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/warehouse/1');
    }

    public function testGetAvailability(): void
    {
        $this->mockListResponse([
            ['productId' => 'PROD001', 'available' => 100, 'reserved' => 10],
            ['productId' => 'PROD002', 'available' => 50, 'reserved' => 5],
        ]);

        $response = $this->api->vmi->warehouse->getAvailability(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('PROD001', $response->data[0]['productId']);
        $this->assertEquals(100, $response->data[0]['available']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/warehouse/1/availability');
    }

    public function testGetAvailabilityWithParams(): void
    {
        $this->mockListResponse([
            ['productId' => 'PROD001', 'available' => 100],
        ]);

        $response = $this->api->vmi->warehouse->getAvailability(1, ['productId' => 'PROD001']);

        $this->assertCount(1, $response->data);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testReceive(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'receiptId' => 'REC001',
            'itemsReceived' => 25,
        ]);

        $response = $this->api->vmi->warehouse->receive(1, [
            'productId' => 'PROD001',
            'quantity' => 25,
        ]);

        $this->assertEquals('REC001', $response->data['receiptId']);
        $this->assertEquals(25, $response->data['itemsReceived']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/warehouse/1/receive');
    }

    public function testAdjust(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'adjustmentId' => 'ADJ001',
            'newQuantity' => 75,
        ]);

        $response = $this->api->vmi->warehouse->adjust(1, [
            'productId' => 'PROD001',
            'adjustmentQty' => -25,
            'reason' => 'Damage',
        ]);

        $this->assertEquals('ADJ001', $response->data['adjustmentId']);
        $this->assertEquals(75, $response->data['newQuantity']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/warehouse/1/adjust');
    }

    public function testTransfer(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'transferId' => 'TRN001',
            'destinationWarehouseUid' => 2,
            'itemsTransferred' => 50,
        ]);

        $response = $this->api->vmi->warehouse->transfer(1, [
            'destinationWarehouseUid' => 2,
            'productId' => 'PROD001',
            'quantity' => 50,
        ]);

        $this->assertEquals('TRN001', $response->data['transferId']);
        $this->assertEquals(50, $response->data['itemsTransferred']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/warehouse/1/transfer');
    }

    public function testUsage(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'usageId' => 'USG001',
            'itemsUsed' => 10,
        ]);

        $response = $this->api->vmi->warehouse->usage(1, [
            'productId' => 'PROD001',
            'quantity' => 10,
            'reason' => 'Production',
        ]);

        $this->assertEquals('USG001', $response->data['usageId']);
        $this->assertEquals(10, $response->data['itemsUsed']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/warehouse/1/usage');
    }

    public function testEnable(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'active' => true,
        ]);

        $response = $this->api->vmi->warehouse->enable(1);

        $this->assertTrue($response->data['active']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/warehouse/1/enable');
    }

    public function testEnableWithData(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'active' => false,
        ]);

        $response = $this->api->vmi->warehouse->enable(1, ['active' => false]);

        $this->assertFalse($response->data['active']);
    }

    public function testGetReplenish(): void
    {
        $this->mockListResponse([
            ['productId' => 'PROD001', 'currentQty' => 5, 'reorderQty' => 50],
            ['productId' => 'PROD002', 'currentQty' => 3, 'reorderQty' => 30],
        ]);

        $response = $this->api->vmi->warehouse->getReplenish(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('PROD001', $response->data[0]['productId']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/warehouse/1/replenish');
    }

    public function testGetReplenishWithParams(): void
    {
        $this->mockListResponse([
            ['productId' => 'PROD001', 'currentQty' => 5, 'reorderQty' => 50],
        ]);

        $response = $this->api->vmi->warehouse->getReplenish(1, ['belowMin' => true]);

        $this->assertCount(1, $response->data);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreateReplenish(): void
    {
        $this->mockResponse([
            'warehouseUid' => 1,
            'replenishId' => 'REP001',
            'itemsRequested' => 5,
        ]);

        $response = $this->api->vmi->warehouse->createReplenish(1, [
            'items' => [
                ['productId' => 'PROD001', 'quantity' => 50],
            ],
        ]);

        $this->assertEquals('REP001', $response->data['replenishId']);
        $this->assertEquals(5, $response->data['itemsRequested']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/warehouse/1/replenish');
    }

    public function testListUsers(): void
    {
        $this->mockListResponse([
            ['usersId' => 1, 'username' => 'user1', 'role' => 'admin'],
            ['usersId' => 2, 'username' => 'user2', 'role' => 'operator'],
        ]);

        $response = $this->api->vmi->warehouse->listUsers(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['usersId']);
        $this->assertEquals('user1', $response->data[0]['username']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/warehouse/1/users');
    }

    public function testListUsersWithParams(): void
    {
        $this->mockListResponse([
            ['usersId' => 1, 'username' => 'user1', 'role' => 'admin'],
        ]);

        $response = $this->api->vmi->warehouse->listUsers(1, ['role' => 'admin']);

        $this->assertCount(1, $response->data);
    }

    public function testGetUser(): void
    {
        $this->mockResponse([
            'usersId' => 1,
            'username' => 'user1',
            'role' => 'admin',
            'email' => 'user1@example.com',
        ]);

        $response = $this->api->vmi->warehouse->getUser(1, 1);

        $this->assertEquals(1, $response->data['usersId']);
        $this->assertEquals('user1', $response->data['username']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/warehouse/1/users/1');
    }

    public function testCreateUser(): void
    {
        $this->mockResponse([
            'usersId' => 3,
            'username' => 'newuser',
            'role' => 'operator',
        ]);

        $response = $this->api->vmi->warehouse->createUser(1, [
            'username' => 'newuser',
            'role' => 'operator',
        ]);

        $this->assertEquals(3, $response->data['usersId']);
        $this->assertEquals('newuser', $response->data['username']);
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

        $response = $this->api->vmi->warehouse->updateUser(1, 1, [
            'role' => 'manager',
        ]);

        $this->assertEquals('manager', $response->data['role']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/warehouse/1/users/1');
    }

    public function testDeleteUser(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->vmi->warehouse->deleteUser(1, 1);

        $this->assertTrue($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/warehouse/1/users/1');
    }
}
