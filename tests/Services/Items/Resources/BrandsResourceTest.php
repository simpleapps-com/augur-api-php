<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for BrandsResource.
 *
 * @covers \AugurApi\Services\Items\Resources\BrandsResource
 */
final class BrandsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['brandsUid' => 1, 'brandName' => 'Brand A'],
            ['brandsUid' => 2, 'brandName' => 'Brand B'],
        ]);

        $response = $this->api->items->brands->list();

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Brand A', $data[0]['brandName']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/brands');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['brandsUid' => 1, 'brandName' => 'Brand A'],
        ]);

        $response = $this->api->items->brands->list(['limit' => 10, 'orderBy' => 'brandName']);

        $this->assertCount(1, $response->data);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithNoParams(): void
    {
        $this->mockListResponse([
            ['brandsUid' => 1],
        ]);

        $response = $this->api->items->brands->list();

        $this->assertCount(1, $response->data);
    }

    public function testListWithNullData(): void
    {
        $this->mockClient->addResponse(
            new \Nyholm\Psr7\Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => null,
                'status' => 200,
            ])),
        );

        $response = $this->api->items->brands->list();

        $this->assertNull($response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse(['brandsUid' => 1, 'brandName' => 'Brand A']);

        $response = $this->api->items->brands->get(1);

        $this->assertEquals(1, $response->data['brandsUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/brands/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse(['brandsUid' => 3, 'brandName' => 'New Brand']);

        $response = $this->api->items->brands->create(['brandName' => 'New Brand']);

        $this->assertEquals(3, $response->data['brandsUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/brands');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['brandsUid' => 1, 'brandName' => 'Updated Brand']);

        $response = $this->api->items->brands->update(1, ['brandName' => 'Updated Brand']);

        $this->assertEquals('Updated Brand', $response->data['brandName']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/brands/1');
    }

    public function testDelete(): void
    {
        $this->mockClient->addResponse(
            new \Nyholm\Psr7\Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => true,
                'status' => 200,
            ])),
        );

        $response = $this->api->items->brands->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/brands/1');
    }

    public function testListAttributes(): void
    {
        $this->mockListResponse([
            ['attributeId' => 1, 'name' => 'Color'],
            ['attributeId' => 2, 'name' => 'Size'],
        ]);

        $response = $this->api->items->brands->listAttributes(1);

        $this->assertIsArray($response->data);
        $this->assertCount(2, $response->data);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/brands/1/attributes');
    }

    public function testListItems(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100, 'itemId' => 'ITEM-001'],
            ['invMastUid' => 101, 'itemId' => 'ITEM-002'],
        ]);

        $response = $this->api->items->brands->listItems(1);

        $this->assertIsArray($response->data);
        $this->assertCount(2, $response->data);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/brands/1/items');
    }

    public function testListItemsWithParams(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100],
        ]);

        $response = $this->api->items->brands->listItems(1, ['limit' => 10]);

        $this->assertIsArray($response->data);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/brands/1/items');
    }
}
