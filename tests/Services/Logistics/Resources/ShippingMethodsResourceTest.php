<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Logistics\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class ShippingMethodsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([['shippingMethodsUid' => 1, 'shippingType' => 'LTL']]);

        $response = $this->api->logistics->shippingMethods->list();

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/shipping-methods');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([['shippingMethodsUid' => 1, 'shippingType' => 'LTL']]);

        $response = $this->api->logistics->shippingMethods->list([
            'shippingType' => 'LTL',
            'statusCd' => 1,
        ]);

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/shipping-methods');
        $this->assertRequestMethod('GET');
    }

    public function testGet(): void
    {
        $this->mockResponse(['shippingMethodsUid' => 4321, 'shippingType' => 'LTL']);

        $response = $this->api->logistics->shippingMethods->get(4321);

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/shipping-methods/4321');
        $this->assertRequestMethod('GET');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['shippingMethodsUid' => 4321, 'shippingType' => 'PARCEL']);

        $response = $this->api->logistics->shippingMethods->update(4321, ['shippingType' => 'PARCEL']);

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/shipping-methods/4321');
        $this->assertRequestMethod('PUT');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->logistics->shippingMethods->delete(4321);

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/shipping-methods/4321');
        $this->assertRequestMethod('DELETE');
    }
}
