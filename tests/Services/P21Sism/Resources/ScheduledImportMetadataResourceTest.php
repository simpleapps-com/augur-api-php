<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Sism\Resources;

use AugurApi\Services\P21Sism\Resources\ScheduledImportMetadataResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for ScheduledImportMetadataResource.
 */
#[CoversClass(ScheduledImportMetadataResource::class)]
final class ScheduledImportMetadataResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['scheduledImportMetadataUid' => 7, 'deliveryMethod' => 'sftp'],
        ]);

        $response = $this->api->p21Sism->scheduledImportMetadata->list(['deliveryMethod' => 'sftp']);

        $this->assertCount(1, $response->data);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/scheduled-import-metadata');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse(['scheduledImportMetadataUid' => 7]);

        $response = $this->api->p21Sism->scheduledImportMetadata->get('7');

        $this->assertEquals(7, self::at($response->data, 'scheduledImportMetadataUid'));
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/scheduled-import-metadata/7');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['scheduledImportMetadataUid' => 7, 'deliveryMethod' => 'ftp']);

        $response = $this->api->p21Sism->scheduledImportMetadata->update('7', ['deliveryMethod' => 'ftp']);

        $this->assertEquals('ftp', self::at($response->data, 'deliveryMethod'));
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/scheduled-import-metadata/7');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['scheduledImportMetadataUid' => 7]);

        $this->api->p21Sism->scheduledImportMetadata->delete('7');

        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/scheduled-import-metadata/7');
    }
}
