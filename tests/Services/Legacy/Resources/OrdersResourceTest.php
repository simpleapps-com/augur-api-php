<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Legacy\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for OrdersResource.
 */
final class OrdersResourceTest extends AugurApiTestCase
{
    public function testReset(): void
    {
        $this->mockResponse([
            'orderId' => 12345,
            'reset' => true,
            'message' => 'Order reset for reprocessing',
        ]);

        $response = $this->api->legacy->orders->reset(12345);

        $this->assertTrue($response->data['reset']);
        $this->assertEquals('Order reset for reprocessing', $response->data['message']);
        $this->assertRequestPath('/orders/12345/reset');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
