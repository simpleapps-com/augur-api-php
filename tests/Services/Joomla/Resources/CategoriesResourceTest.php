<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Joomla\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for CategoriesResource.
 */
final class CategoriesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'title' => 'Category One'],
            ['id' => 2, 'title' => 'Category Two'],
        ]);

        $response = $this->api->joomla->categories->list();

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Category One', $data[0]['title']);
        $this->assertRequestPath('/categories');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'title' => 'Category One'],
        ]);

        $response = $this->api->joomla->categories->list(['limit' => 10, 'extension' => 'com_content']);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/categories');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'id' => 1,
            'title' => 'Category One',
            'alias' => 'category-one',
        ]);

        $response = $this->api->joomla->categories->get(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('Category One', $response->data['title']);
        $this->assertRequestPath('/categories/1');
        $this->assertRequestMethod('GET');
    }
}
