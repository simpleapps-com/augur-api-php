<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Legacy\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for InvMastTagsResource.
 */
final class InvMastTagsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invMastTagsUid' => 1, 'tagName' => 'Featured'],
            ['invMastTagsUid' => 2, 'tagName' => 'Sale'],
        ]);

        $response = $this->api->legacy->invMastTags->list(12345);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Featured', $response->data[0]['tagName']);
        $this->assertRequestPath('/inv-mast/12345/tags');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invMastTagsUid' => 1, 'tagName' => 'Featured'],
        ]);

        $response = $this->api->legacy->invMastTags->list(12345, ['limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/inv-mast/12345/tags');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'invMastTagsUid' => 1,
            'invMastUid' => 12345,
            'tagName' => 'Featured',
            'tagValue' => 'true',
        ]);

        $response = $this->api->legacy->invMastTags->get(12345, 1);

        $this->assertEquals(1, $response->data['invMastTagsUid']);
        $this->assertEquals('Featured', $response->data['tagName']);
        $this->assertRequestPath('/inv-mast/12345/tags/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'invMastTagsUid' => 3,
            'invMastUid' => 12345,
            'tagName' => 'New Tag',
            'tagValue' => 'value',
        ], 201);

        $response = $this->api->legacy->invMastTags->create(12345, [
            'tagName' => 'New Tag',
            'tagValue' => 'value',
        ]);

        $this->assertEquals(3, $response->data['invMastTagsUid']);
        $this->assertEquals('New Tag', $response->data['tagName']);
        $this->assertRequestPath('/inv-mast/12345/tags');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'invMastTagsUid' => 1,
            'tagName' => 'Updated Tag',
            'tagValue' => 'new value',
        ]);

        $response = $this->api->legacy->invMastTags->update(12345, 1, [
            'tagName' => 'Updated Tag',
            'tagValue' => 'new value',
        ]);

        $this->assertEquals('Updated Tag', $response->data['tagName']);
        $this->assertRequestPath('/inv-mast/12345/tags/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->legacy->invMastTags->delete(12345, 1);

        $this->assertTrue($response->data['deleted']);
        $this->assertRequestPath('/inv-mast/12345/tags/1');
        $this->assertRequestMethod('DELETE');
    }
}
