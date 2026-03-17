<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Commerce\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class CartLineResourceTest extends AugurApiTestCase
{
    public function testGet(): void
    {
        $this->mockListResponse([
            ['lineNo' => 1, 'itemId' => 'ITEM001', 'quantity' => 2],
            ['lineNo' => 2, 'itemId' => 'ITEM002', 'quantity' => 1],
        ]);

        $response = $this->api->commerce->cartLine->get(123);

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('ITEM001', $data[0]['itemId']);
        $this->assertRequestPath('/cart-line/123');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testGetEmptyCart(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->commerce->cartLine->get(999);

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
        $this->assertRequestPath('/cart-line/999');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->commerce->cartLine->delete(123);

        $this->assertIsArray($response->data);
        $this->assertTrue($response->data['deleted']);
        $this->assertRequestPath('/cart-line/123');
        $this->assertRequestMethod('DELETE');
    }

    public function testCreateAdd(): void
    {
        $this->mockResponse([
            'cartHdrUid' => 123,
            'lineNo' => 1,
            'itemId' => 'ITEM001',
            'quantity' => 3,
        ]);

        $response = $this->api->commerce->cartLine->createAdd(123, [
            'itemId' => 'ITEM001',
            'quantity' => 3,
        ]);

        $this->assertEquals('ITEM001', $response->data['itemId']);
        $this->assertEquals(3, $response->data['quantity']);
        $this->assertRequestPath('/cart-line/123/add');
        $this->assertRequestMethod('POST');
    }

    public function testCreateUpdate(): void
    {
        $this->mockResponse([
            'cartHdrUid' => 123,
            'lineNo' => 1,
            'itemId' => 'ITEM001',
            'quantity' => 10,
        ]);

        $response = $this->api->commerce->cartLine->createUpdate(123, [
            'lineNo' => 1,
            'quantity' => 10,
        ]);

        $this->assertEquals(10, $response->data['quantity']);
        $this->assertRequestPath('/cart-line/123/update');
        $this->assertRequestMethod('POST');
    }

    public function testDeleteLines(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->commerce->cartLine->deleteLines(123, 1);

        $this->assertIsArray($response->data);
        $this->assertTrue($response->data['deleted']);
        $this->assertRequestPath('/cart-line/123/lines/1');
        $this->assertRequestMethod('DELETE');
    }

    public function testDeleteLinesWithDifferentLineNo(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->commerce->cartLine->deleteLines(456, 5);

        $this->assertIsArray($response->data);
        $this->assertTrue($response->data['deleted']);
        $this->assertRequestPath('/cart-line/456/lines/5');
    }
}
