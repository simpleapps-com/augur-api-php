<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Core\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for CashDrawerResource.
 *
 * @covers \AugurApi\Services\P21Core\Resources\CashDrawerResource
 */
final class CashDrawerResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['cashDrawerUid' => 1, 'drawerName' => 'Drawer 1', 'locationId' => 100],
            ['cashDrawerUid' => 2, 'drawerName' => 'Drawer 2', 'locationId' => 200],
        ]);

        $response = $this->api->p21Core->cashDrawer->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['cashDrawerUid']);
        $this->assertEquals('Drawer 1', $response->data[0]['drawerName']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/cash_drawer');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['cashDrawerUid' => 1, 'drawerName' => 'Drawer 1'],
        ], 50);

        $response = $this->api->p21Core->cashDrawer->list(['locationId' => 100, 'limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'cashDrawerUid' => 1,
            'drawerName' => 'Drawer 1',
            'locationId' => 100,
            'currentBalance' => 500.00,
            'status' => 'open',
        ]);

        $response = $this->api->p21Core->cashDrawer->get(1);

        $this->assertEquals(1, $response->data['cashDrawerUid']);
        $this->assertEquals('Drawer 1', $response->data['drawerName']);
        $this->assertEquals(500.00, $response->data['currentBalance']);
        $this->assertEquals('open', $response->data['status']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/cash_drawer/1');
    }
}
