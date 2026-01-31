<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Basecamp2\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ProjectsResource.
 */
final class ProjectsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'name' => 'Project Alpha', 'status' => 'active'],
            ['id' => 2, 'name' => 'Project Beta', 'status' => 'archived'],
        ]);

        $response = $this->api->basecamp2->projects->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Project Alpha', $response->data[0]['name']);
        $this->assertRequestPath('/projects');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'name' => 'Project Alpha'],
        ]);

        $response = $this->api->basecamp2->projects->list(['limit' => 10, 'status' => 'active']);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'id' => 1,
            'name' => 'Project Alpha',
            'status' => 'active',
            'description' => 'A test project',
        ]);

        $response = $this->api->basecamp2->projects->get(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('Project Alpha', $response->data['name']);
        $this->assertRequestPath('/projects/1');
        $this->assertRequestMethod('GET');
    }

    public function testGetTodos(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Todo A', 'project_id' => 1],
            ['id' => 101, 'content' => 'Todo B', 'project_id' => 1],
        ]);

        $response = $this->api->basecamp2->projects->getTodos(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Todo A', $response->data[0]['content']);
        $this->assertRequestPath('/projects/1/todos');
        $this->assertRequestMethod('GET');
    }

    public function testGetTodosWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Todo A'],
        ]);

        $response = $this->api->basecamp2->projects->getTodos(1, ['limit' => 5, 'completed' => false]);

        $this->assertCount(1, $response->data);
    }

    public function testGetMetrics(): void
    {
        $this->mockResponse([
            'project_id' => 1,
            'total_todos' => 50,
            'completed_todos' => 35,
            'completion_rate' => 70.0,
        ]);

        $response = $this->api->basecamp2->projects->getMetrics(1);

        $this->assertEquals(1, $response->data['project_id']);
        $this->assertEquals(50, $response->data['total_todos']);
        $this->assertEquals(70.0, $response->data['completion_rate']);
        $this->assertRequestPath('/projects/1/metrics');
        $this->assertRequestMethod('GET');
    }

    public function testGetMetricsWithParams(): void
    {
        $this->mockResponse([
            'project_id' => 1,
            'total_todos' => 20,
        ]);

        $response = $this->api->basecamp2->projects->getMetrics(1, ['dateFrom' => '2024-01-01']);

        $this->assertEquals(20, $response->data['total_todos']);
    }

    public function testGetTodolists(): void
    {
        $this->mockListResponse([
            ['id' => 10, 'name' => 'Todolist A', 'project_id' => 1],
            ['id' => 11, 'name' => 'Todolist B', 'project_id' => 1],
        ]);

        $response = $this->api->basecamp2->projects->getTodolists(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Todolist A', $response->data[0]['name']);
        $this->assertRequestPath('/projects/1/todolists');
        $this->assertRequestMethod('GET');
    }

    public function testGetTodolistsWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 10, 'name' => 'Todolist A'],
        ]);

        $response = $this->api->basecamp2->projects->getTodolists(1, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testGetTodolistTodos(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Todo from Todolist', 'todolist_id' => 10],
            ['id' => 101, 'content' => 'Another Todo', 'todolist_id' => 10],
        ]);

        $response = $this->api->basecamp2->projects->getTodolistTodos(1, 10);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Todo from Todolist', $response->data[0]['content']);
        $this->assertRequestPath('/projects/1/todolists/10/todos');
        $this->assertRequestMethod('GET');
    }

    public function testGetTodolistTodosWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Todo from Todolist'],
        ]);

        $response = $this->api->basecamp2->projects->getTodolistTodos(1, 10, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }
}
