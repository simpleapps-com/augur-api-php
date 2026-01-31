<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AttributesResource.
 *
 * @covers \AugurApi\Services\Items\Resources\AttributesResource
 */
final class AttributesResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['attributeUid' => 1, 'name' => 'Color'],
            ['attributeUid' => 2, 'name' => 'Size'],
        ]);

        $response = $this->api->items->attributes->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['attributeUid']);
        $this->assertEquals('Color', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/attributes');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['attributeUid' => 1, 'name' => 'Color'],
        ]);

        $response = $this->api->items->attributes->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse(['attributeUid' => 1, 'name' => 'Color', 'description' => 'Product color']);

        $response = $this->api->items->attributes->get(1);

        $this->assertEquals(1, $response->data['attributeUid']);
        $this->assertEquals('Color', $response->data['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/attributes/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse(['attributeUid' => 3, 'name' => 'Material']);

        $response = $this->api->items->attributes->create(['name' => 'Material']);

        $this->assertEquals(3, $response->data['attributeUid']);
        $this->assertEquals('Material', $response->data['name']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/attributes');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['attributeUid' => 1, 'name' => 'Updated Color']);

        $response = $this->api->items->attributes->update(1, ['name' => 'Updated Color']);

        $this->assertEquals('Updated Color', $response->data['name']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/attributes/1');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->items->attributes->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/attributes/1');
    }

    public function testListValues(): void
    {
        $this->mockListResponse([
            ['attributeValueUid' => 1, 'value' => 'Red'],
            ['attributeValueUid' => 2, 'value' => 'Blue'],
        ]);

        $response = $this->api->items->attributes->listValues(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals('Red', $response->data[0]['value']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/attributes/1/values');
    }

    public function testListValuesWithParams(): void
    {
        $this->mockListResponse([
            ['attributeValueUid' => 1, 'value' => 'Red'],
        ]);

        $response = $this->api->items->attributes->listValues(1, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testGetValue(): void
    {
        $this->mockResponse(['attributeValueUid' => 1, 'value' => 'Red', 'sortOrder' => 1]);

        $response = $this->api->items->attributes->getValue(1, 1);

        $this->assertEquals(1, $response->data['attributeValueUid']);
        $this->assertEquals('Red', $response->data['value']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/attributes/1/values/1');
    }

    public function testCreateValue(): void
    {
        $this->mockResponse(['attributeValueUid' => 3, 'value' => 'Green']);

        $response = $this->api->items->attributes->createValue(1, ['value' => 'Green']);

        $this->assertEquals(3, $response->data['attributeValueUid']);
        $this->assertEquals('Green', $response->data['value']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/attributes/1/values');
    }

    public function testUpdateValue(): void
    {
        $this->mockResponse(['attributeValueUid' => 1, 'value' => 'Dark Red']);

        $response = $this->api->items->attributes->updateValue(1, 1, ['value' => 'Dark Red']);

        $this->assertEquals('Dark Red', $response->data['value']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/attributes/1/values/1');
    }

    public function testDeleteValue(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->items->attributes->deleteValue(1, 1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/attributes/1/values/1');
    }
}
