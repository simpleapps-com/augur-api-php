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
        $this->assertEquals('ITEM001', $response->data[0]['itemId']);
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

    public function testDeleteAll(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->commerce->cartLine->deleteAll(123);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/cart-line/123');
        $this->assertRequestMethod('DELETE');
    }

    public function testAdd(): void
    {
        $this->mockResponse([
            'cartHdrUid' => 123,
            'lineNo' => 1,
            'itemId' => 'ITEM001',
            'quantity' => 3,
        ]);

        $response = $this->api->commerce->cartLine->add(123, [
            'itemId' => 'ITEM001',
            'quantity' => 3,
        ]);

        $this->assertEquals('ITEM001', $response->data['itemId']);
        $this->assertEquals(3, $response->data['quantity']);
        $this->assertRequestPath('/cart-line/123/add');
        $this->assertRequestMethod('POST');
    }

    public function testAddWithUnitOfMeasure(): void
    {
        $this->mockResponse([
            'cartHdrUid' => 123,
            'lineNo' => 2,
            'itemId' => 'ITEM002',
            'quantity' => 5,
            'uom' => 'EA',
        ]);

        $response = $this->api->commerce->cartLine->add(123, [
            'itemId' => 'ITEM002',
            'quantity' => 5,
            'uom' => 'EA',
        ]);

        $this->assertEquals('EA', $response->data['uom']);
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'cartHdrUid' => 123,
            'lineNo' => 1,
            'itemId' => 'ITEM001',
            'quantity' => 10,
        ]);

        $response = $this->api->commerce->cartLine->update(123, [
            'lineNo' => 1,
            'quantity' => 10,
        ]);

        $this->assertEquals(10, $response->data['quantity']);
        $this->assertRequestPath('/cart-line/123/update');
        $this->assertRequestMethod('POST');
    }

    public function testDeleteLine(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->commerce->cartLine->deleteLine(123, 1);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/cart-line/123/lines/1');
        $this->assertRequestMethod('DELETE');
    }

    public function testDeleteLineWithDifferentLineNo(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->commerce->cartLine->deleteLine(456, 5);

        $this->assertTrue($response->data);
        $this->assertRequestPath('/cart-line/456/lines/5');
    }
}
