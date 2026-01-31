<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Legacy\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ItemCategoryResource.
 */
final class ItemCategoryResourceTest extends AugurApiTestCase
{
    public function testGet(): void
    {
        $this->mockResponse([
            'itemCategoryUid' => 100,
            'categoryName' => 'Electronics',
            'parentCategoryUid' => null,
            'active' => true,
        ]);

        $response = $this->api->legacy->itemCategory->get(100);

        $this->assertEquals(100, $response->data['itemCategoryUid']);
        $this->assertEquals('Electronics', $response->data['categoryName']);
        $this->assertTrue($response->data['active']);
        $this->assertRequestPath('/item-category/100');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
