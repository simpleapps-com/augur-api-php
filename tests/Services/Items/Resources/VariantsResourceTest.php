<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for VariantsResource.
 *
 * @covers \AugurApi\Services\Items\Resources\VariantsResource
 */
final class VariantsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['itemVariantHdrUid' => 1, 'name' => 'Variant A'],
            ['itemVariantHdrUid' => 2, 'name' => 'Variant B'],
        ]);

        $response = $this->api->items->variants->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['itemVariantHdrUid']);
        $this->assertEquals('Variant A', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/variants');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['itemVariantHdrUid' => 1, 'name' => 'Variant A'],
        ], 10);

        $response = $this->api->items->variants->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertEquals(10, $response->total);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'itemVariantHdrUid' => 1,
            'name' => 'Variant A',
            'description' => 'Product variant A',
        ]);

        $response = $this->api->items->variants->get(1);

        $this->assertEquals(1, $response->data['itemVariantHdrUid']);
        $this->assertEquals('Variant A', $response->data['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/variants/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse(['itemVariantHdrUid' => 3, 'name' => 'New Variant']);

        $response = $this->api->items->variants->create(['name' => 'New Variant']);

        $this->assertEquals(3, $response->data['itemVariantHdrUid']);
        $this->assertEquals('New Variant', $response->data['name']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/variants');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['itemVariantHdrUid' => 1, 'name' => 'Updated Variant']);

        $response = $this->api->items->variants->update(1, ['name' => 'Updated Variant']);

        $this->assertEquals('Updated Variant', $response->data['name']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/variants/1');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->items->variants->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/variants/1');
    }

    public function testGetDoc(): void
    {
        $this->mockResponse([
            'itemVariantHdrUid' => 1,
            'documents' => [
                ['docUid' => 1, 'docType' => 'pdf'],
                ['docUid' => 2, 'docType' => 'image'],
            ],
        ]);

        $response = $this->api->items->variants->getDoc(1);

        $this->assertEquals(1, $response->data['itemVariantHdrUid']);
        $this->assertCount(2, $response->data['documents']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/variants/1/doc');
    }

    public function testGetSimilar(): void
    {
        $this->mockListResponse([
            ['invMastUid' => 400, 'itemId' => 'SIM001', 'similarity' => 0.95],
            ['invMastUid' => 401, 'itemId' => 'SIM002', 'similarity' => 0.85],
        ]);

        $response = $this->api->items->variants->getSimilar(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('SIM001', $response->data[0]['itemId']);
        $this->assertEquals(0.95, $response->data[0]['similarity']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/variants/1/similar');
    }

    public function testListLines(): void
    {
        $this->mockListResponse([
            ['itemVariantLineUid' => 1, 'invMastUid' => 100],
            ['itemVariantLineUid' => 2, 'invMastUid' => 101],
        ]);

        $response = $this->api->items->variants->listLines(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals(100, $response->data[0]['invMastUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/variants/1/lines');
    }

    public function testGetLine(): void
    {
        $this->mockResponse([
            'itemVariantLineUid' => 1,
            'invMastUid' => 100,
            'sortOrder' => 1,
        ]);

        $response = $this->api->items->variants->getLine(1, 1);

        $this->assertEquals(1, $response->data['itemVariantLineUid']);
        $this->assertEquals(100, $response->data['invMastUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/variants/1/lines/1');
    }

    public function testCreateLine(): void
    {
        $this->mockResponse(['itemVariantLineUid' => 3, 'invMastUid' => 102]);

        $response = $this->api->items->variants->createLine(1, ['invMastUid' => 102]);

        $this->assertEquals(3, $response->data['itemVariantLineUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/variants/1/lines');
    }

    public function testUpdateLine(): void
    {
        $this->mockResponse(['itemVariantLineUid' => 1, 'sortOrder' => 5]);

        $response = $this->api->items->variants->updateLine(1, 1, ['sortOrder' => 5]);

        $this->assertEquals(5, $response->data['sortOrder']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/variants/1/lines/1');
    }

    public function testDeleteLine(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->items->variants->deleteLine(1, 1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/variants/1/lines/1');
    }

    public function testListAttributes(): void
    {
        $this->mockListResponse([
            ['attributeUid' => 10, 'name' => 'Color'],
            ['attributeUid' => 11, 'name' => 'Size'],
        ]);

        $response = $this->api->items->variants->listAttributes(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Color', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/variants/1/attributes');
    }

    public function testListAttributesWithParams(): void
    {
        $this->mockListResponse([
            ['attributeUid' => 10, 'name' => 'Color'],
        ]);

        $response = $this->api->items->variants->listAttributes(1, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testGetAttribute(): void
    {
        $this->mockResponse([
            'attributeUid' => 10,
            'name' => 'Color',
            'value' => 'Red',
        ]);

        $response = $this->api->items->variants->getAttribute(1, 10);

        $this->assertEquals(10, $response->data['attributeUid']);
        $this->assertEquals('Red', $response->data['value']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/variants/1/attributes/10');
    }

    public function testCreateAttribute(): void
    {
        $this->mockResponse(['attributeUid' => 12, 'value' => 'Medium']);

        $response = $this->api->items->variants->createAttribute(1, ['attributeUid' => 12, 'value' => 'Medium']);

        $this->assertEquals(12, $response->data['attributeUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/variants/1/attributes');
    }

    public function testUpdateAttribute(): void
    {
        $this->mockResponse(['attributeUid' => 10, 'value' => 'Blue']);

        $response = $this->api->items->variants->updateAttribute(1, 10, ['value' => 'Blue']);

        $this->assertEquals('Blue', $response->data['value']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/variants/1/attributes/10');
    }

    public function testDeleteAttribute(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->items->variants->deleteAttribute(1, 10);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/variants/1/attributes/10');
    }
}
