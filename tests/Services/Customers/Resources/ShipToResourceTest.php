<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Customers\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ShipToResource.
 */
final class ShipToResourceTest extends AugurApiTestCase
{
    public function testGetRefresh(): void
    {
        $this->mockResponse(['refreshed' => true, 'timestamp' => '2024-01-15T12:00:00Z']);

        $response = $this->api->customers->shipTo->getRefresh();

        $this->assertTrue($response->data['refreshed']);
        $this->assertRequestPath('/ship-to/refresh');
        $this->assertRequestMethod('GET');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
