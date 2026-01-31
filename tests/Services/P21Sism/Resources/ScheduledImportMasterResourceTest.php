<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Sism\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ScheduledImportMasterResource.
 *
 * @covers \AugurApi\Services\P21Sism\Resources\ScheduledImportMasterResource
 */
final class ScheduledImportMasterResourceTest extends AugurApiTestCase
{
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

        $this->assertEquals('SIM001', $response->data['scheduledImportMasterUid']);
        $this->assertEquals('sftp.example.com', $response->data['sftpHost']);
        $this->assertEquals(22, $response->data['sftpPort']);
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

        $this->assertEquals('SIM002', $response->data['scheduledImportMasterUid']);
        $this->assertFalse($response->data['configured']);
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

        $this->assertEquals('SIM003', $response->data['scheduledImportMasterUid']);
        $this->assertEquals('secure-sftp.example.com', $response->data['sftpHost']);
        $this->assertEquals('*.csv', $response->data['filePattern']);
        $this->assertEquals('/data/archive/', $response->data['archivePath']);
    }
}
