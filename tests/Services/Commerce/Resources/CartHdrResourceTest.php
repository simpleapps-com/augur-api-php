<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Commerce\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class CartHdrResourceTest extends AugurApiTestCase
{
    public function testListList(): void
    {
        $this->mockListResponse([
            ['cartHdrUid' => 1, 'userId' => 'user1'],
            ['cartHdrUid' => 2, 'userId' => 'user2'],
        ]);

        $response = $this->api->commerce->cartHdr->listList(['userId' => 'user1']);

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1, $data[0]['cartHdrUid']);
        $this->assertRequestPath('/cart-hdr/list');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListListWithEmptyParams(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->commerce->cartHdr->listList();

        $this->assertIsArray($response->data);
        $this->assertRequestPath('/cart-hdr/list');
    }

    public function testGetLookup(): void
    {
        $this->mockListResponse([
            ['cartHdrUid' => 1, 'status' => 'active'],
        ]);

        $response = $this->api->commerce->cartHdr->getLookup(['cartId' => 'CART001']);

        $this->assertCount(1, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('active', $data[0]['status']);
        $this->assertRequestPath('/cart-hdr/lookup');
        $this->assertRequestMethod('GET');
    }

    public function testGetLookupWithEmptyParams(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->commerce->cartHdr->getLookup();

        $this->assertIsArray($response->data);
    }

    public function testListAlsoBought(): void
    {
        $this->mockListResponse([
            ['itemId' => 'ITEM001', 'name' => 'Related Product 1'],
            ['itemId' => 'ITEM002', 'name' => 'Related Product 2'],
        ]);

        $response = $this->api->commerce->cartHdr->listAlsoBought(123);

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('ITEM001', $data[0]['itemId']);
        $this->assertRequestPath('/cart-hdr/123/also-bought');
        $this->assertRequestMethod('GET');
    }

    public function testListAlsoBoughtWithDifferentCartId(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->commerce->cartHdr->listAlsoBought(456);

        $this->assertIsArray($response->data);
        $this->assertRequestPath('/cart-hdr/456/also-bought');
    }
}
