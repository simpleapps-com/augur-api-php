<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for P21Resource.
 *
 * @covers \AugurApi\Services\Items\Resources\P21Resource
 */
final class P21ResourceTest extends AugurApiTestCase
{
    public function testListInvMast(): void
    {
        $this->mockListResponse([
            ['inv_mast_uid' => 100, 'item_id' => 'ITEM001', 'item_desc' => 'Test Item 1'],
            ['inv_mast_uid' => 101, 'item_id' => 'ITEM002', 'item_desc' => 'Test Item 2'],
        ]);

        $response = $this->api->items->p21->listInvMast();

        $this->assertCount(2, $response->data);
        $this->assertEquals(100, $response->data[0]['inv_mast_uid']);
        $this->assertEquals('ITEM001', $response->data[0]['item_id']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/p21/inv-mast');
    }

    public function testListInvMastWithParams(): void
    {
        $this->mockListResponse([
            ['inv_mast_uid' => 100, 'item_id' => 'ITEM001'],
        ], 1000);

        $response = $this->api->items->p21->listInvMast(['limit' => 50, 'offset' => 0, 'modifiedSince' => '2024-01-01']);

        $this->assertCount(1, $response->data);
        $this->assertEquals(1000, $response->total);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
