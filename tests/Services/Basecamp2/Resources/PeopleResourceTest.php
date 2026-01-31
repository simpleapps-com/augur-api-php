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
        $this->assertEquals('John Doe', $response->data[0]['name']);
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

        $response = $this->api->basecamp2->people->getTodos(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Todo A', $response->data[0]['content']);
        $this->assertRequestPath('/people/1/todos');
        $this->assertRequestMethod('GET');
    }

    public function testGetTodosWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Todo A'],
        ]);

        $response = $this->api->basecamp2->people->getTodos(1, ['limit' => 10, 'completed' => false]);

        $this->assertCount(1, $response->data);
    }

    public function testGetProjectTodos(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Project Todo A', 'project_id' => 5],
            ['id' => 101, 'content' => 'Project Todo B', 'project_id' => 5],
        ]);

        $response = $this->api->basecamp2->people->getProjectTodos(1, 5);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Project Todo A', $response->data[0]['content']);
        $this->assertRequestPath('/people/1/projects/5/todos');
        $this->assertRequestMethod('GET');
    }

    public function testGetProjectTodosWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Project Todo A'],
        ]);

        $response = $this->api->basecamp2->people->getProjectTodos(1, 5, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testGetMetrics(): void
    {
        $this->mockResponse([
            'person_id' => 1,
            'todos_completed' => 25,
            'todos_pending' => 5,
            'completion_rate' => 83.3,
        ]);

        $response = $this->api->basecamp2->people->getMetrics(1);

        $this->assertEquals(1, $response->data['person_id']);
        $this->assertEquals(25, $response->data['todos_completed']);
        $this->assertRequestPath('/people/1/metrics');
        $this->assertRequestMethod('GET');
    }

    public function testGetMetricsWithParams(): void
    {
        $this->mockResponse([
            'person_id' => 1,
            'todos_completed' => 10,
        ]);

        $response = $this->api->basecamp2->people->getMetrics(1, ['dateFrom' => '2024-01-01']);

        $this->assertEquals(10, $response->data['todos_completed']);
    }
}
