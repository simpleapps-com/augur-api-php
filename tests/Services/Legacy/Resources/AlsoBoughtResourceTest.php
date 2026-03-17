<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Legacy\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AlsoBoughtResource.
 */
final class AlsoBoughtResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['itemId' => 'ITEM001', 'purchaseCount' => 50],
            ['itemId' => 'ITEM002', 'purchaseCount' => 30],
        ]);

        $response = $this->api->legacy->invMast->listAlsoBought(12345);

        $this->assertCount(2, $response->data);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('ITEM001', $data[0]['itemId']);

        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals(50, $data[0]['purchaseCount']);
        $this->assertRequestPath('/inv-mast/12345/also-bought');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['itemId' => 'ITEM001', 'purchaseCount' => 50],
        ]);

        $response = $this->api->legacy->invMast->listAlsoBought(12345, ['limit' => 10]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/inv-mast/12345/also-bought');
    }
}
