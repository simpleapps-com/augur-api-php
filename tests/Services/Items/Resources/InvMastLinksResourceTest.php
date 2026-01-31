<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for InvMastLinksResource.
 *
 * @covers \AugurApi\Services\Items\Resources\InvMastLinksResource
 */
final class InvMastLinksResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['linkUid' => 1, 'linkedInvMastUid' => 200, 'linkType' => 'related'],
            ['linkUid' => 2, 'linkedInvMastUid' => 201, 'linkType' => 'accessory'],
        ]);

        $response = $this->api->items->invMastLinks->list(100);

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['linkUid']);
        $this->assertEquals(200, $response->data[0]['linkedInvMastUid']);
        $this->assertEquals('related', $response->data[0]['linkType']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast-links/100');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
