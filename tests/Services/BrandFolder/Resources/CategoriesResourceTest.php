<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\BrandFolder\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for BrandFolder CategoriesResource.
 */
final class CategoriesResourceTest extends AugurApiTestCase
{
    public function testCreateFocus(): void
    {
        $this->mockResponse([
            'success' => true,
            'categoryId' => 123,
            'focus' => 'active',
        ]);

        $response = $this->api->brandFolder->categories->createFocus([
            'categoryId' => 123,
            'focus' => 'active',
        ]);

        $this->assertTrue($response->data['success']);
        $this->assertEquals(123, $response->data['categoryId']);
        $this->assertEquals('active', $response->data['focus']);
        $this->assertRequestPath('/categories/focus');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreateFocusWithMultipleCategories(): void
    {
        $this->mockResponse([
            'success' => true,
            'categories' => [
                ['categoryId' => 1, 'focus' => 'primary'],
                ['categoryId' => 2, 'focus' => 'secondary'],
            ],
        ]);

        $response = $this->api->brandFolder->categories->createFocus([
            'categories' => [
                ['categoryId' => 1, 'focus' => 'primary'],
                ['categoryId' => 2, 'focus' => 'secondary'],
            ],
        ]);

        $this->assertTrue($response->data['success']);
        $this->assertCount(2, $response->data['categories']);
    }

    public function testCreateFocusReturnsBaseResponse(): void
    {
        $this->mockResponse([
            'success' => true,
        ]);

        $response = $this->api->brandFolder->categories->createFocus([
            'categoryId' => 456,
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertIsArray($response->data);
    }

    public function testList(): void
    {
        $this->mockListResponse([
            ['itemCategoryUid' => 1, 'name' => 'Fasteners'],
            ['itemCategoryUid' => 2, 'name' => 'Tools'],
        ]);

        $response = $this->api->brandFolder->categories->list();

        $this->assertCount(2, $response->data);
        $this->assertRequestPath('/categories');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['itemCategoryUid' => 1, 'name' => 'Fasteners'],
        ]);

        $response = $this->api->brandFolder->categories->list(['limit' => 1]);

        $this->assertCount(1, $response->data);
        $this->assertStringContainsString('limit=1', $this->getLastRequest()->getUri()->getQuery());
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'itemCategoryUid' => 42,
            'name' => 'Fasteners',
        ]);

        $response = $this->api->brandFolder->categories->get(42);

        $this->assertEquals('Fasteners', $response->data['name']);
        $this->assertRequestPath('/categories/42');
        $this->assertRequestMethod('GET');
    }
}
