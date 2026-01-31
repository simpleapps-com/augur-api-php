<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Sism\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ImpOeLineResource.
 *
 * @covers \AugurApi\Services\P21Sism\Resources\ImpOeLineResource
 */
final class ImpOeLineResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['importUid' => 1, 'lineNo' => 1, 'itemId' => 'ITEM001', 'quantity' => 10],
            ['importUid' => 1, 'lineNo' => 2, 'itemId' => 'ITEM002', 'quantity' => 5],
        ]);

        $response = $this->api->p21Sism->impOeLine->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['importUid']);
        $this->assertEquals(1, $response->data[0]['lineNo']);
        $this->assertEquals('ITEM001', $response->data[0]['itemId']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/imp_oe_line');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['importUid' => 1, 'lineNo' => 1, 'itemId' => 'ITEM001'],
        ], 100);

        $response = $this->api->p21Sism->impOeLine->list(['importUid' => 1, 'limit' => 50]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(100, $response->total);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'importUid' => 1,
            'lineNo' => 1,
            'itemId' => 'ITEM001',
            'quantity' => 10,
            'unitPrice' => 25.50,
            'status' => 'pending',
        ]);

        $response = $this->api->p21Sism->impOeLine->get(1, 1);

        $this->assertEquals(1, $response->data['importUid']);
        $this->assertEquals(1, $response->data['lineNo']);
        $this->assertEquals('ITEM001', $response->data['itemId']);
        $this->assertEquals(10, $response->data['quantity']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/imp_oe_line/1/1');
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'importUid' => 1,
            'lineNo' => 1,
            'itemId' => 'ITEM001',
            'quantity' => 20,
            'unitPrice' => 30.00,
        ]);

        $response = $this->api->p21Sism->impOeLine->update(1, 1, [
            'quantity' => 20,
            'unitPrice' => 30.00,
        ]);

        $this->assertEquals(20, $response->data['quantity']);
        $this->assertEquals(30.00, $response->data['unitPrice']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/imp_oe_line/1/1');
    }

    public function testUpdateWithMultipleFields(): void
    {
        $this->mockResponse([
            'importUid' => 2,
            'lineNo' => 3,
            'itemId' => 'ITEM003',
            'quantity' => 15,
            'notes' => 'Updated notes',
        ]);

        $response = $this->api->p21Sism->impOeLine->update(2, 3, [
            'quantity' => 15,
            'notes' => 'Updated notes',
        ]);

        $this->assertEquals(2, $response->data['importUid']);
        $this->assertEquals(3, $response->data['lineNo']);
        $this->assertEquals('Updated notes', $response->data['notes']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
