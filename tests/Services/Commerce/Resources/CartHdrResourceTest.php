<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Commerce\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class CartHdrResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['cartHdrUid' => 1, 'userId' => 'user1'],
            ['cartHdrUid' => 2, 'userId' => 'user2'],
        ]);

        $response = $this->api->commerce->cartHdr->list(['userId' => 'user1']);

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['cartHdrUid']);
        $this->assertRequestPath('/cart-hdr/list');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListWithEmptyParams(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->commerce->cartHdr->list();

        $this->assertIsArray($response->data);
        $this->assertRequestPath('/cart-hdr/list');
    }

    public function testLookup(): void
    {
        $this->mockListResponse([
            ['cartHdrUid' => 1, 'status' => 'active'],
        ]);

        $response = $this->api->commerce->cartHdr->lookup(['cartId' => 'CART001']);

        $this->assertCount(1, $response->data);
        $this->assertEquals('active', $response->data[0]['status']);
        $this->assertRequestPath('/cart-hdr/lookup');
        $this->assertRequestMethod('GET');
    }

    public function testLookupWithEmptyParams(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->commerce->cartHdr->lookup();

        $this->assertIsArray($response->data);
    }

    public function testGetAlsoBought(): void
    {
        $this->mockListResponse([
            ['itemId' => 'ITEM001', 'name' => 'Related Product 1'],
            ['itemId' => 'ITEM002', 'name' => 'Related Product 2'],
        ]);

        $response = $this->api->commerce->cartHdr->getAlsoBought(123);

        $this->assertCount(2, $response->data);
        $this->assertEquals('ITEM001', $response->data[0]['itemId']);
        $this->assertRequestPath('/cart-hdr/123/also-bought');
        $this->assertRequestMethod('GET');
    }

    public function testGetAlsoBoughtWithDifferentCartId(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->commerce->cartHdr->getAlsoBought(456);

        $this->assertIsArray($response->data);
        $this->assertRequestPath('/cart-hdr/456/also-bought');
    }
}
