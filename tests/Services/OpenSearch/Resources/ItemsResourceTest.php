<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\OpenSearch\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class ItemsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 1, 'itemId' => 'ITEM001', 'description' => 'Test Product'],
            ['invMastUid' => 2, 'itemId' => 'ITEM002', 'description' => 'Another Product'],
        ]);

        $response = $this->api->openSearch->items->list();

        $this->assertCount(2, self::arrayAt($response->data));

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('ITEM001', $data[0]['itemId']);
        $this->assertRequestPath('/items');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 1, 'itemId' => 'ITEM001'],
        ], 100);

        $response = $this->api->openSearch->items->list([
            'limit' => 1,
            'offset' => 0,
        ]);

        $this->assertCount(1, self::arrayAt($response->data));
        $this->assertEquals(100, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'invMastUid' => 123,
            'itemId' => 'ITEM001',
            'description' => 'Test Product',
            'price' => 99.99,
            'attributes' => [
                'color' => 'Blue',
                'size' => 'Large',
            ],
        ]);

        $response = $this->api->openSearch->items->get(123);

        $this->assertEquals(123, self::at($response->data, 'invMastUid'));
        $this->assertEquals('ITEM001', self::at($response->data, 'itemId'));
        $this->assertEquals('Blue', self::at($response->data, 'attributes', 'color'));
        $this->assertRequestPath('/items/123');
        $this->assertRequestMethod('GET');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'invMastUid' => 123,
            'itemId' => 'ITEM001',
            'description' => 'Updated Product Description',
            'updated' => true,
        ]);

        $response = $this->api->openSearch->items->update(123, [
            'description' => 'Updated Product Description',
        ]);

        $this->assertEquals('Updated Product Description', self::at($response->data, 'description'));
        $this->assertTrue(self::at($response->data, 'updated'));
        $this->assertRequestPath('/items/123');
        $this->assertRequestMethod('PUT');
    }

    public function testUpdateWithAttributes(): void
    {
        $this->mockResponse([
            'invMastUid' => 123,
            'itemId' => 'ITEM001',
            'attributes' => ['color' => 'Red'],
        ]);

        $response = $this->api->openSearch->items->update(123, [
            'attributes' => ['color' => 'Red'],
        ]);

        $this->assertEquals('Red', self::at($response->data, 'attributes', 'color'));
    }

    public function testRefreshItem(): void
    {
        $this->mockResponse([
            'invMastUid' => 123,
            'refreshed' => true,
            'timestamp' => '2024-01-15T10:30:00Z',
        ]);

        $response = $this->api->openSearch->items->getRefresh(123);

        $this->assertTrue(self::at($response->data, 'refreshed'));
        $this->assertRequestPath('/items/123/refresh');
        $this->assertRequestMethod('GET');
    }

    public function testRefresh(): void
    {
        $this->mockResponse([
            'status' => 'started',
            'itemsQueued' => 1500,
            'estimatedTime' => '5 minutes',
        ]);

        $response = $this->api->openSearch->items->updateRefresh();

        $this->assertEquals('started', self::at($response->data, 'status'));
        $this->assertEquals(1500, self::at($response->data, 'itemsQueued'));
        $this->assertRequestPath('/items/refresh');
        $this->assertRequestMethod('PUT');
    }

    public function testListEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->openSearch->items->list();

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }
}
