<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Basecamp2\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for CommentsResource.
 */
final class CommentsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'content' => 'Comment A', 'creator' => ['id' => 10, 'name' => 'John Doe']],
            ['id' => 2, 'content' => 'Comment B', 'creator' => ['id' => 11, 'name' => 'Jane Doe']],
        ]);

        $response = $this->api->basecamp2->comments->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Comment A', $response->data[0]['content']);
        $this->assertRequestPath('/comments');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'content' => 'Comment A'],
        ]);

        $response = $this->api->basecamp2->comments->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'id' => 1,
            'content' => 'Comment A',
            'creator' => ['id' => 10, 'name' => 'John Doe'],
            'createdAt' => '2024-01-15T10:00:00Z',
        ]);

        $response = $this->api->basecamp2->comments->get(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('Comment A', $response->data['content']);
        $this->assertRequestPath('/comments/1');
        $this->assertRequestMethod('GET');
    }
}
