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
        $this->mockResponse('datafiles/items.csv');

        $response = $this->api->agrSite->datafiles->create([
            'location' => 'datafiles',
            'path' => 'items.csv',
            'content' => 'sku,description',
        ]);

        $this->assertEquals('datafiles/items.csv', $response->data);
        $this->assertRequestPath('/datafiles');
        $this->assertRequestMethod('POST');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
