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
    public function testGet(): void
    {
        $this->mockListResponse([
            ['linkUid' => 1, 'linkedInvMastUid' => 200, 'linkType' => 'related'],
            ['linkUid' => 2, 'linkedInvMastUid' => 201, 'linkType' => 'accessory'],
        ]);

        $response = $this->api->items->invMastLinks->get(100);

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1, $data[0]['linkUid']);
        $this->assertEquals(200, $data[0]['linkedInvMastUid']);
        $this->assertEquals('related', $data[0]['linkType']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast-links/100');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
