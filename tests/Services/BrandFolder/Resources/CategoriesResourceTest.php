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
}
