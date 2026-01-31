<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for CategoriesResource.
 *
 * @covers \AugurApi\Services\Items\Resources\CategoriesResource
 */
final class CategoriesResourceTest extends AugurApiTestCase
{
    public function testLookup(): void
    {
        $this->mockListResponse([
            ['itemCategoryUid' => 1, 'name' => 'Electronics'],
            ['itemCategoryUid' => 2, 'name' => 'Hardware'],
        ]);

        $response = $this->api->items->categories->lookup();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['itemCategoryUid']);
        $this->assertEquals('Electronics', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/categories/lookup');
    }

    public function testLookupWithParams(): void
    {
        $this->mockListResponse([
            ['itemCategoryUid' => 1, 'name' => 'Electronics'],
        ]);

        $response = $this->api->items->categories->lookup(['limit' => 10, 'q' => 'elec']);

        $this->assertCount(1, $response->data);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'itemCategoryUid' => 1,
            'name' => 'Electronics',
            'description' => 'Electronic products',
        ]);

        $response = $this->api->items->categories->get(1);

        $this->assertEquals(1, $response->data['itemCategoryUid']);
        $this->assertEquals('Electronics', $response->data['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/categories/1');
    }

    public function testListAttributes(): void
    {
        $this->mockListResponse([
            ['attributeUid' => 1, 'name' => 'Voltage'],
            ['attributeUid' => 2, 'name' => 'Wattage'],
        ]);

        $response = $this->api->items->categories->listAttributes(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Voltage', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/categories/1/attributes');
    }

    public function testListImages(): void
    {
        $this->mockListResponse([
            ['imageUid' => 1, 'url' => 'https://example.com/image1.jpg'],
            ['imageUid' => 2, 'url' => 'https://example.com/image2.jpg'],
        ]);

        $response = $this->api->items->categories->listImages(1);

        $this->assertCount(2, $response->data);
        $this->assertStringContainsString('image1', $response->data[0]['url']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/categories/1/images');
    }

    public function testListItems(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100, 'itemId' => 'ITEM001'],
            ['invMastUid' => 101, 'itemId' => 'ITEM002'],
        ], 50);

        $response = $this->api->items->categories->listItems(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('ITEM001', $response->data[0]['itemId']);
        $this->assertEquals(50, $response->total);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/categories/1/items');
    }

    public function testListItemsWithParams(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100, 'itemId' => 'ITEM001'],
        ], 100);

        $response = $this->api->items->categories->listItems(1, ['limit' => 10, 'offset' => 20]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(100, $response->total);
    }
}
