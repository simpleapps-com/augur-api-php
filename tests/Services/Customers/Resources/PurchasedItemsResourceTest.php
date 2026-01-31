<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for PurchasedItemsResource.
 */
final class PurchasedItemsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['itemId' => 'ITEM001', 'quantity' => 10, 'lastPurchaseDate' => '2024-01-10'],
            ['itemId' => 'ITEM002', 'quantity' => 5, 'lastPurchaseDate' => '2024-01-12'],
        ]);

        $response = $this->api->customers->purchasedItems->list(1001);

        $this->assertCount(2, $response->data);
        $this->assertEquals('ITEM001', $response->data[0]['itemId']);
        $this->assertEquals(10, $response->data[0]['quantity']);
        $this->assertRequestPath('/customer/1001/purchased-items');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['itemId' => 'ITEM001', 'quantity' => 10],
        ]);

        $response = $this->api->customers->purchasedItems->list(1001, ['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertRequestPath('/customer/1001/purchased-items');
    }
}
