<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for InvMastSubPartsResource.
 *
 * @covers \AugurApi\Services\Items\Resources\InvMastSubPartsResource
 */
final class InvMastSubPartsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['subPartUid' => 1, 'subPartInvMastUid' => 200, 'qty' => 2],
            ['subPartUid' => 2, 'subPartInvMastUid' => 201, 'qty' => 1],
        ]);

        $response = $this->api->items->invMastSubParts->list(100);

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['subPartUid']);
        $this->assertEquals(200, $response->data[0]['subPartInvMastUid']);
        $this->assertEquals(2, $response->data[0]['qty']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast-sub-parts/100');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
