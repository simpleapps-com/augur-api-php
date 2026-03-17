<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Logistics\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class UpsResourceTest extends AugurApiTestCase
{
    public function testListRates(): void
    {
        $this->mockResponse([
            'rates' => [
                ['service' => 'Ground', 'rate' => 12.99],
            ],
        ]);

        $response = $this->api->logistics->ups->listRates([
            'fromAddress1' => '123 Test St',
            'fromCity' => 'LA',
            'fromPostalCode' => '90210',
            'fromStateProvinceCode' => 'CA',
            'toAddress1' => '456 Ave',
            'toCity' => 'NY',
            'toPostalCode' => '10001',
            'toStateProvinceCode' => 'NY',
            'weight' => 10,
        ]);

        $this->assertCount(1, $response->data['rates']);
        $this->assertRequestPath('/ups/rates');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }
}
