<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\AgrSite\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AgrSite DatafilesResource.
 */
final class DatafilesResourceTest extends AugurApiTestCase
{
    public function testCreate(): void
    {
        $this->mockResponse([
            'success' => true,
            'fileName' => 'items.csv',
        ]);

        $response = $this->api->agrSite->datafiles->create([
            'fileName' => 'items.csv',
            'contents' => 'sku,description',
        ]);

        $this->assertTrue($response->data['success']);
        $this->assertEquals('items.csv', $response->data['fileName']);
        $this->assertRequestPath('/datafiles');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreateReturnsBaseResponse(): void
    {
        $this->mockResponse([
            'success' => true,
        ]);

        $response = $this->api->agrSite->datafiles->create([
            'fileName' => 'other.csv',
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertIsArray($response->data);
    }
}
