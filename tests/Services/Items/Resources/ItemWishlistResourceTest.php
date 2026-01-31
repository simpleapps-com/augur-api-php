<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ItemWishlistResource.
 *
 * @covers \AugurApi\Services\Items\Resources\ItemWishlistResource
 */
final class ItemWishlistResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['itemWishlistHdrUid' => 1, 'name' => 'My Wishlist'],
            ['itemWishlistHdrUid' => 2, 'name' => 'Work Items'],
        ]);

        $response = $this->api->items->itemWishlist->list(12345);

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['itemWishlistHdrUid']);
        $this->assertEquals('My Wishlist', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-wishlist/12345');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['itemWishlistHdrUid' => 1, 'name' => 'My Wishlist'],
        ], 10);

        $response = $this->api->items->itemWishlist->list(12345, ['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(10, $response->total);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreate(): void
    {
        $this->mockResponse(['itemWishlistHdrUid' => 3, 'name' => 'New Wishlist']);

        $response = $this->api->items->itemWishlist->create(12345, ['name' => 'New Wishlist']);

        $this->assertEquals(3, $response->data['itemWishlistHdrUid']);
        $this->assertEquals('New Wishlist', $response->data['name']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/item-wishlist/12345');
    }

    public function testGetHdr(): void
    {
        $this->mockListResponse([
            ['itemWishlistLineUid' => 1, 'invMastUid' => 100],
            ['itemWishlistLineUid' => 2, 'invMastUid' => 101],
        ]);

        $response = $this->api->items->itemWishlist->getHdr(12345, 1);

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['itemWishlistLineUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-wishlist/12345/hdr/1');
    }

    public function testCreateHdr(): void
    {
        $this->mockResponse(['itemWishlistLineUid' => 3, 'invMastUid' => 102]);

        $response = $this->api->items->itemWishlist->createHdr(12345, 1, ['invMastUid' => 102, 'qty' => 5]);

        $this->assertEquals(3, $response->data['itemWishlistLineUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/item-wishlist/12345/hdr/1');
    }

    public function testUpdateHdr(): void
    {
        $this->mockResponse(['itemWishlistHdrUid' => 1, 'name' => 'Updated Wishlist']);

        $response = $this->api->items->itemWishlist->updateHdr(12345, 1, ['name' => 'Updated Wishlist']);

        $this->assertEquals('Updated Wishlist', $response->data['name']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/item-wishlist/12345/hdr/1');
    }

    public function testDeleteHdr(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->items->itemWishlist->deleteHdr(12345, 1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/item-wishlist/12345/hdr/1');
    }

    public function testDeleteLine(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->items->itemWishlist->deleteLine(12345, 1, 10);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/item-wishlist/12345/hdr/1/line/10');
    }
}
