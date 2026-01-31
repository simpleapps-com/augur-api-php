<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Vmi\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ProductsResource.
 *
 * @covers \AugurApi\Services\Vmi\Resources\ProductsResource
 */
final class ProductsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['productsUid' => 1, 'productId' => 'PROD001', 'name' => 'Product A'],
            ['productsUid' => 2, 'productId' => 'PROD002', 'name' => 'Product B'],
        ]);

        $response = $this->api->vmi->products->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['productsUid']);
        $this->assertEquals('PROD001', $response->data[0]['productId']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/products');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['productsUid' => 1, 'productId' => 'PROD001'],
        ], 100);

        $response = $this->api->vmi->products->list(['limit' => 50, 'q' => 'product']);

        $this->assertCount(1, $response->data);
        $this->assertEquals(100, $response->total);
    }

    public function testFind(): void
    {
        $this->mockListResponse([
            ['productsUid' => 1, 'productId' => 'PROD001', 'name' => 'Widget A'],
            ['productsUid' => 2, 'productId' => 'PROD002', 'name' => 'Widget B'],
        ]);

        $response = $this->api->vmi->products->find();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Widget A', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/products/find');
    }

    public function testFindWithParams(): void
    {
        $this->mockListResponse([
            ['productsUid' => 1, 'productId' => 'PROD001'],
        ]);

        $response = $this->api->vmi->products->find(['q' => 'widget', 'active' => true]);

        $this->assertCount(1, $response->data);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'productsUid' => 1,
            'productId' => 'PROD001',
            'name' => 'Product A',
            'description' => 'Description of Product A',
        ]);

        $response = $this->api->vmi->products->get(1);

        $this->assertEquals(1, $response->data['productsUid']);
        $this->assertEquals('PROD001', $response->data['productId']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/products/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'productsUid' => 3,
            'productId' => 'PROD003',
            'name' => 'New Product',
        ]);

        $response = $this->api->vmi->products->create(1, [
            'productId' => 'PROD003',
            'name' => 'New Product',
        ]);

        $this->assertEquals(3, $response->data['productsUid']);
        $this->assertEquals('New Product', $response->data['name']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/distributors/1/products');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'productsUid' => 1,
            'productId' => 'PROD001',
            'name' => 'Updated Product',
        ]);

        $response = $this->api->vmi->products->update(1, [
            'name' => 'Updated Product',
        ]);

        $this->assertEquals('Updated Product', $response->data['name']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/products/1');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->vmi->products->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/products/1');
    }

    public function testEnable(): void
    {
        $this->mockResponse([
            'productsUid' => 1,
            'active' => true,
        ]);

        $response = $this->api->vmi->products->enable(1);

        $this->assertTrue($response->data['active']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/products/1/enable');
    }

    public function testEnableWithData(): void
    {
        $this->mockResponse([
            'productsUid' => 1,
            'active' => false,
        ]);

        $response = $this->api->vmi->products->enable(1, ['active' => false]);

        $this->assertFalse($response->data['active']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
