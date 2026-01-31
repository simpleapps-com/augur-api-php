<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Basecamp2\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for EventsResource.
 */
final class EventsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'action' => 'created', 'recordable_type' => 'Todo', 'created_at' => '2024-01-15T10:00:00Z'],
            ['id' => 2, 'action' => 'completed', 'recordable_type' => 'Todo', 'created_at' => '2024-01-15T11:00:00Z'],
        ]);

        $response = $this->api->basecamp2->events->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('created', $response->data[0]['action']);
        $this->assertEquals('Todo', $response->data[0]['recordable_type']);
        $this->assertRequestPath('/events');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'action' => 'created'],
        ]);

        $response = $this->api->basecamp2->events->list([
            'limit' => 10,
            'offset' => 0,
            'orderBy' => 'created_at',
        ]);

        $this->assertCount(1, $response->data);
    }

    public function testListEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->basecamp2->events->list();

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }
}
