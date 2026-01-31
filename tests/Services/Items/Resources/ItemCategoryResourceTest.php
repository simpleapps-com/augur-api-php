<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ItemCategoryResource.
 *
 * @covers \AugurApi\Services\Items\Resources\ItemCategoryResource
 */
final class ItemCategoryResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['itemCategoryUid' => 1, 'name' => 'Electronics', 'parentUid' => null],
            ['itemCategoryUid' => 2, 'name' => 'Hardware', 'parentUid' => null],
        ]);

        $response = $this->api->items->itemCategory->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['itemCategoryUid']);
        $this->assertEquals('Electronics', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-category');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['itemCategoryUid' => 1, 'name' => 'Electronics'],
        ], 100);

        $response = $this->api->items->itemCategory->list(['limit' => 25, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(100, $response->total);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testLookup(): void
    {
        $this->mockListResponse([
            ['itemCategoryUid' => 1, 'name' => 'Electronics'],
            ['itemCategoryUid' => 2, 'name' => 'Electrical'],
        ]);

        $response = $this->api->items->itemCategory->lookup();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Electronics', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-category/lookup');
    }

    public function testLookupWithParams(): void
    {
        $this->mockListResponse([
            ['itemCategoryUid' => 1, 'name' => 'Electronics'],
        ]);

        $response = $this->api->items->itemCategory->lookup(['q' => 'elec', 'limit' => 10]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'itemCategoryUid' => 1,
            'name' => 'Electronics',
            'description' => 'Electronic products and components',
            'parentUid' => null,
        ]);

        $response = $this->api->items->itemCategory->get(1);

        $this->assertEquals(1, $response->data['itemCategoryUid']);
        $this->assertEquals('Electronics', $response->data['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-category/1');
    }

    public function testListDoc(): void
    {
        $this->mockListResponse([
            ['docUid' => 1, 'docType' => 'pdf', 'name' => 'Spec Sheet'],
            ['docUid' => 2, 'docType' => 'image', 'name' => 'Category Image'],
        ]);

        $response = $this->api->items->itemCategory->listDoc(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Spec Sheet', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-category/1/doc');
    }
}
