<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Pim\Resources;

use AugurApi\Services\P21Pim\Resources\InvMastTextResource;
use AugurApi\Tests\AugurApiTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Tests for InvMastTextResource.
 */
#[CoversClass(InvMastTextResource::class)]
final class InvMastTextResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['invMastTextUid' => 1, 'invMastUid' => 100, 'webDisplayTypeUid' => 7],
            ['invMastTextUid' => 2, 'invMastUid' => 101, 'webDisplayTypeUid' => 8],
        ]);

        $response = $this->api->p21Pim->invMastText->list();

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(1, $data[0]['invMastTextUid']);
        $this->assertEquals(7, $data[0]['webDisplayTypeUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast-text');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['invMastTextUid' => 1, 'invMastUid' => 100],
        ], 50);

        $response = $this->api->p21Pim->invMastText->list([
            'invMastUid' => 100,
            'webDisplayTypeUid' => 7,
        ]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
        $this->assertRequestPath('/inv-mast-text');
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'invMastTextUid' => 1,
            'invMastUid' => 100,
            'webDisplayTypeUid' => 7,
        ]);

        $response = $this->api->p21Pim->invMastText->get(1);

        $this->assertEquals(1, $response->data['invMastTextUid']);
        $this->assertEquals(7, $response->data['webDisplayTypeUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/inv-mast-text/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse([
            'invMastTextUid' => 3,
            'invMastUid' => 102,
        ]);

        $response = $this->api->p21Pim->invMastText->create([
            'invMastUid' => 102,
            'webDisplayTypeUid' => 7,
        ]);

        $this->assertEquals(3, $response->data['invMastTextUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/inv-mast-text');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'invMastTextUid' => 1,
            'webDisplayTypeUid' => 9,
        ]);

        $response = $this->api->p21Pim->invMastText->update(1, ['webDisplayTypeUid' => 9]);

        $this->assertEquals(9, $response->data['webDisplayTypeUid']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/inv-mast-text/1');
    }

    public function testDelete(): void
    {
        $this->mockResponse(['success' => true]);

        $response = $this->api->p21Pim->invMastText->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/inv-mast-text/1');
    }
}
