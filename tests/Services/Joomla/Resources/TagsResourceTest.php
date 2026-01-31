<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Joomla\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TagsResource.
 */
final class TagsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'title' => 'Technology', 'alias' => 'technology'],
            ['id' => 2, 'title' => 'News', 'alias' => 'news'],
        ]);

        $response = $this->api->joomla->tags->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Technology', $response->data[0]['title']);
        $this->assertRequestPath('/tags');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'title' => 'Technology'],
        ]);

        $response = $this->api->joomla->tags->list(['limit' => 10, 'published' => 1]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/tags');
    }
}
