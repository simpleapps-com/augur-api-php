<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Orders\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class PoLineResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['poLineUid' => 1, 'poNo' => 5001.0, 'lineNo' => 1.0, 'invMastUid' => 100, 'qtyOrdered' => 10.0],
            ['poLineUid' => 2, 'poNo' => 5001.0, 'lineNo' => 2.0, 'invMastUid' => 101, 'qtyOrdered' => 5.0],
        ]);

        $response = $this->api->orders->poLine->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['poLineUid']);
        $this->assertEquals(100, $response->data[0]['invMastUid']);
        $this->assertRequestPath('/po-line');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['poLineUid' => 1, 'poNo' => 5001.0, 'invMastUid' => 100],
        ], 25);

        $response = $this->api->orders->poLine->list([
            'invMastUid' => 100,
            'poNo' => 5001,
            'limit' => 10,
            'offset' => 0,
        ]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(25, $response->total);
        $query = $this->getLastRequest()->getUri()->getQuery();
        $this->assertStringContainsString('invMastUid=100', $query);
        $this->assertStringContainsString('poNo=5001', $query);
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'poLineUid' => 1,
            'poNo' => 5001.0,
            'lineNo' => 1.0,
            'invMastUid' => 100,
            'qtyOrdered' => 10.0,
            'qtyReceived' => 4.0,
            'unitPrice' => 12.5,
        ]);

        $response = $this->api->orders->poLine->get(1);

        $this->assertEquals(1, $response->data['poLineUid']);
        $this->assertEquals(10.0, $response->data['qtyOrdered']);
        $this->assertRequestPath('/po-line/1');
        $this->assertRequestMethod('GET');
    }
}
