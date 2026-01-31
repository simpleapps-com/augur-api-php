<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Pim\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for InvMastExtResource.
 *
 * @covers \AugurApi\Services\P21Pim\Resources\InvMastExtResource
 */
final class InvMastExtResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invMastExtUid' => 1, 'invMastUid' => 100, 'extField1' => 'Value 1'],
            ['invMastExtUid' => 2, 'invMastUid' => 101, 'extField1' => 'Value 2'],
        ]);

        $response = $this->api->p21Pim->invMastExt->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['invMastExtUid']);
        $this->assertEquals(100, $response->data[0]['invMastUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast-ext');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invMastExtUid' => 1, 'invMastUid' => 100],
        ], 50);

        $response = $this->api->p21Pim->invMastExt->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'invMastExtUid' => 1,
            'invMastUid' => 100,
            'extField1' => 'Custom Value',
            'extField2' => 'Another Value',
        ]);

        $response = $this->api->p21Pim->invMastExt->get(1);

        $this->assertEquals(1, $response->data['invMastExtUid']);
        $this->assertEquals(100, $response->data['invMastUid']);
        $this->assertEquals('Custom Value', $response->data['extField1']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast-ext/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'invMastExtUid' => 3,
            'invMastUid' => 102,
            'extField1' => 'New Value',
        ]);

        $response = $this->api->p21Pim->invMastExt->create([
            'invMastUid' => 102,
            'extField1' => 'New Value',
        ]);

        $this->assertEquals(3, $response->data['invMastExtUid']);
        $this->assertEquals(102, $response->data['invMastUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/inv-mast-ext');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'invMastExtUid' => 1,
            'invMastUid' => 100,
            'extField1' => 'Updated Value',
        ]);

        $response = $this->api->p21Pim->invMastExt->update(1, [
            'extField1' => 'Updated Value',
        ]);

        $this->assertEquals('Updated Value', $response->data['extField1']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/inv-mast-ext/1');
    }

    public function testDelete(): void
    {
        $this->mockResponse([
            'success' => true,
        ]);

        $response = $this->api->p21Pim->invMastExt->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/inv-mast-ext/1');
    }
}
