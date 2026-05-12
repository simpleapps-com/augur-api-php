<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Logistics\Resources;

use AugurApi\Tests\AugurApiTestCase;

final class RtsResourceTest extends AugurApiTestCase
{
    public function testListBrands(): void
    {
        $this->mockListResponse([['id' => 1, 'name' => 'Brand A']]);

        $response = $this->api->logistics->rts->listBrands();

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/rts/brands');
        $this->assertRequestMethod('GET');
        $this->assertHasAuthHeader();
    }

    public function testListBrandsMachines(): void
    {
        $this->mockListResponse([['id' => 1, 'model' => 'M1']]);

        $response = $this->api->logistics->rts->listBrandsMachines(1);

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/rts/brands/1/machines');
        $this->assertRequestMethod('GET');
    }

    public function testListMachinesTracks(): void
    {
        $this->mockListResponse([['id' => 1, 'name' => 'T1']]);

        $response = $this->api->logistics->rts->listMachinesTracks(1);

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/rts/machines/1/tracks');
        $this->assertRequestMethod('GET');
    }

    public function testListSearchMachines(): void
    {
        $this->mockListResponse([['id' => 1, 'model' => 'M1']]);

        $response = $this->api->logistics->rts->listSearchMachines();

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/rts/search/machines');
        $this->assertRequestMethod('GET');
    }

    public function testListTrack(): void
    {
        $this->mockResponse(['id' => 123, 'status' => 'in_transit']);

        $response = $this->api->logistics->rts->listTrack(123);

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/rts/track/123');
        $this->assertRequestMethod('GET');
    }

    public function testListTracks(): void
    {
        $this->mockListResponse([['id' => 1, 'status' => 'delivered']]);

        $response = $this->api->logistics->rts->listTracks();

        $this->assertEquals(200, $response->status);
        $this->assertRequestPath('/rts/tracks');
        $this->assertRequestMethod('GET');
    }
}
