<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Basecamp2\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for PeopleResource.
 */
final class PeopleResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            ['id' => 2, 'name' => 'Jane Doe', 'email' => 'jane@example.com'],
        ]);

        $response = $this->api->basecamp2->people->list();

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('John Doe', $data[0]['name']);
        $this->assertRequestPath('/people');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'name' => 'John Doe'],
        ]);

        $response = $this->api->basecamp2->people->list(['limit' => 10]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'admin' => true,
        ]);

        $response = $this->api->basecamp2->people->get(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('John Doe', $response->data['name']);
        $this->assertRequestPath('/people/1');
        $this->assertRequestMethod('GET');
    }

    public function testGetTodos(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Todo A', 'completed' => false],
            ['id' => 101, 'content' => 'Todo B', 'completed' => true],
        ]);

        $response = $this->api->basecamp2->people->listTodos(1);

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Todo A', $data[0]['content']);
        $this->assertRequestPath('/people/1/todos');
        $this->assertRequestMethod('GET');
    }

    public function testGetTodosWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Todo A'],
        ]);

        $response = $this->api->basecamp2->people->listTodos(1, ['limit' => 10, 'completed' => false]);

        $this->assertCount(1, $response->data);
    }

    public function testGetProjectTodos(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Project Todo A', 'project_id' => 5],
            ['id' => 101, 'content' => 'Project Todo B', 'project_id' => 5],
        ]);

        $response = $this->api->basecamp2->people->listProjectsTodos(1, 5);

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('Project Todo A', $data[0]['content']);
        $this->assertRequestPath('/people/1/projects/5/todos');
        $this->assertRequestMethod('GET');
    }

    public function testGetProjectTodosWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Project Todo A'],
        ]);

        $response = $this->api->basecamp2->people->listProjectsTodos(1, 5, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testGetMetrics(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'assigneeId' => 1, 'commentCount' => 25, 'daysOpen' => 5],
        ]);

        $response = $this->api->basecamp2->people->listMetrics(1);

        $this->assertEquals(1, $response->data[0]['assigneeId']);
        $this->assertEquals(25, $response->data[0]['commentCount']);
        $this->assertRequestPath('/people/1/metrics');
        $this->assertRequestMethod('GET');
    }

    public function testGetMetricsWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 101, 'assigneeId' => 1, 'commentCount' => 10],
        ]);

        $response = $this->api->basecamp2->people->listMetrics(1, ['dateFrom' => '2024-01-01']);

        $this->assertEquals(10, $response->data[0]['commentCount']);
    }
}
