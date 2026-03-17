<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Logistics\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class SpeedshipResourceTest extends AugurApiTestCase
{
    public function testListFreight(): void
    {
        $this->mockResponse([
            'freightQuotes' => [
                ['carrier' => 'ABF', 'rate' => 350.00, 'transitDays' => 5],
                ['carrier' => 'ODFL', 'rate' => 400.00, 'transitDays' => 3],
            ],
        ]);

        $response = $this->api->logistics->speedship->listFreight([
            'fromAddressLine' => '123 Test St',
            'fromCity' => 'LA',
            'fromPostalCode' => '12345',
            'fromCountryCode' => 'US',
        ]);

        $this->assertCount(2, $response->data['freightQuotes']);
        $this->assertEquals('ABF', $response->data['freightQuotes'][0]['carrier']);
        $this->assertRequestPath('/speedship/freight');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }
}
