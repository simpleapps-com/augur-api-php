<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Vmi\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for InvProfileHdrResource.
 *
 * @covers \AugurApi\Services\Vmi\Resources\InvProfileHdrResource
 */
final class InvProfileHdrResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invProfileHdrUid' => 1, 'name' => 'Profile A', 'customerId' => 100],
            ['invProfileHdrUid' => 2, 'name' => 'Profile B', 'customerId' => 200],
        ]);

        $response = $this->api->vmi->invProfileHdr->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['invProfileHdrUid']);
        $this->assertEquals('Profile A', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-profile-hdr');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invProfileHdrUid' => 1, 'name' => 'Profile A'],
        ], 50);

        $response = $this->api->vmi->invProfileHdr->list(['customerId' => 100, 'limit' => 25]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'invProfileHdrUid' => 1,
            'name' => 'Profile A',
            'customerId' => 100,
            'active' => true,
        ]);

        $response = $this->api->vmi->invProfileHdr->get(1);

        $this->assertEquals(1, $response->data['invProfileHdrUid']);
        $this->assertEquals('Profile A', $response->data['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-profile-hdr/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'invProfileHdrUid' => 3,
            'name' => 'New Profile',
            'customerId' => 300,
        ]);

        $response = $this->api->vmi->invProfileHdr->create([
            'name' => 'New Profile',
            'customerId' => 300,
        ]);

        $this->assertEquals(3, $response->data['invProfileHdrUid']);
        $this->assertEquals('New Profile', $response->data['name']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/inv-profile-hdr');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'invProfileHdrUid' => 1,
            'name' => 'Updated Profile',
        ]);

        $response = $this->api->vmi->invProfileHdr->update(1, [
            'name' => 'Updated Profile',
        ]);

        $this->assertEquals('Updated Profile', $response->data['name']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/inv-profile-hdr/1');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->vmi->invProfileHdr->delete(1);

        $this->assertTrue($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/inv-profile-hdr/1');
    }

    public function testUploadCreate(): void
    {
        $this->mockResponse([
            'customerId' => 100,
            'profilesCreated' => 5,
            'status' => 'success',
        ]);

        $response = $this->api->vmi->invProfileHdr->uploadCreate(100);

        $this->assertEquals(100, $response->data['customerId']);
        $this->assertEquals(5, $response->data['profilesCreated']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/inv-profile-hdr/100/upload');
    }

    public function testListInvProfileLine(): void
    {
        $this->mockListResponse([
            ['invProfileLineUid' => 1, 'invMastUid' => 1000, 'minQty' => 10],
            ['invProfileLineUid' => 2, 'invMastUid' => 1001, 'minQty' => 20],
        ]);

        $response = $this->api->vmi->invProfileHdr->listInvProfileLine(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['invProfileLineUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-profile-hdr/1/inv-profile-line');
    }

    public function testListInvProfileLineWithParams(): void
    {
        $this->mockListResponse([
            ['invProfileLineUid' => 1, 'invMastUid' => 1000],
        ], 100);

        $response = $this->api->vmi->invProfileHdr->listInvProfileLine(1, ['limit' => 50]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(100, $response->total);
    }

    public function testGetInvProfileLine(): void
    {
        $this->mockResponse([
            'invProfileLineUid' => 1,
            'invMastUid' => 1000,
            'minQty' => 10,
            'maxQty' => 100,
        ]);

        $response = $this->api->vmi->invProfileHdr->getInvProfileLine(1, 1);

        $this->assertEquals(1, $response->data['invProfileLineUid']);
        $this->assertEquals(1000, $response->data['invMastUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-profile-hdr/1/inv-profile-line/1');
    }

    public function testCreateInvProfileLine(): void
    {
        $this->mockResponse([
            'invProfileLineUid' => 3,
            'invMastUid' => 1002,
            'minQty' => 15,
        ]);

        $response = $this->api->vmi->invProfileHdr->createInvProfileLine(1, [
            'invMastUid' => 1002,
            'minQty' => 15,
        ]);

        $this->assertEquals(3, $response->data['invProfileLineUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/inv-profile-hdr/1/inv-profile-line');
    }

    public function testUpdateInvProfileLine(): void
    {
        $this->mockResponse([
            'invProfileLineUid' => 1,
            'minQty' => 25,
        ]);

        $response = $this->api->vmi->invProfileHdr->updateInvProfileLine(1, 1, [
            'minQty' => 25,
        ]);

        $this->assertEquals(25, $response->data['minQty']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/inv-profile-hdr/1/inv-profile-line/1');
    }

    public function testDeleteInvProfileLine(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->vmi->invProfileHdr->deleteInvProfileLine(1, 1);

        $this->assertTrue($response->data);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/inv-profile-hdr/1/inv-profile-line/1');
    }
}
