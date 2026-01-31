<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ContractsResource.
 *
 * @covers \AugurApi\Services\Items\Resources\ContractsResource
 */
final class ContractsResourceTest extends AugurApiTestCase
{
    public function testListAttributes(): void
    {
        $this->mockListResponse([
            ['attributeUid' => 1, 'name' => 'Contract Type'],
            ['attributeUid' => 2, 'name' => 'Discount Level'],
        ]);

        $response = $this->api->items->contracts->listAttributes(12345);

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['attributeUid']);
        $this->assertEquals('Contract Type', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/contracts/12345/attributes');
    }

    public function testListItems(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100, 'itemId' => 'ITEM001', 'contractPrice' => 99.99],
            ['invMastUid' => 101, 'itemId' => 'ITEM002', 'contractPrice' => 149.99],
        ], 50);

        $response = $this->api->items->contracts->listItems(12345);

        $this->assertCount(2, $response->data);
        $this->assertEquals('ITEM001', $response->data[0]['itemId']);
        $this->assertEquals(99.99, $response->data[0]['contractPrice']);
        $this->assertEquals(50, $response->total);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/contracts/12345/items');
    }

    public function testListItemsWithParams(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 100, 'itemId' => 'ITEM001'],
        ], 100);

        $response = $this->api->items->contracts->listItems(12345, ['limit' => 25, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(100, $response->total);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
