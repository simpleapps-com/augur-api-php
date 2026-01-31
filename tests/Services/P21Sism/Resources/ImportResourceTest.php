<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Sism\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ImportResource.
 *
 * @covers \AugurApi\Services\P21Sism\Resources\ImportResource
 */
final class ImportResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['importUid' => 'IMP001', 'status' => 'pending', 'createdAt' => '2024-01-15'],
            ['importUid' => 'IMP002', 'status' => 'completed', 'createdAt' => '2024-01-14'],
        ]);

        $response = $this->api->p21Sism->import->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals('IMP001', $response->data[0]['importUid']);
        $this->assertEquals('pending', $response->data[0]['status']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/import');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['importUid' => 'IMP001', 'status' => 'pending'],
        ], 50);

        $response = $this->api->p21Sism->import->list(['status' => 'pending', 'limit' => 25]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'importUid' => 'IMP001',
            'status' => 'pending',
            'createdAt' => '2024-01-15',
            'lineCount' => 25,
        ]);

        $response = $this->api->p21Sism->import->get('IMP001');

        $this->assertEquals('IMP001', $response->data['importUid']);
        $this->assertEquals('pending', $response->data['status']);
        $this->assertEquals(25, $response->data['lineCount']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/import/IMP001');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'importUid' => 'IMP001',
            'status' => 'processing',
        ]);

        $response = $this->api->p21Sism->import->update('IMP001', [
            'status' => 'processing',
        ]);

        $this->assertEquals('processing', $response->data['status']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/import/IMP001');
    }

    public function testDelete(): void
    {
        $this->mockResponse([
            'success' => true,
        ]);

        $response = $this->api->p21Sism->import->delete('IMP001');

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/import/IMP001');
    }

    public function testListRecent(): void
    {
        $this->mockListResponse([
            ['importUid' => 'IMP001', 'status' => 'completed', 'completedAt' => '2024-01-15T10:00:00Z'],
            ['importUid' => 'IMP002', 'status' => 'completed', 'completedAt' => '2024-01-14T15:30:00Z'],
        ]);

        $response = $this->api->p21Sism->import->listRecent();

        $this->assertCount(2, $response->data);
        $this->assertEquals('IMP001', $response->data[0]['importUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/import/recent');
    }

    public function testListRecentWithParams(): void
    {
        $this->mockListResponse([
            ['importUid' => 'IMP001', 'status' => 'completed'],
        ]);

        $response = $this->api->p21Sism->import->listRecent(['limit' => 5, 'days' => 7]);

        $this->assertCount(1, $response->data);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListStuck(): void
    {
        $this->mockListResponse([
            ['importUid' => 'IMP003', 'status' => 'stuck', 'stuckSince' => '2024-01-10'],
        ]);

        $response = $this->api->p21Sism->import->listStuck();

        $this->assertCount(1, $response->data);
        $this->assertEquals('stuck', $response->data[0]['status']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/import/stuck');
    }

    public function testListStuckWithParams(): void
    {
        $this->mockListResponse([
            ['importUid' => 'IMP003', 'status' => 'stuck'],
            ['importUid' => 'IMP004', 'status' => 'stuck'],
        ], 10);

        $response = $this->api->p21Sism->import->listStuck(['hours' => 24]);

        $this->assertCount(2, $response->data);
        $this->assertEquals(10, $response->total);
    }

    public function testGetImpOeHdr(): void
    {
        $this->mockResponse([
            'importUid' => 'IMP001',
            'customerId' => 'CUST001',
            'orderDate' => '2024-01-15',
            'totalAmount' => 1500.00,
        ]);

        $response = $this->api->p21Sism->import->getImpOeHdr('IMP001');

        $this->assertEquals('IMP001', $response->data['importUid']);
        $this->assertEquals('CUST001', $response->data['customerId']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/import/IMP001/imp-oe-hdr');
    }

    public function testUpdateImpOeHdr(): void
    {
        $this->mockResponse([
            'importUid' => 'IMP001',
            'customerId' => 'CUST002',
            'shipVia' => 'EXPRESS',
        ]);

        $response = $this->api->p21Sism->import->updateImpOeHdr('IMP001', [
            'customerId' => 'CUST002',
            'shipVia' => 'EXPRESS',
        ]);

        $this->assertEquals('CUST002', $response->data['customerId']);
        $this->assertEquals('EXPRESS', $response->data['shipVia']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/import/IMP001/imp-oe-hdr');
    }

    public function testGetImpOeHdrSalesrep(): void
    {
        $this->mockResponse([
            'importUid' => 'IMP001',
            'salesrepId' => 'REP001',
            'salesrepName' => 'John Doe',
            'commission' => 5.0,
        ]);

        $response = $this->api->p21Sism->import->getImpOeHdrSalesrep('IMP001');

        $this->assertEquals('IMP001', $response->data['importUid']);
        $this->assertEquals('REP001', $response->data['salesrepId']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/import/IMP001/imp-oe-hdr-salesrep');
    }

    public function testUpdateImpOeHdrSalesrep(): void
    {
        $this->mockResponse([
            'importUid' => 'IMP001',
            'salesrepId' => 'REP002',
            'commission' => 7.5,
        ]);

        $response = $this->api->p21Sism->import->updateImpOeHdrSalesrep('IMP001', [
            'salesrepId' => 'REP002',
            'commission' => 7.5,
        ]);

        $this->assertEquals('REP002', $response->data['salesrepId']);
        $this->assertEquals(7.5, $response->data['commission']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/import/IMP001/imp-oe-hdr-salesrep');
    }

    public function testGetImpOeHdrWeb(): void
    {
        $this->mockResponse([
            'importUid' => 'IMP001',
            'webOrderId' => 'WEB12345',
            'source' => 'ecommerce',
            'ipAddress' => '192.168.1.1',
        ]);

        $response = $this->api->p21Sism->import->getImpOeHdrWeb('IMP001');

        $this->assertEquals('IMP001', $response->data['importUid']);
        $this->assertEquals('WEB12345', $response->data['webOrderId']);
        $this->assertEquals('ecommerce', $response->data['source']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/import/IMP001/imp-oe-hdr-web');
    }
}
