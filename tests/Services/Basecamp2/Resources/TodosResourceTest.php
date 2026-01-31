<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Basecamp2\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TodosResource.
 */
final class TodosResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'content' => 'Todo A', 'completed' => false],
            ['id' => 2, 'content' => 'Todo B', 'completed' => true],
        ]);

        $response = $this->api->basecamp2->todos->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Todo A', $response->data[0]['content']);
        $this->assertFalse($response->data[0]['completed']);
        $this->assertRequestPath('/todos');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'content' => 'Todo A'],
        ]);

        $response = $this->api->basecamp2->todos->list(['limit' => 10, 'completed' => false]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'id' => 1,
            'content' => 'Todo A',
            'completed' => false,
            'due_on' => '2024-01-20',
        ]);

        $response = $this->api->basecamp2->todos->get(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('Todo A', $response->data['content']);
        $this->assertFalse($response->data['completed']);
        $this->assertRequestPath('/todos/1');
        $this->assertRequestMethod('GET');
    }

    public function testGetComments(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Comment 1', 'creator_id' => 10],
            ['id' => 101, 'content' => 'Comment 2', 'creator_id' => 11],
        ]);

        $response = $this->api->basecamp2->todos->getComments(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Comment 1', $response->data[0]['content']);
        $this->assertRequestPath('/todos/1/comments');
        $this->assertRequestMethod('GET');
    }

    public function testGetCommentsWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 100, 'content' => 'Comment 1'],
        ]);

        $response = $this->api->basecamp2->todos->getComments(1, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testGetEvents(): void
    {
        $this->mockListResponse([
            ['id' => 200, 'action' => 'created', 'created_at' => '2024-01-15T10:00:00Z'],
            ['id' => 201, 'action' => 'updated', 'created_at' => '2024-01-15T11:00:00Z'],
        ]);

        $response = $this->api->basecamp2->todos->getEvents(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('created', $response->data[0]['action']);
        $this->assertRequestPath('/todos/1/events');
        $this->assertRequestMethod('GET');
    }

    public function testGetEventsWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 200, 'action' => 'created'],
        ]);

        $response = $this->api->basecamp2->todos->getEvents(1, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testGetMetrics(): void
    {
        $this->mockResponse([
            'todo_id' => 1,
            'time_spent' => 120,
            'events_count' => 5,
            'comments_count' => 3,
        ]);

        $response = $this->api->basecamp2->todos->getMetrics(1);

        $this->assertEquals(1, $response->data['todo_id']);
        $this->assertEquals(120, $response->data['time_spent']);
        $this->assertRequestPath('/todos/1/metrics');
        $this->assertRequestMethod('GET');
    }

    public function testListSummaries(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'content' => 'Todo A', 'summary' => 'Brief summary A'],
            ['id' => 2, 'content' => 'Todo B', 'summary' => 'Brief summary B'],
        ]);

        $response = $this->api->basecamp2->todos->listSummaries();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Brief summary A', $response->data[0]['summary']);
        $this->assertRequestPath('/todos-summary');
        $this->assertRequestMethod('GET');
    }

    public function testListSummariesWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'content' => 'Todo A', 'summary' => 'Brief summary A'],
        ]);

        $response = $this->api->basecamp2->todos->listSummaries(['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testGetSummary(): void
    {
        $this->mockResponse([
            'id' => 1,
            'content' => 'Todo A',
            'summary' => 'Detailed summary for Todo A',
        ]);

        $response = $this->api->basecamp2->todos->getSummary(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('Detailed summary for Todo A', $response->data['summary']);
        $this->assertRequestPath('/todos-summary/1');
        $this->assertRequestMethod('GET');
    }

    public function testGetEvent(): void
    {
        $this->mockResponse([
            'id' => 200,
            'todo_id' => 1,
            'event_num' => 1,
            'action' => 'created',
            'created_at' => '2024-01-15T10:00:00Z',
        ]);

        $response = $this->api->basecamp2->todos->getEvent(1, 1);

        $this->assertEquals(200, $response->data['id']);
        $this->assertEquals('created', $response->data['action']);
        $this->assertRequestPath('/todos/1/events/1');
        $this->assertRequestMethod('GET');
    }

    public function testGetSessions(): void
    {
        $this->mockListResponse([
            ['id' => 300, 'todo_id' => 1, 'duration' => 60, 'started_at' => '2024-01-15T10:00:00Z'],
            ['id' => 301, 'todo_id' => 1, 'duration' => 45, 'started_at' => '2024-01-15T12:00:00Z'],
        ]);

        $response = $this->api->basecamp2->todos->getSessions(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals(60, $response->data[0]['duration']);
        $this->assertRequestPath('/todos/1/sessions');
        $this->assertRequestMethod('GET');
    }

    public function testGetSessionsWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 300, 'todo_id' => 1, 'duration' => 60],
        ]);

        $response = $this->api->basecamp2->todos->getSessions(1, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testGetSession(): void
    {
        $this->mockResponse([
            'id' => 300,
            'todo_id' => 1,
            'duration' => 60,
            'started_at' => '2024-01-15T10:00:00Z',
            'ended_at' => '2024-01-15T11:00:00Z',
        ]);

        $response = $this->api->basecamp2->todos->getSession(1, 300);

        $this->assertEquals(300, $response->data['id']);
        $this->assertEquals(60, $response->data['duration']);
        $this->assertRequestPath('/todos/1/sessions/300');
        $this->assertRequestMethod('GET');
    }

    public function testCreateSession(): void
    {
        $this->mockResponse([
            'id' => 302,
            'todo_id' => 1,
            'duration' => 0,
            'started_at' => '2024-01-15T14:00:00Z',
        ]);

        $response = $this->api->basecamp2->todos->createSession(1, [
            'started_at' => '2024-01-15T14:00:00Z',
        ]);

        $this->assertEquals(302, $response->data['id']);
        $this->assertRequestPath('/todos/1/sessions');
        $this->assertRequestMethod('POST');
    }

    public function testCreateSessionWithEmptyData(): void
    {
        $this->mockResponse([
            'id' => 303,
            'todo_id' => 1,
        ]);

        $response = $this->api->basecamp2->todos->createSession(1);

        $this->assertEquals(303, $response->data['id']);
        $this->assertRequestMethod('POST');
    }

    public function testUpdateSession(): void
    {
        $this->mockResponse([
            'id' => 300,
            'todo_id' => 1,
            'duration' => 90,
            'ended_at' => '2024-01-15T11:30:00Z',
        ]);

        $response = $this->api->basecamp2->todos->updateSession(1, 300, [
            'duration' => 90,
            'ended_at' => '2024-01-15T11:30:00Z',
        ]);

        $this->assertEquals(300, $response->data['id']);
        $this->assertEquals(90, $response->data['duration']);
        $this->assertRequestPath('/todos/1/sessions/300');
        $this->assertRequestMethod('PUT');
    }

    public function testUpdateSessionWithEmptyData(): void
    {
        $this->mockResponse([
            'id' => 300,
            'todo_id' => 1,
        ]);

        $response = $this->api->basecamp2->todos->updateSession(1, 300);

        $this->assertEquals(300, $response->data['id']);
        $this->assertRequestMethod('PUT');
    }

    public function testDeleteSession(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->basecamp2->todos->deleteSession(1, 300);

        $this->assertTrue($response->data['deleted']);
        $this->assertRequestPath('/todos/1/sessions/300');
        $this->assertRequestMethod('DELETE');
    }
}
