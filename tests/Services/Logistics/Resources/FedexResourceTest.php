<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Logistics\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class FedexResourceTest extends AugurApiTestCase
{
    public function testListRates(): void
    {
        $this->mockResponse([
            'rates' => [
                ['service' => 'FedEx Ground', 'rate' => 15.99, 'days' => 5],
            ],
        ]);

        $response = $this->api->logistics->fedex->listRates([
            'fromPostalCode' => '12345',
            'toPostalCode' => '67890',
            'totalWeight' => 10,
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/fedex/rates');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }
}
