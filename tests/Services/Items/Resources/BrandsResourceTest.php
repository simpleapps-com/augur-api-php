<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\AugurApiClient;
use AugurApi\Services\Items\Schemas\Brand;
use AugurApi\Services\Items\Schemas\BrandsListParams;
use Http\Mock\Client as MockClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class BrandsResourceTest extends TestCase
{
    private MockClient $mockClient;
    private AugurApiClient $api;

    protected function setUp(): void
    {
        $this->mockClient = new MockClient();
        $factory = new Psr17Factory();

        $this->api = new AugurApiClient(
            siteId: 'TEST123',
            bearerToken: 'test-token',
            httpClient: $this->mockClient,
            requestFactory: $factory,
            streamFactory: $factory,
        );
    }

    public function testListBrands(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => [
                    ['brandsUid' => 1, 'brandName' => 'Brand A'],
                    ['brandsUid' => 2, 'brandName' => 'Brand B'],
                ],
                'status' => 200,
                'total' => 2,
            ])),
        );

        $params = new BrandsListParams(limit: 10, orderBy: 'brandName');
        $response = $this->api->items->brands->list($params);

        $this->assertCount(2, $response->data);
        $this->assertInstanceOf(Brand::class, $response->data[0]);
        $this->assertEquals('Brand A', $response->data[0]->brandName);
        $this->assertEquals(2, $response->total);
    }

    public function testListBrandsWithArray(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => [['brandsUid' => 1]],
                'status' => 200,
            ])),
        );

        $response = $this->api->items->brands->list(['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testListBrandsWithNoParams(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => [['brandsUid' => 1]],
                'status' => 200,
            ])),
        );

        $response = $this->api->items->brands->list();

        $this->assertCount(1, $response->data);
    }

    public function testListBrandsWithNullData(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => null,
                'status' => 200,
            ])),
        );

        $response = $this->api->items->brands->list();

        $this->assertIsArray($response->data);
        $this->assertCount(0, $response->data);
    }

    public function testGetBrand(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => ['brandsUid' => 1, 'brandName' => 'Brand A'],
                'status' => 200,
            ])),
        );

        $response = $this->api->items->brands->get(1);

        $this->assertInstanceOf(Brand::class, $response->data);
        $this->assertEquals(1, $response->data->brandsUid);
    }

    public function testCreateBrand(): void
    {
        $this->mockClient->addResponse(
            new Response(201, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => ['brandsUid' => 3, 'brandName' => 'New Brand'],
                'status' => 201,
            ])),
        );

        $response = $this->api->items->brands->create(['brandName' => 'New Brand']);

        $this->assertEquals(3, $response->data->brandsUid);
    }

    public function testUpdateBrand(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => ['brandsUid' => 1, 'brandName' => 'Updated Brand'],
                'status' => 200,
            ])),
        );

        $response = $this->api->items->brands->update(1, ['brandName' => 'Updated Brand']);

        $this->assertEquals('Updated Brand', $response->data->brandName);
    }

    public function testDeleteBrand(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => true,
                'status' => 200,
            ])),
        );

        $response = $this->api->items->brands->delete(1);

        $this->assertTrue($response->data);
    }

    public function testGetAttributes(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => [
                    ['attributeId' => 1, 'name' => 'Color'],
                    ['attributeId' => 2, 'name' => 'Size'],
                ],
                'status' => 200,
            ])),
        );

        $response = $this->api->items->brands->getAttributes(1);

        $this->assertIsArray($response->data);
        $this->assertCount(2, $response->data);
    }

    public function testGetItems(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => [
                    ['invMastUid' => 100, 'itemId' => 'ITEM-001'],
                    ['invMastUid' => 101, 'itemId' => 'ITEM-002'],
                ],
                'status' => 200,
                'total' => 2,
            ])),
        );

        $response = $this->api->items->brands->getItems(1);

        $this->assertIsArray($response->data);
        $this->assertCount(2, $response->data);
    }

    public function testGetItemsWithParams(): void
    {
        $this->mockClient->addResponse(
            new Response(200, ['Content-Type' => 'application/json'], (string) json_encode([
                'data' => [['invMastUid' => 100]],
                'status' => 200,
            ])),
        );

        $response = $this->api->items->brands->getItems(1, ['limit' => 10]);

        $this->assertIsArray($response->data);
    }
}
