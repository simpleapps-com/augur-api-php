<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Basecamp2\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TodolistsResource.
 */
final class TodolistsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'name' => 'Todolist A', 'completed_count' => 5, 'remaining_count' => 3],
            ['id' => 2, 'name' => 'Todolist B', 'completed_count' => 10, 'remaining_count' => 0],
        ]);

        $response = $this->api->basecamp2->todolists->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Todolist A', $response->data[0]['name']);
        $this->assertEquals(5, $response->data[0]['completed_count']);
        $this->assertRequestPath('/todolists');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'name' => 'Todolist A'],
        ]);

        $response = $this->api->basecamp2->todolists->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'id' => 1,
            'name' => 'Todolist A',
            'completed_count' => 5,
            'remaining_count' => 3,
            'description' => 'A sample todolist',
        ]);

        $response = $this->api->basecamp2->todolists->get(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('Todolist A', $response->data['name']);
        $this->assertEquals(5, $response->data['completed_count']);
        $this->assertRequestPath('/todolists/1');
        $this->assertRequestMethod('GET');
    }

    public function testListEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->basecamp2->todolists->list();

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }
}
