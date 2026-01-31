<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Legacy\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for InvMastWebDescResource.
 */
final class InvMastWebDescResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invMastWebDescUid' => 1, 'description' => 'Short description'],
            ['invMastWebDescUid' => 2, 'description' => 'Detailed description'],
        ]);

        $response = $this->api->legacy->invMastWebDesc->list(12345);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Short description', $response->data[0]['description']);
        $this->assertRequestPath('/inv-mast/12345/web-desc');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invMastWebDescUid' => 1, 'description' => 'Short description'],
        ]);

        $response = $this->api->legacy->invMastWebDesc->list(12345, ['limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/inv-mast/12345/web-desc');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'invMastWebDescUid' => 1,
            'invMastUid' => 12345,
            'description' => 'Full product description',
            'descType' => 'long',
        ]);

        $response = $this->api->legacy->invMastWebDesc->get(12345, 1);

        $this->assertEquals(1, $response->data['invMastWebDescUid']);
        $this->assertEquals('Full product description', $response->data['description']);
        $this->assertRequestPath('/inv-mast/12345/web-desc/1');
        $this->assertRequestMethod('GET');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'invMastWebDescUid' => 3,
            'invMastUid' => 12345,
            'description' => 'New description',
            'descType' => 'short',
        ], 201);

        $response = $this->api->legacy->invMastWebDesc->create(12345, [
            'description' => 'New description',
            'descType' => 'short',
        ]);

        $this->assertEquals(3, $response->data['invMastWebDescUid']);
        $this->assertEquals('New description', $response->data['description']);
        $this->assertRequestPath('/inv-mast/12345/web-desc');
        $this->assertRequestMethod('POST');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'invMastWebDescUid' => 1,
            'description' => 'Updated description',
        ]);

        $response = $this->api->legacy->invMastWebDesc->update(12345, 1, [
            'description' => 'Updated description',
        ]);

        $this->assertEquals('Updated description', $response->data['description']);
        $this->assertRequestPath('/inv-mast/12345/web-desc/1');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['deleted' => true]);

        $response = $this->api->legacy->invMastWebDesc->delete(12345, 1);

        $this->assertTrue($response->data['deleted']);
        $this->assertRequestPath('/inv-mast/12345/web-desc/1');
        $this->assertRequestMethod('DELETE');
    }
}
