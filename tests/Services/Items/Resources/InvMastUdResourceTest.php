<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for InvMastUdResource.
 *
 * @covers \AugurApi\Services\Items\Resources\InvMastUdResource
 */
final class InvMastUdResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invMastUdUid' => 1, 'invMastUid' => 100, 'field1' => 'value1'],
            ['invMastUdUid' => 2, 'invMastUid' => 101, 'field1' => 'value2'],
        ]);

        $response = $this->api->items->invMastUd->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['invMastUdUid']);
        $this->assertEquals(100, $response->data[0]['invMastUid']);
        $this->assertEquals('value1', $response->data[0]['field1']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast-ud');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invMastUdUid' => 1, 'invMastUid' => 100],
        ], 50);

        $response = $this->api->items->invMastUd->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
