<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for ItemUomResource.
 *
 * @covers \AugurApi\Services\Items\Resources\ItemUomResource
 */
final class ItemUomResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['itemUomUid' => 1, 'uomCode' => 'EA', 'description' => 'Each'],
            ['itemUomUid' => 2, 'uomCode' => 'BX', 'description' => 'Box'],
        ]);

        $response = $this->api->items->itemUom->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['itemUomUid']);
        $this->assertEquals('EA', $response->data[0]['uomCode']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-uom');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['itemUomUid' => 1, 'uomCode' => 'EA'],
        ], 50);

        $response = $this->api->items->itemUom->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(50, $response->total);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'itemUomUid' => 1,
            'uomCode' => 'EA',
            'description' => 'Each',
            'conversionFactor' => 1.0,
        ]);

        $response = $this->api->items->itemUom->get(1);

        $this->assertEquals(1, $response->data['itemUomUid']);
        $this->assertEquals('EA', $response->data['uomCode']);
        $this->assertEquals(1.0, $response->data['conversionFactor']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/item-uom/1');
    }
}
