<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for purchased-items endpoints on CustomerResource.
 */
final class PurchasedItemsResourceTest extends AugurApiTestCase
{
    public function testListPurchasedItems(): void
    {
        $this->mockListResponse([
            ['itemId' => 'ITEM001', 'quantity' => 10, 'lastPurchaseDate' => '2024-01-10'],
            ['itemId' => 'ITEM002', 'quantity' => 5, 'lastPurchaseDate' => '2024-01-12'],
        ]);

        $response = $this->api->customers->customer->listPurchasedItems(1001);

        $this->assertCount(2, $response->data);
        /** @var list<array<string, mixed>> $data */
        $data = $response->data;
        $this->assertEquals('ITEM001', $data[0]['itemId']);
        $this->assertEquals(10, $data[0]['quantity']);
        $this->assertRequestPath('/customer/1001/purchased-items');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListPurchasedItemsWithParams(): void
    {
        $this->mockListResponse([
            ['itemId' => 'ITEM001', 'quantity' => 10],
        ]);

        $response = $this->api->customers->customer->listPurchasedItems(1001, ['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/1001/purchased-items');
    }
}
