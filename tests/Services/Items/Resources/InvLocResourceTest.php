<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for InvLocResource.
 *
 * @covers \AugurApi\Services\Items\Resources\InvLocResource
 */
final class InvLocResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invLocUid' => 1, 'locationId' => 'WH001', 'invMastUid' => 100],
            ['invLocUid' => 2, 'locationId' => 'WH002', 'invMastUid' => 101],
        ]);

        $response = $this->api->items->invLoc->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['invLocUid']);
        $this->assertEquals('WH001', $response->data[0]['locationId']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-loc');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invLocUid' => 1, 'locationId' => 'WH001'],
        ], 100);

        $response = $this->api->items->invLoc->list(['limit' => 25, 'offset' => 0, 'locationId' => 'WH001']);

        $this->assertCount(1, $response->data);
        $this->assertEquals(100, $response->total);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
