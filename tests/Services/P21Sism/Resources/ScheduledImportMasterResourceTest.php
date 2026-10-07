<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Sism\Resources;

use AugurApi\Services\P21Sism\Resources\ScheduledImportMasterResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for ScheduledImportMasterResource.
 */
#[CoversClass(ScheduledImportMasterResource::class)]
final class ScheduledImportMasterResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['scheduledImportMasterUid' => 'SIM001'],
        ]);

        $response = $this->api->p21Sism->scheduledImportMaster->list(['limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/scheduled-import-master');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse(['scheduledImportMasterUid' => 'SIM001']);

        $response = $this->api->p21Sism->scheduledImportMaster->get('SIM001');

        $this->assertEquals('SIM001', self::at($response->data, 'scheduledImportMasterUid'));
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/scheduled-import-master/SIM001');
    }

    public function testCreateMetadata(): void
    {
        $this->mockResponse(['scheduledImportMasterUid' => 12, 'deliveryMethod' => 'sftp']);

        $response = $this->api->p21Sism->scheduledImportMaster->createMetadata('12', [
            'deliveryMethod' => 'sftp',
        ]);

        $this->assertEquals('sftp', self::at($response->data, 'deliveryMethod'));
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/scheduled-import-master/12/metadata');
    }

    public function testCreateMetadataSftp(): void
    {
        $this->mockResponse([
            'scheduledImportMasterUid' => 'SIM001',
            'sftpHost' => 'sftp.example.com',
            'sftpPort' => 22,
            'sftpUsername' => 'import_user',
            'remotePath' => '/imports/',
        ]);

        $response = $this->api->p21Sism->scheduledImportMaster->createMetadataSftp('SIM001', [
            'sftpHost' => 'sftp.example.com',
            'sftpPort' => 22,
            'sftpUsername' => 'import_user',
            'remotePath' => '/imports/',
        ]);

        $this->assertEquals('SIM001', self::at($response->data, 'scheduledImportMasterUid'));
        $this->assertEquals('sftp.example.com', self::at($response->data, 'sftpHost'));
        $this->assertEquals(22, self::at($response->data, 'sftpPort'));
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/scheduled-import-master/SIM001/metadata/sftp');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testCreateMetadataSftpWithEmptyData(): void
    {
        $this->mockResponse([
            'scheduledImportMasterUid' => 'SIM002',
            'sftpHost' => null,
            'configured' => false,
        ]);

        $response = $this->api->p21Sism->scheduledImportMaster->createMetadataSftp('SIM002');

        $this->assertEquals('SIM002', self::at($response->data, 'scheduledImportMasterUid'));
        $this->assertFalse(self::at($response->data, 'configured'));
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/scheduled-import-master/SIM002/metadata/sftp');
    }

    public function testCreateMetadataSftpWithFullConfiguration(): void
    {
        $this->mockResponse([
            'scheduledImportMasterUid' => 'SIM003',
            'sftpHost' => 'secure-sftp.example.com',
            'sftpPort' => 2222,
            'sftpUsername' => 'batch_user',
            'remotePath' => '/data/imports/',
            'filePattern' => '*.csv',
            'archivePath' => '/data/archive/',
        ]);

        $response = $this->api->p21Sism->scheduledImportMaster->createMetadataSftp('SIM003', [
            'sftpHost' => 'secure-sftp.example.com',
            'sftpPort' => 2222,
            'sftpUsername' => 'batch_user',
            'remotePath' => '/data/imports/',
            'filePattern' => '*.csv',
            'archivePath' => '/data/archive/',
        ]);

        $this->assertEquals('SIM003', self::at($response->data, 'scheduledImportMasterUid'));
        $this->assertEquals('secure-sftp.example.com', self::at($response->data, 'sftpHost'));
        $this->assertEquals('*.csv', self::at($response->data, 'filePattern'));
        $this->assertEquals('/data/archive/', self::at($response->data, 'archivePath'));
    }
}
