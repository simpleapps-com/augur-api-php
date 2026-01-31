<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\OpenSearch\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class ItemSearchResourceTest extends AugurApiTestCase
{
    public function testSearch(): void
    {
        $this->mockResponse([
            'hits' => [
                ['invMastUid' => 1, 'itemId' => 'ITEM001', 'description' => 'Test Product'],
                ['invMastUid' => 2, 'itemId' => 'ITEM002', 'description' => 'Another Product'],
            ],
            'total' => 2,
            'query' => 'test',
        ]);

        $response = $this->api->openSearch->itemSearch->search(['q' => 'test']);

        $this->assertCount(2, $response->data['hits']);
        $this->assertEquals('ITEM001', $response->data['hits'][0]['itemId']);
        $this->assertRequestPath('/item-search');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testSearchWithFilters(): void
    {
        $this->mockResponse([
            'hits' => [
                ['invMastUid' => 1, 'itemId' => 'ITEM001', 'brand' => 'BrandA'],
            ],
            'total' => 1,
        ]);

        $response = $this->api->openSearch->itemSearch->search([
            'q' => 'product',
            'brand' => 'BrandA',
            'category' => 'Electronics',
        ]);

        $this->assertEquals('BrandA', $response->data['hits'][0]['brand']);
    }

    public function testSearchWithPagination(): void
    {
        $this->mockResponse([
            'hits' => [
                ['invMastUid' => 11, 'itemId' => 'ITEM011'],
            ],
            'total' => 50,
            'page' => 2,
            'perPage' => 10,
        ]);

        $response = $this->api->openSearch->itemSearch->search([
            'q' => 'item',
            'page' => 2,
            'perPage' => 10,
        ]);

        $this->assertEquals(50, $response->data['total']);
        $this->assertEquals(2, $response->data['page']);
    }

    public function testSearchEmpty(): void
    {
        $this->mockResponse([
            'hits' => [],
            'total' => 0,
        ]);

        $response = $this->api->openSearch->itemSearch->search([]);

        $this->assertEmpty($response->data['hits']);
        $this->assertEquals(0, $response->data['total']);
    }

    public function testGetAttributes(): void
    {
        $this->mockResponse([
            'attributes' => [
                ['name' => 'Color', 'values' => ['Red', 'Blue', 'Green']],
                ['name' => 'Size', 'values' => ['S', 'M', 'L', 'XL']],
            ],
            'query' => 'shirt',
        ]);

        $response = $this->api->openSearch->itemSearch->getAttributes(['q' => 'shirt']);

        $this->assertCount(2, $response->data['attributes']);
        $this->assertEquals('Color', $response->data['attributes'][0]['name']);
        $this->assertContains('Red', $response->data['attributes'][0]['values']);
        $this->assertRequestPath('/item-search/attributes');
        $this->assertRequestMethod('GET');
    }

    public function testGetAttributesWithFilters(): void
    {
        $this->mockResponse([
            'attributes' => [
                ['name' => 'Size', 'values' => ['Small', 'Medium']],
            ],
        ]);

        $response = $this->api->openSearch->itemSearch->getAttributes([
            'q' => 'shirt',
            'category' => 'Apparel',
        ]);

        $this->assertCount(1, $response->data['attributes']);
    }

    public function testGetAttributesEmpty(): void
    {
        $this->mockResponse([
            'attributes' => [],
        ]);

        $response = $this->api->openSearch->itemSearch->getAttributes([]);

        $this->assertEmpty($response->data['attributes']);
    }
}
