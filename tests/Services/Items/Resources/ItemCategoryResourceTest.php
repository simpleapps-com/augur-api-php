<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Services\Items\Resources\ItemCategoryResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for ItemCategoryResource.
 */
#[CoversClass(ItemCategoryResource::class)]
final class ItemCategoryResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['itemCategoryUid' => 1, 'name' => 'Electronics', 'parentUid' => null],
            ['itemCategoryUid' => 2, 'name' => 'Hardware', 'parentUid' => null],
        ]);

        $response = $this->api->items->itemCategory->list();

        $this->assertCount(2, self::arrayAt($response->data));
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1, $data[0]['itemCategoryUid']);
        $this->assertEquals('Electronics', $data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-category');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['itemCategoryUid' => 1, 'name' => 'Electronics'],
        ], 100);

        $response = $this->api->items->itemCategory->list(['limit' => 25, 'offset' => 0]);

        $this->assertCount(1, self::arrayAt($response->data));
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

        $response = $this->api->items->itemCategory->getLookup();

        $this->assertCount(2, self::arrayAt($response->data));
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Electronics', $data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-category/lookup');
    }

    public function testLookupWithParams(): void
    {
        $this->mockListResponse([
            ['itemCategoryUid' => 1, 'name' => 'Electronics'],
        ]);

        $response = $this->api->items->itemCategory->getLookup(['q' => 'elec', 'limit' => 10]);

        $this->assertCount(1, self::arrayAt($response->data));
    }

    public function testListPrecache(): void
    {
        $this->mockResponse(true);

        $response = $this->api->items->itemCategory->listPrecache(1);

        $this->assertTrue($response->data);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-category/1/precache');
    }
}
