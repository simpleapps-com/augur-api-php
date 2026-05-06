<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Legacy\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for Legacy CustomersResource.
 */
final class CustomersResourceTest extends AugurApiTestCase
{
    public function testListTags(): void
    {
        $this->mockListResponse([
            ['customerTagsUid' => 1, 'tag' => 'VIP'],
            ['customerTagsUid' => 2, 'tag' => 'Wholesale'],
        ]);

        $response = $this->api->legacy->customers->listTags(123);

        $this->assertCount(2, $response->data);
        $this->assertRequestPath('/customers/123/tags');
        $this->assertRequestMethod('GET');
    }

    public function testListTagsWithParams(): void
    {
        $this->mockListResponse([
            ['customerTagsUid' => 1, 'tag' => 'VIP'],
        ]);

        $response = $this->api->legacy->customers->listTags(123, ['limit' => 10]);

        $this->assertCount(1, $response->data);
    }

    public function testCreateTags(): void
    {
        $this->mockResponse([
            'customerTagsUid' => 3,
            'tag' => 'New Tag',
        ], 201);

        $response = $this->api->legacy->customers->createTags('123', [
            'tag' => 'New Tag',
        ]);

        $this->assertEquals(3, $response->data['customerTagsUid']);
        $this->assertRequestPath('/customers/123/tags');
        $this->assertRequestMethod('POST');
    }

    public function testGetTags(): void
    {
        $this->mockResponse([
            'customerTagsUid' => 1,
            'customerId' => 123,
            'tag' => 'VIP',
        ]);

        $response = $this->api->legacy->customers->getTags(123, 1);

        $this->assertEquals(1, $response->data['customerTagsUid']);
        $this->assertRequestPath('/customers/123/tags/1');
        $this->assertRequestMethod('GET');
    }

    public function testUpdateTags(): void
    {
        $this->mockResponse([
            'customerTagsUid' => 1,
            'tag' => 'Updated',
        ]);

        $response = $this->api->legacy->customers->updateTags(123, 1, ['tag' => 'Updated']);

        $this->assertEquals('Updated', $response->data['tag']);
        $this->assertRequestPath('/customers/123/tags/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDeleteTags(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->legacy->customers->deleteTags(123, 1);

        $this->assertTrue($response->data['deleted']);
        $this->assertRequestPath('/customers/123/tags/1');
        $this->assertRequestMethod('DELETE');
    }
}
