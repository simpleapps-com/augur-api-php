<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Basecamp2\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TodosSummaryResource.
 */
final class TodosSummaryResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'content' => 'Todo A', 'summary' => 'Summary for Todo A', 'status' => 'pending'],
            ['id' => 2, 'content' => 'Todo B', 'summary' => 'Summary for Todo B', 'status' => 'completed'],
        ]);

        $response = $this->api->basecamp2->todosSummary->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('Summary for Todo A', $response->data[0]['summary']);
        $this->assertEquals('pending', $response->data[0]['status']);
        $this->assertRequestPath('/todos-summary');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['id' => 1, 'content' => 'Todo A', 'summary' => 'Summary for Todo A'],
        ]);

        $response = $this->api->basecamp2->todosSummary->list([
            'limit' => 10,
            'offset' => 0,
            'status' => 'pending',
        ]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'id' => 1,
            'content' => 'Todo A',
            'summary' => 'Detailed summary for Todo A',
            'status' => 'pending',
            'due_on' => '2024-01-20',
        ]);

        $response = $this->api->basecamp2->todosSummary->get(1);

        $this->assertEquals(1, $response->data['id']);
        $this->assertEquals('Detailed summary for Todo A', $response->data['summary']);
        $this->assertEquals('pending', $response->data['status']);
        $this->assertRequestPath('/todos-summary/1');
        $this->assertRequestMethod('GET');
    }

    public function testListEmpty(): void
    {
        $this->mockListResponse([]);

        $response = $this->api->basecamp2->todosSummary->list();

        $this->assertIsArray($response->data);
        $this->assertEmpty($response->data);
    }
}
