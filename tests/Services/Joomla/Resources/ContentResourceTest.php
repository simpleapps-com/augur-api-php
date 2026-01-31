<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Joomla\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ContentResource.
 */
final class ContentResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'title' => 'Article One', 'alias' => 'article-one'],
            ['id' => 2, 'title' => 'Article Two', 'alias' => 'article-two'],
        ]);

        $response = $this->api->joomla->content->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Article One', $response->data[0]['title']);
        $this->assertRequestPath('/content');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'title' => 'Article One'],
        ]);

        $response = $this->api->joomla->content->list(['limit' => 10, 'categoryId' => 5]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/content');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'id' => 1,
            'title' => 'Article One',
            'alias' => 'article-one',
            'introtext' => 'Introduction text...',
            'fulltext' => 'Full article text...',
        ]);

        $response = $this->api->joomla->content->get(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('Article One', $response->data['title']);
        $this->assertRequestPath('/content/1');
        $this->assertRequestMethod('GET');
    }

    public function testGetDoc(): void
    {
        $this->mockResponse([
            'id' => 1,
            'title' => 'Article One',
            'category' => 'News',
            'author' => 'Admin',
            'created' => '2024-01-15',
        ]);

        $response = $this->api->joomla->content->getDoc(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('News', $response->data['category']);
        $this->assertRequestPath('/content/1/doc');
        $this->assertRequestMethod('GET');
    }
}
