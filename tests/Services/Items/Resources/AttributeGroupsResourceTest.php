<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\Items\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for AttributeGroupsResource.
 *
 * @covers \AugurApi\Services\Items\Resources\AttributeGroupsResource
 */
final class AttributeGroupsResourceTest extends AugurApiTestCase
{
    public function testList(): void
    {
        $this->mockListResponse([
            ['attributeGroupUid' => 1, 'name' => 'Physical Specs'],
            ['attributeGroupUid' => 2, 'name' => 'Electrical Specs'],
        ]);

        $response = $this->api->items->attributeGroups->list();

        $this->assertCount(2, $response->data);
        $this->assertEquals(1, $response->data[0]['attributeGroupUid']);
        $this->assertEquals('Physical Specs', $response->data[0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/attribute-groups');
    }

    public function testListWithParams(): void
    {
        $this->mockListResponse([
            ['attributeGroupUid' => 1, 'name' => 'Physical Specs'],
        ]);

        $response = $this->api->items->attributeGroups->list(['limit' => 10, 'offset' => 0]);

        $this->assertCount(1, $response->data);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'attributeGroupUid' => 1,
            'name' => 'Physical Specs',
            'description' => 'Physical specifications',
        ]);

        $response = $this->api->items->attributeGroups->get(1);

        $this->assertEquals(1, $response->data['attributeGroupUid']);
        $this->assertEquals('Physical Specs', $response->data['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/attribute-groups/1');
    }

    public function testCreate(): void
    {
        $this->mockResponse(['attributeGroupUid' => 3, 'name' => 'New Group']);

        $response = $this->api->items->attributeGroups->create(['name' => 'New Group']);

        $this->assertEquals(3, $response->data['attributeGroupUid']);
        $this->assertEquals('New Group', $response->data['name']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/attribute-groups');
    }

    public function testUpdate(): void
    {
        $this->mockResponse(['attributeGroupUid' => 1, 'name' => 'Updated Group']);

        $response = $this->api->items->attributeGroups->update(1, ['name' => 'Updated Group']);

        $this->assertEquals('Updated Group', $response->data['name']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/attribute-groups/1');
    }

    public function testDelete(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->items->attributeGroups->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/attribute-groups/1');
    }

    public function testListAttributes(): void
    {
        $this->mockListResponse([
            ['attributeXAttributeGroupUid' => 1, 'attributeUid' => 100, 'sortOrder' => 1],
            ['attributeXAttributeGroupUid' => 2, 'attributeUid' => 101, 'sortOrder' => 2],
        ]);

        $response = $this->api->items->attributeGroups->listAttributes(1);

        $this->assertCount(2, $response->data);
        $this->assertEquals(100, $response->data[0]['attributeUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/attribute-groups/1/attributes');
    }

    public function testListAttributesWithParams(): void
    {
        $this->mockListResponse([
            ['attributeXAttributeGroupUid' => 1, 'attributeUid' => 100],
        ]);

        $response = $this->api->items->attributeGroups->listAttributes(1, ['limit' => 5]);

        $this->assertCount(1, $response->data);
    }

    public function testGetAttribute(): void
    {
        $this->mockResponse([
            'attributeXAttributeGroupUid' => 1,
            'attributeUid' => 100,
            'sortOrder' => 1,
        ]);

        $response = $this->api->items->attributeGroups->getAttribute(1, 1);

        $this->assertEquals(1, $response->data['attributeXAttributeGroupUid']);
        $this->assertEquals(100, $response->data['attributeUid']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/attribute-groups/1/attributes/1');
    }

    public function testCreateAttribute(): void
    {
        $this->mockResponse(['attributeXAttributeGroupUid' => 3, 'attributeUid' => 102]);

        $response = $this->api->items->attributeGroups->createAttribute(1, ['attributeUid' => 102]);

        $this->assertEquals(3, $response->data['attributeXAttributeGroupUid']);
        $this->assertEquals(102, $response->data['attributeUid']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/attribute-groups/1/attributes');
    }

    public function testUpdateAttribute(): void
    {
        $this->mockResponse(['attributeXAttributeGroupUid' => 1, 'sortOrder' => 5]);

        $response = $this->api->items->attributeGroups->updateAttribute(1, 1, ['sortOrder' => 5]);

        $this->assertEquals(5, $response->data['sortOrder']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/attribute-groups/1/attributes/1');
    }

    public function testDeleteAttribute(): void
    {
        $this->mockSuccessResponse();

        $response = $this->api->items->attributeGroups->deleteAttribute(1, 1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/attribute-groups/1/attributes/1');
    }
}
