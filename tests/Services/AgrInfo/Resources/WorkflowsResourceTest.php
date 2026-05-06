<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrInfo\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for WorkflowsResource.
 */
final class WorkflowsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['workflowsUid' => 1, 'title' => 'Workflow A'],
            ['workflowsUid' => 2, 'title' => 'Workflow B'],
        ]);

        $response = $this->api->agrInfo->workflows->list();

        $this->assertCount(2, $response->data);
        $this->assertRequestPath('/workflows');
        $this->assertRequestMethod('GET');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['workflowsUid' => 1, 'title' => 'Workflow A'],
        ]);

        $response = $this->api->agrInfo->workflows->list(['limit' => 10]);

        $this->assertCount(1, $response->data);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'workflowsUid' => 1,
            'title' => 'Workflow A',
        ]);

        $response = $this->api->agrInfo->workflows->get(1);

        $this->assertEquals(1, $response->data['workflowsUid']);
        $this->assertRequestPath('/workflows/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'workflowsUid' => 3,
            'title' => 'New Workflow',
        ]);

        $response = $this->api->agrInfo->workflows->create([
            'title' => 'New Workflow',
        ]);

        $this->assertEquals(3, $response->data['workflowsUid']);
        $this->assertRequestPath('/workflows');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'workflowsUid' => 1,
            'title' => 'Updated Workflow',
        ]);

        $response = $this->api->agrInfo->workflows->update(1, ['title' => 'Updated Workflow']);

        $this->assertEquals('Updated Workflow', $response->data['title']);
        $this->assertRequestPath('/workflows/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->agrInfo->workflows->delete(1);

        $this->assertIsArray($response->data);
        $this->assertRequestPath('/workflows/1');
        $this->assertRequestMethod('DELETE');
    }
}
