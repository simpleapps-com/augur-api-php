<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ItemFavoritesResource.
 *
 * @covers \AugurApi\Services\Items\Resources\ItemFavoritesResource
 */
final class ItemFavoritesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100, 'itemId' => 'ITEM001'],
            ['invMastUid' => 101, 'itemId' => 'ITEM002'],
        ]);

        $response = $this->api->items->itemFavorites->list(12345);

        $this->assertCount(2, $response->data);
        $this->assertEquals(100, $response->data[0]['invMastUid']);
        $this->assertEquals('ITEM001', $response->data[0]['itemId']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-favorites/12345');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100, 'itemId' => 'ITEM001'],
        ], 50);

        $response = $this->api->items->itemFavorites->list(12345, ['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreate(): void
    {
        $this->mockResponse(['invMastUid' => 102, 'createdAt' => '2024-01-01T00:00:00Z']);

        $response = $this->api->items->itemFavorites->create(12345, ['invMastUid' => 102]);

        $this->assertEquals(102, $response->data['invMastUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/item-favorites/12345');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['invMastUid' => 100, 'sortOrder' => 5]);

        $response = $this->api->items->itemFavorites->update(12345, 100, ['sortOrder' => 5]);

        $this->assertEquals(5, $response->data['sortOrder']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/item-favorites/12345/100');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->items->itemFavorites->delete(12345, 100);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/item-favorites/12345/100');
    }
}
