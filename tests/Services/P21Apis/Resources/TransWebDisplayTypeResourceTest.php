<?php

declare(strict_types=1);

namespace AugurApi\Tests\Services\P21Apis\Resources;

use AugurApi\Tests\AugurApiTestCase;

/**
 * Tests for TransWebDisplayTypeResource.
 *
 * @covers \AugurApi\Services\P21Apis\Resources\TransWebDisplayTypeResource
 */
final class TransWebDisplayTypeResourceTest extends AugurApiTestCase
{
    public function testCreate(): void
    {
        $this->mockResponse([
            'webDisplayTypeUid' => 1,
            'displayTypeName' => 'Grid View',
            'description' => 'Display items in grid format',
        ]);

        $response = $this->api->p21Apis->transWebDisplayType->create([
            'displayTypeName' => 'Grid View',
            'description' => 'Display items in grid format',
        ]);

        $this->assertEquals(1, $response->data['webDisplayTypeUid']);
        $this->assertEquals('Grid View', $response->data['displayTypeName']);
        $this->assertRequestMethod('POST');
        $this->assertRequestPath('/trans-web-display-type');
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGet(): void
    {
        $this->mockResponse([
            'webDisplayTypeUid' => 1,
            'displayTypeName' => 'Grid View',
            'description' => 'Display items in grid format',
        ]);

        $response = $this->api->p21Apis->transWebDisplayType->get(1);

        $this->assertEquals(1, $response->data['webDisplayTypeUid']);
        $this->assertEquals('Grid View', $response->data['displayTypeName']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/trans-web-display-type/1');
    }

    public function testGetWithParams(): void
    {
        $this->mockResponse([
            'webDisplayTypeUid' => 1,
            'displayTypeName' => 'Grid View',
        ]);

        $response = $this->api->p21Apis->transWebDisplayType->get(1, ['includeDetails' => true]);

        $this->assertEquals(1, $response->data['webDisplayTypeUid']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testUpdate(): void
    {
        $this->mockResponse([
            'webDisplayTypeUid' => 1,
            'displayTypeName' => 'List View',
            'description' => 'Display items in list format',
        ]);

        $response = $this->api->p21Apis->transWebDisplayType->update(1, [
            'displayTypeName' => 'List View',
            'description' => 'Display items in list format',
        ]);

        $this->assertEquals('List View', $response->data['displayTypeName']);
        $this->assertRequestMethod('PUT');
        $this->assertRequestPath('/trans-web-display-type/1');
    }

    public function testDelete(): void
    {
        $this->mockResponse([
            'success' => true,
        ]);

        $response = $this->api->p21Apis->transWebDisplayType->delete(1);

        $this->assertTrue($response->data['success']);
        $this->assertRequestMethod('DELETE');
        $this->assertRequestPath('/trans-web-display-type/1');
    }

    public function testGetDefaults(): void
    {
        $this->mockResponse([
            'defaultDisplayType' => 'Grid',
            'itemsPerPage' => 20,
            'showPrices' => true,
        ]);

        $response = $this->api->p21Apis->transWebDisplayType->getDefaults();

        $this->assertEquals('Grid', $response->data['defaultDisplayType']);
        $this->assertEquals(20, $response->data['itemsPerPage']);
        $this->assertTrue($response->data['showPrices']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/trans-web-display-type/defaults');
    }

    public function testGetDefaultsWithParams(): void
    {
        $this->mockResponse([
            'defaultDisplayType' => 'List',
            'itemsPerPage' => 10,
        ]);

        $response = $this->api->p21Apis->transWebDisplayType->getDefaults(['context' => 'mobile']);

        $this->assertEquals('List', $response->data['defaultDisplayType']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }

    public function testGetDefinition(): void
    {
        $this->mockResponse([
            'fields' => [
                ['name' => 'displayTypeName', 'type' => 'string', 'required' => true],
                ['name' => 'description', 'type' => 'string', 'required' => false],
            ],
        ]);

        $response = $this->api->p21Apis->transWebDisplayType->getDefinition();

        $this->assertCount(2, $response->data['fields']);
        $this->assertEquals('displayTypeName', $response->data['fields'][0]['name']);
        $this->assertRequestMethod('GET');
        $this->assertRequestPath('/trans-web-display-type/definition');
    }

    public function testGetDefinitionWithParams(): void
    {
        $this->mockResponse([
            'fields' => [
                ['name' => 'displayTypeName', 'type' => 'string'],
            ],
            'version' => '1.0',
        ]);

        $response = $this->api->p21Apis->transWebDisplayType->getDefinition(['version' => '1.0']);

        $this->assertEquals('1.0', $response->data['version']);
        $this->assertHasSiteIdHeader();
        $this->assertHasAuthHeader();
    }
}
